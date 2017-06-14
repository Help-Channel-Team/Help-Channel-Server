// Load the TCP Library
net = require('net');
//websockifyServer = require('node-websockify');
websockifyClient = require('node-websockify');
/*
websockifyServer({
  source: '0.0.0.0:6500',
  target: '127.0.0.1:5500'
});
*/
websockifyClient({
  source: '0.0.0.0:6900',
  target: '127.0.0.1:5900'
});

// Keep track of the chat clients
var clients = [];
var servers = [];
/*
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
*/
// Put a friendly message on the terminal of the server.
//console.log("Repetidor Server en Puerto 5500\n");

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
console.log("Repetidor Cliente en puerto 5900\n");




