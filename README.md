# Help-Channel

Requisitos previos:

Se necesita tener en el equipo que haga de servidor, un servidor web con PHP y con soporte para WebSockets. También Node-js.

El servidor PHP se usará para el backend de administración y gestión de los técnicos, situado en el código del servidor en la carpeta /Administration. Proporciona también los Servicios Web que usará el cliente para solicitar asistencia. Toda esta parte está desarrollada en el Framework de PHP Yii 2.0.

Sin entrar en temas de instalación de nginx o apache como posibles servidores Web, el proyecto Yii es necesario proporcionarle las dependencias usando composer.

https://getcomposer.org/

Una vez instalado, desde la carpeta /Administrator:

./composer global require "fxp/composer-asset-plugin:^1.2.0"


Desde la carpeta de instalación /Administrator:

./composer install



La carpeta raíz de este entorno de administración que hay que configurar en el servidor web es /Administration/web/

El proyecto tiene habilitado Friendly URL, PHP debe tener habilitado el módulo mod_rewrite con el .htaccess .

Contenido del archivo .htaccess
##################################################

RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f

RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule . index.php

##################################################

![Alt text](/hc.png?raw=true "Diagrama Servidor")

Paso 1. El usuario que necesita ayuda la solicita desde el cliente hcc.py, y el técnico que está logado en la web de administración ve dicha solicitud.

Paso 2. El técnico acepta la solicitud.

Paso 3. El usuario valida la asistencia del técnico anterior.

Paso 4. Se inicia en el equipo del cliente el servidor de VNC X11VNC en modo repetidor, este se conecta al puerto local configurado y a través del cliente python accederá al proceso servidor hcs.js a traveś del websocket situado en /wsServer.
Al acceder en modo repetidor, quedará en espera del cliente.

Paso 5. El técnico que va a proporcionar asistencia ve que el usuario está listo y conectado desde la web de administración y abre la web /tech que le conecta usando el cliente web NoVNC al repetidor VNC situado en el proceso hcs.js a través del websocket /wsClient y conectándolo con el X11VNC del usuario que estaba esperando. La comunicación podrá romperse en cualquier momento por ambas partes.


Servidor hcs.js. NODEJS
Proporciona los websockets /wsClient y /wsServer que comunican cliente y servidor de VNC entre si.  

timeout = 100000;       Timeout para la conexión a los websockets, tanto el cliente como el servidor deben permanecer conectados en ausencia del otro extremo de la comunicación. 

fileKey = "ssl.key";    Certificados encriptación WebSockets

fileCrt = "ssl.crt";    Certificados encriptación WebSockets

hostAddr = "127.0.0.1"; IP local de escucha del servidor

hostPort = 4443;	Puerto local de escucha del servidor		      

hostRepeaterServer = "127.0.0.1";    En caso de usar el repetidor Perl, estos son los valores de escucha para extremos cliente y servidor. Usando repetidor node, no es necesario.

portRepeaterServer = 5500;

hostRepeaterClient = "127.0.0.1";

portRepeaterClient = 5900;


Cliente hcc.py PYTHON

Interfaz gráfica para el entorno de usuario y cliente de Websockets para conectar el tráfico local del X11VNC con el websocket /wsServer 

Cliente hcc.js NODEJS

Script de prueba que realiza todo el proceso sin solicitud de datos al usuario.



Los componentes usados en el proyecto son los siguientes:

NoVnc - Cliente HTML5 VNC
https://github.com/kanaka/noVNC

hcs.js - WebSockets to TCP socket bridge ( node.js )
Ejecución : ./nodejs hcs.js. Si el puerto fuera 443, necesario sudo.

Yii - BackEnd
https://github.com/yiisoft/yii2
Necesario servidor Web PHP y base datos Mysql

Repetidor VNC
http://www.karlrunge.com/x11vnc/ultravnc_repeater.pl    ( Modificado, ver en repositorio )
Ejecución: ./ultravnc_repeater.pl

x11vnc
http://www.karlrunge.com/x11vnc/

Nginx

// Websockets Proxy

server {

        listen 443;
        server_name dominio_proyecto.com;

        location /wsServer {
                root /var/www/html;
                proxy_pass http://localhost:4443;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header Host $host;
                proxy_set_header X-Forwarded-For $remote_addr;
        }

	location /wsClient {
                root /var/www/html;
                proxy_pass http://localhost:4443;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header Host $host;
                proxy_set_header X-Forwarded-For $remote_addr;
        }

}

WebServer administración y cliente VNC

server {

        listen 443 ssl;
        server_name dominio_proyecto.com;

        ssl                     on;
        ssl_certificate         /ruta a certificado/fullchain.pem;
        ssl_certificate_key     /ruta a certificado/privkey.pem;

        location /admin {
                root /var/www/html/Administration/web;
                proxy_pass http://localhost:4443;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header Host $host;
                proxy_set_header X-Forwarded-For $remote_addr;
        }

        location /tech {
                 alias /var/www/html/NoVNC;
        }
}


Licensed under the EUPL V.1.1

The license text is available at http://www.osor.eu/eupl and the attached PDF
