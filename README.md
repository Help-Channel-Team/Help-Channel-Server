# Help-Channel-Server

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

        location /administracion {
                root /var/www/html/Administration/web;
                proxy_pass http://localhost:4443;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header Host $host;
                proxy_set_header X-Forwarded-For $remote_addr;
        }

        location /tecnico {
                 alias /var/www/html/NoVNC;
        }
}


Licensed under the EUPL V.1.1

The license text is available at http://www.osor.eu/eupl and the attached PDF
