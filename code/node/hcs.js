var fs = require("fs");
var net = require("net");
var https = require("https");
var crypto = require("crypto");
var urlParse = require("url").parse;

// Modulo de nodo usado para el servidor de Websockets
var WebSocketServer = require("websocket").server;

// Certificados para https, deben estar en la carpeta certificado
var fileKey = "ssl.key";
var fileCrt = "ssl.crt";

var key = fs.readFileSync("./certificado/" + fileKey, "utf8");
var cert = fs.readFileSync("./certificado/" + fileCrt, "utf8");

/* Dirección de escucha para el servidor, se usará nginx o apache como proxy web entre el 443 o el puerto elegido y
   el siguiente puerto local. Se podría prescindir del proxy y escuchar directamente el 443 aquí pero no podríamos usar 
   el puerto 443 para servir otros cometidos en paralelo */

var hostAddr = "127.0.0.1";
var hostPort = 4443;

// Puertos de destino para el repetidor VNC
var hostRepeaterServer = "127.0.0.1";
var portRepeaterServer = 5500;
var hostRepeaterClient = "127.0.0.1";
var portRepeaterClient = 5900;

// Servidor https para el websocket desde el que se conecta el servidor VNC
var server = https.createServer({key: key, cert: cert});
server.listen(hostPort, hostAddr, function()
{  
	console.log("Servidor https iniciado. Esperando conexiones ...");
});

// Inicia servidor de Websockets sobre server anterior
var wsServer = new WebSocketServer({
	httpServer: server,
	key: key,
	cert: cert
});

wsServer.on("request", function(request) 
{
  var url = urlParse(request.resource, true);
  var args = url.pathname.split('/').slice(1);
  var action = args.shift();
  
  //  Escucha conexiones desde Servidor VNC en modo repetidor
  if (action == "wsServer") 
  {
	WebSocket2TCPSocket(request,hostRepeaterServer, portRepeaterServer);    
  }
  //  Escucha conexiones desde Cliente VNC en modo repetidor
  else if (action == "wsClient") 
  {
	WebSocket2TCPSocket(request, hostRepeaterClient, portRepeaterClient);    
  }
  //  Aborta cualquier otra conexión
  else 
  {
  	request.reject(404);
  }
});

// Conversión de WebSocket a TCP Socket y viceversa 
function WebSocket2TCPSocket(request, host, port) 
{
  var webSocket = request.accept();
  console.log("Recibiendo datos de: " + webSocket.remoteAddress);

  // Socket TCP desde el que conectar al destino
  var tcpSocket = new net.Socket();

  tcpSocket.on("error", function(err) {
    webSocket.send(JSON.stringify({status: 'error', details: 'Upstream socket error; ' + err}));
  });

  // Cuando el socket TCP tiene datos, los escribe en el websocket 	
  tcpSocket.on("data", function(data) 
  {
    webSocket.send(data);
  });

  tcpSocket.on("close", function() 
  {
    webSocket.close();
  });

  // Conecta al socket TCP
  tcpSocket.connect(port, host, function() 
  {
        // Cuando el websocket tiene datos, los escribe en el socket TCP
    	webSocket.on('message', function(msg) 
    	{
      		tcpSocket.write(msg.binaryData);
        });
  });    

  webSocket.send(JSON.stringify({status: 'ready', details: 'Upstream socket connected'}));

  // Si se cierra el websocket, se destruye el socket TCP
  webSocket.on('close', function() 
  {
	tcpSocket.destroy();
	console.log(webSocket.remoteAddress + ' desconectado');
  });

}

//////////////// Repetidor lado Servidor ////////////////

var serverRepeater = net.createServer();  
serverRepeater.on('connection', handleConnectionServer);

serverRepeater.listen(5500, function() {  
  console.log('server listening to %j', server.address());
});

function handleConnectionServer(conn) {  
  var remoteAddress = conn.remoteAddress + ':' + conn.remotePort;
  console.log('new server connection from %s', remoteAddress);

  conn.setTimeout(timeout);

  //conn.write("RFB 000.000\n");
  console.log("En TCP conection"); 


  conn.on('data', onConnData);
  conn.once('close', onConnClose);
  conn.on('error', onConnError);

  function onConnData(d) {
    console.log('connection data from %s: %j', remoteAddress, d);
    //conn.write(d);

    	if(clientes["1234"] !== undefined)
	{
            console.log("Cliente detectado en el 1234");
	    clientes["1234"].write(d);
	}

  }

  function onConnClose() {
    console.log('connection from %s closed', remoteAddress);
  }

  function onConnError(err) {
    console.log('Connection %s error: %s', remoteAddress, err.message);
  }
}

///////////////////////////////////////////////////////////////



///////////////// Repetidor lado Cliente /////////////////

var clientRepeater = net.createServer();  
clientRepeater.on('connection', handleConnectionClient);

clientRepeater.listen(5900, function() {  
  console.log('server listening to %j', server.address());
});

function handleConnectionClient(conn) {  
  var remoteAddress = conn.remoteAddress + ':' + conn.remotePort;
  console.log('new client connection from %s', remoteAddress);

  conn.setTimeout(timeout);

  console.log("En TCP conection"); 

  conn.on('data', onConnData);
  conn.once('close', onConnClose);
  conn.on('error', onConnError);

  function onConnData(d) {
    console.log('connection data from %s: %j', remoteAddress, d);
    //conn.write(d);
    console.log("Antes del envio a servidor desde cliente");
	if(servidores["1234"] !== undefined)
	{
		console.log("Servidor detectado en el 1234");
		console.log("Antes del envio a servidor desde cliente,write");
		servidores["1234"].write(d);
		console.log("Después del envio a servidor desde cliente,write");
	}	
  }

  function onConnClose() {
    console.log('connection from %s closed', remoteAddress);
  }

  function onConnError(err) {
    console.log('Connection %s error: %s', remoteAddress, err.message);
  }
}

///////////////////////////////////////////////////////////////



