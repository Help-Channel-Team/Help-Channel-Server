// Load the TCP Library
net = require('net');

// Load the Websockify Library
websockifyServer = require('./websockifyCLIENT.js');
websockifyClient = require('./websockifySERVER.js');

var mysql = require('mysql');

var con = mysql.createConnection({
  host: "mysql",
  user: "root",
  password: "admin"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected to Mysql Database from Node!");
});

websockifyServer({
  source: '0.0.0.0:6500',
  target: '127.0.0.1:5500'
});

websockifyClient({
  source: '0.0.0.0:6900',
  target: '127.0.0.1:5900'
});

// Keep track of the chat clients
var clients = [];
var servers = [];

// Start a TCP Server
net.createServer(function (socket) {

  socket.name = socket.remoteAddress + ":" + socket.remotePort 
  //console.log("Server Connected from " + socket.name); 

  // Handle incoming messages from servers.
    socket.on('data', function (data) {

    console.log("hay datos en servidor" + String(data));

    if(String(data).startsWith("ID"))
    {

        var id = (String(data)).split(":")[1];
        var serverProtocol = "";

        if(String(id).includes("RFB"))
        {
		var aux = (String(id)).split("RFB");
	        id = aux[0];
        }
        console.log("Servidor con ID_"+id+"_");

        servers[id] = socket;

        if(id in clients)
        { 
             console.log("id in clients");
             var socketClient = clients[id];
             clients[socket] = socketClient;
             servers[socketClient] = socket;

             delete clients[id];
             delete servers[id];

             clients[socket].write("RFB 003.008\n","binary"); 
		
        }
    }
    else
    {
        //if(socket in clients)
	if(clients[socket] != undefined)
	{
		try {
    			clients[socket].write(data,"binary");
		}
		catch(err) {	
        	}
    }

  });

  socket.on('end', function () {
    console.log("Server Disconnected");
 //   delete servers[socket];
  });

}).listen(5500);

console.log("Repeat Server Listening on Port 5500\n");

net.createServer(function (socket) {

  socket.name = socket.remoteAddress + ":" + socket.remotePort 

  //console.log("Client detected from " + socket.name); 

  socket.write("RFB 000.000\n","binary");
  
  // Handle incoming messages from clients.
  socket.on('data', function (data) {

console.log("hay datos en cliente "+ String(data));

    if(String(data).startsWith("ID"))
    {
	var id = (String(data)).split(":")[1];

        clients[id] = socket;

        console.log("Cliente conectado con ID_"+id+"_");

//console.log(servers);

        if(id in servers)
        {
             console.log("Find id in servers");
             var socketServer = servers[id];
	     servers[socket] = socketServer;
 	     clients[socketServer] = socket;

             delete clients[id];
             delete servers[id];

	     socket.write("RFB 003.008\n","binary");
        }
    }
    else
    {
	//if(socket in servers)  
	if(servers[socket] != undefined)
        {

		try {
                        servers[socket].write(data,"binary");
                }
                catch(err) {    
                }



        }
    }
  });

  // Remove the client from the list when it leaves
  socket.on('end', function () {
    console.log("Client Disconnected\n")
//    delete servers[socket];
  });
  

}).listen(5900);

console.log("Repeater Client Listening on port 5900\n");

//'UPDATE `helpchannel`.`helpchannel_connection` SET status_id=6, modification_date=NOW(), end_date=NOW() WHERE connection_code=?
