var fs = require("fs");
var net = require("net");
var https = require("https");
var crypto = require("crypto");
var urlParse = require("url").parse;

// Modulo de nodo usado para el servidor de Websockets
var WebSocketServer = require("websocket").server;

// Certificados para https
var fileKey = "ssl.key";
var fileCrt = "ssl.crt";

var key = fs.readFileSync("./certificado/" + fileKey, "utf8");
var cert = fs.readFileSync("./certificado/" + fileCrt, "utf8");

// Dirección de escucha para el servidor
var hostAddr = "127.0.0.1";
var hostPort = 443;

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

// 
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

// Repetidor RFB TCP

// Start a TCP Server
net.createServer(function (socket) {
console.log("Conectado servidor");
  // Identify this client
  socket.name = socket.remoteAddress + ":" + socket.remotePort 

  // Put this new client in the list
  servers.push(socket);

  

  // Send a nice welcome message and announce
 // console.log("Welcome " + socket.name + "\n");
  //socket.write("Welcome " + socket.name + "\n");
  //broadcast(socket.name + " joined the chat\n", socket);

  // Handle incoming messages from clients.
    socket.on('data', function (data) {
//    console.log("Con datos" + data + " servidor")

    if(String(data).startsWith("ID"))
    {
//	console.log("Encontrada cadena ID, no se pasa al cliente");
        // Retengo al cliente
        //socket.write("RFB 000.000\n","binary");
    }
    else
    {
	
	 if(clients.length == 1)
        { 
  //          console.log("Servidor Aqui"); 
            clients[0].write(data,"binary"); 
        }
	else
	{
//	    console.log("Servidor alli");	
	}
    }

    //socket.write("RFB 000.000\n","binary");
    //broadcast(socket.name + "> " + data, socket);
  });

  // Remove the client from the list when it leaves
  socket.on('end', function () {
//   console.log("Desconectado servidor")
    //clients.splice(clients.indexOf(socket), 1);
    //broadcast(socket.name + " left the chat.\n");
  });
  
  // Send a message to all clients
  function broadcast(message, sender) {
    clients.forEach(function (client) {
      // Don't want to send it to sender
      if (client === sender) return;
      client.write(message);
    });
    // Log it to the server output too
    process.stdout.write(message)
  }

}).listen(5500);

// Put a friendly message on the terminal of the server.
console.log("Chat server running at port 5500\n");

net.createServer(function (socket) {
console.log("Conectado cliente");
  // Identify this client
  socket.name = socket.remoteAddress + ":" + socket.remotePort 

  // Put this new client in the list
  clients.push(socket);

  //clients["12345"] = socket;

  // Send a nice welcome message and announce
  //console.log("Welcome " + socket.name + "\n");
  socket.write("RFB 000.000\n","binary");
  
//socket.write("Welcome " + socket.name + "\n");
  //broadcast(socket.name + " joined the chat\n", socket);

  // Handle incoming messages from clients.
  socket.on('data', function (data) {
    //console.log("Con datos" + data + "cliente")
    //socket.write("RFB 003.008\n","binary");
    if(String(data).startsWith("ID"))
    {
        console.log("Encontrada cadena ID, no se pasa al servidor");
        // Retengo al cliente
        //socket.write("RFB 000.000\n","binary");
    }
    else
    {
        if(servers.length == 1)
        { //console.log("Aqui cliente");
            servers[0].write(data,"binary"); 
        }
	else
	{
	//	console.log("Alli cliente");
	}
    }
    //socket.write("RFB 000.000\n","binary");
    //broadcast(socket.name + "> " + data, socket);
  });

  // Remove the client from the list when it leaves
  socket.on('end', function () {
   console.log("Desconectado Cliente")
    //clients.splice(clients.indexOf(socket), 1);
    //broadcast(socket.name + " left the chat.\n");
  });
  
  // Send a message to all clients
  function broadcast(message, sender) {
    clients.forEach(function (client) {
      // Don't want to send it to sender
      if (client === sender) return;
      client.write(message);
    });
    // Log it to the server output too
    process.stdout.write(message)
  }

}).listen(5900);

// Put a friendly message on the terminal of the server.
console.log("Chat server running at port 5900\n");










