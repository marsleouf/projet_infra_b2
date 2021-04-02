# Reverse Proxy

First of all, we need to get the IP of the web server :

```sh
PS C:\Users\marsl> ping quentinguiheneuc.fr

Envoi d’une requête 'ping' sur quentinguiheneuc.fr [193.250.53.76] avec 32 octets de données :
Délai d’attente de la demande dépassé.
Réponse de 193.250.53.76 : octets=32 temps=125 ms TTL=60
Réponse de 193.250.53.76 : octets=32 temps=61 ms TTL=60
Réponse de 193.250.53.76 : octets=32 temps=130 ms TTL=60

Statistiques Ping pour 193.250.53.76:
    Paquets : envoyés = 4, reçus = 3, perdus = 1 (perte 25%),
Durée approximative des boucles en millisecondes :
    Minimum = 61ms, Maximum = 130ms, Moyenne = 105ms
```

Then we'll use a raspberry to act like a reverse proxy.

Once we've installed **Nginx** on it, make sure the nginx.conf file look exactely the same to this:

```sh
user www-data;
worker_processes auto;
pid /run/nginx.pid;
include /etc/nginx/modules-enabled/*.conf;

events {
        worker_connections 768;
        # multi_accept on;
}

http {

        ##
        # Basic Settings
        ##

        sendfile on;
        tcp_nopush on;
        tcp_nodelay on;
        keepalive_timeout 65;
        types_hash_max_size 2048;
        # server_tokens off;

        server_names_hash_bucket_size 64;
        # server_name_in_redirect off;

        include /etc/nginx/mime.types;
        default_type application/octet-stream;

        ##
        # SSL Settings
        ##

        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; # Dropping SSLv3, ref: POODLE
        ssl_prefer_server_ciphers on;

        ##
        # Logging Settings
        ##

        access_log /var/log/nginx/access.log;
        error_log /var/log/nginx/error.log;

        ##
        # Gzip Settings
        ##

        gzip on;

        # gzip_vary on;
        # gzip_proxied any;
        # gzip_comp_level 6;
        # gzip_buffers 16 8k;
        # gzip_http_version 1.1;
        # gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;

        ##
        # Virtual Host Configs
        ##

        include /etc/nginx/conf.d/*.conf;
        include /etc/nginx/sites-enabled/*;
}


#mail {
#       # See sample authentication script at:
#       # http://wiki.nginx.org/ImapAuthenticateWithApachePhpScript
#
#       # auth_http localhost/auth.php;
#       # pop3_capabilities "TOP" "USER";
#       # imap_capabilities "IMAP4rev1" "UIDPLUS";
#
#       server {
#               listen     localhost:110;
#               protocol   pop3;
#               proxy      on;
#       }
#
#       server {
#               listen     localhost:143;
#               protocol   imap;
#               proxy      on;
#       }
#}
```

Then redirect yourself to the `conf.d` directory and create a `default.conf` file with:
```sh
sudo nano default.conf
```
Then in this file, write the following lines:
```sh
server {
        listen 80;
        server_name quentinguiheneuc.fr www.quentinguiheneuc.fr;

        location / {
                proxy_set_header X-Real-IP $remote_addr;
                proxy_pass http://193.250.53.76:80;
        }
}
```

Disclaimer: This is a very basic configuration of a proxy serveur and can be upgraded in many way, but at least, it works.

To check it, go have a look on `quentinguiheneuc.fr:81`. This is the adress of the proxy server.