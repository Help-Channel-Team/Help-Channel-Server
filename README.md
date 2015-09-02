# Help-Channel-Server

![alt tag](https://github.com/Help-Channel-Team/Help-Channel-Server/blob/master/escenario.png)

NoVnc - Cliente HTML5 VNC
https://github.com/kanaka/noVNC

Websockify - WebSockets to TCP socket bridge
https://github.com/kanaka/websockify

Yii - BackEnd
https://github.com/yiisoft/yii2

Repetidor VNC
http://www.karlrunge.com/x11vnc/ultravnc_repeater.pl    ( Modificado, ver en repositorio )

x11vnc
http://www.karlrunge.com/x11vnc/


Apache2 

a2enmod proxy
a2enmod proxy_http
a2enmod proxy_wstunnel
a2enmod ssl
sudo service apache2 restart

/////////   /etc/apache2/sites-available/000-default.conf
<VirtualHost 127.0.0.1:443>

        ServerAdmin webmaster@localhost
        ServerName helpchannel.ingenieriacreativa.es
        DocumentRoot /var/www/helpchannel/administration/web
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        SSLEngine on
        SSLProtocol All -SSLv2 -SSLv3
        SSLCertificateFile /etc/nginx/conf.d/ssl-uni.help.crt
        SSLCertificateKeyFile /etc/nginx/conf.d/ssl-out.key
        SSLCertificateChainFile /etc/nginx/conf.d/ssl.crt


        <Directory /var/www/helpchannel/administration/web>
                Options Indexes FollowSymLinks Multiviews
                AllowOverride All
                Order allow,deny
                allow from all 
        </Directory>


        Alias /tecnico /var/www/helpchannel/noVNC
        <Directory "/var/www/helpchannel/noVNC">
                 Options Indexes FollowSymLinks MultiViews
                AllowOverride all
                Order allow,deny
                Allow from all
        </Directory>

        <Location "/websockify">
            ProxyPass ws://127.0.0.1:6080/
            ProxyPassReverse ws://127.0.0.1:6080/
        </Location>

         <Location "/websocketserver">
            ProxyPass ws://127.0.0.1:6070/
            ProxyPassReverse ws://127.0.0.1:6070/
        </Location>


</VirtualHost>

///////////////////////////////////////////////////////////////////////////////////////////


Nginx

upstream vnc_proxy {
    server 127.0.0.1:6080;
}

upstream vnc_proxy_server {
    server 127.0.0.1:6070;
}


server {
        listen 80;
        server_name helpchannel.ingenieriacreativa.es;
        return 301 https://helpchannel.ingenieriacreativa.es$request_uri;
}

server {
        listen 443 ssl;
        server_name helpchannel.ingenieriacreativa.es;

        ssl                     on;
        ssl_certificate         /etc/nginx/conf.d/ssl-uni.help.crt;
        ssl_certificate_key     /etc/nginx/conf.d/ssl-out.key;
        ssl_session_timeout     20m;
        ssl_protocols           TLSv1 TLSv1.1 TLSv1.2;
        ssl_ciphers             HIGH:!aNULL:!MD5;
        ssl_prefer_server_ciphers   on;

        location / {
                root /var/www/html;
                proxy_pass http://localhost:90;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header Host $host;
                proxy_set_header X-Forwarded-For $remote_addr;
        }

        location /tecnico {
                 alias /var/www/helpchannel/noVNC;
        }

        location /websockify {
          proxy_pass http://vnc_proxy;
          proxy_http_version 1.1;
          proxy_set_header Upgrade $http_upgrade;
          proxy_set_header Connection "upgrade";
        }

       
        location /websocketserver {
          proxy_pass http://vnc_proxy_server;
          proxy_http_version 1.1;
          proxy_set_header Upgrade $http_upgrade;
          proxy_set_header Connection "upgrade";
        }


 }


Licensed under the EUPL V.1.1

The license text is available at http://www.osor.eu/eupl and the attached PDF
