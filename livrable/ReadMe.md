# Installation du Projet

- Les Pakages à installer :

  ```
  php-fpm php-mysql mysql-server nginx php-curl
  ```

- La liste des Pakages PHP .

  ```
  [PHP Modules]
  calendar
  Core
  ctype
  curl
  date
  dom
  exif
  fileinfo
  filter
  ftp
  gd
  gettext
  hash
  iconv
  intl
  json
  libxml
  mbstring
  mysqli
  mysqlnd
  openssl
  pcntl
  pcre
  PDO
  pdo_mysql
  pdo_sqlite
  Phar
  posix
  readline
  Reflection
  session
  shmop
  SimpleXML
  sockets
  sodium
  SPL
  sqlite3
  standard
  sysvmsg
  sysvsem
  sysvshm
  tokenizer
  wddx
  xml
  xmlreader
  xmlwriter
  xsl
  Zend OPcache
  zip
  zlib
  ```

- Déplasser le dossier Site vars `/var/www/html/`.
-


## Nginx


First, install nginx package after updating your linux software
```
  apt-get upgrade

  apt-get install nginx
```
Then lead yourself to etc/nginx/
The main file of nginx must look like this (do not forget that in our case, quentinguiheuneuc.fr is the website we want on our server)
```conf
roo@/etc/nginx$ cat nginx.conf
user                 www-data;
pid                  /run/nginx.pid;
worker_processes     auto;
worker_rlimit_nofile 65535;

events {
    multi_accept       on;
    worker_connections 65535;
}

# Load modules
#include /etc/nginx/modules-enabled/*;

http {
    charset                utf-8;
    sendfile               on;
    tcp_nopush             on;
    tcp_nodelay            on;
    server_tokens          off;
    types_hash_max_size    2048;
    types_hash_bucket_size 64;
    client_max_body_size   16M;

    # MIME
    include                mime.types;
    default_type           application/octet-stream;

    # Logging
    access_log             /var/log/nginx/access.log;
    error_log              /var/log/nginx/error.log warn;

    # SSL
    ssl_session_timeout    1d;
    ssl_session_cache      shared:SSL:10m;
    ssl_session_tickets    off;

    # Diffie-Hellman parameter for DHE ciphersuites
    ssl_dhparam            /etc/nginx/ssl/dhparam.pem;

    # Mozilla Intermediate configuration
    ssl_protocols          TLSv1.2 TLSv1.3;
    ssl_ciphers            ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:DHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384;

    # OCSP Stapling
    ssl_stapling           on;
    ssl_stapling_verify    on;
    resolver               1.1.1.1 1.0.0.1 8.8.8.8 8.8.4.4 208.67.222.222 208.67.220.220 valid=60s;
    resolver_timeout       2s;

    # Load configs
    include                /etc/nginx/conf.d/*.conf;

    # quentinguiheneuc.fr
    server {
        listen                               443 ssl http2;
        listen                               [::]:443 ssl http2;
        server_name                          quentinguiheneuc.fr;
        set                                  $base /var/www/html/;
        root                                 /var/www/html;

        # SSL
        ssl_password_file                    /etc/nginx/ssl/ssl_password.txt;
        ssl_certificate                      /etc/nginx/ssl/quentinguiheneuc.fr.crt;
        ssl_certificate_key                  /etc/nginx/ssl/quentinguiheneuc.fr.deprotected.key;
        # security headers
        add_header X-Frame-Options         "SAMEORIGIN" always;
        add_header X-XSS-Protection        "1; mode=block" always;
        add_header X-Content-Type-Options  "nosniff" always;
        add_header Referrer-Policy         "no-referrer-when-downgrade" always;
        add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
        # . files
        location ~ /\.(?!well-known) {
            deny all;
        }

        # logging
        access_log /var/log/nginx/quentinguiheneuc.fr.access.log;
        error_log  /var/log/nginx/quentinguiheneuc.fr.error.log warn;

        # index.php
        index      index.php    index.html;

        # index.php fallback
        location / {
            try_files $uri $uri/ /index.php;
        }

        # favicon.ico
        location = /favicon.ico {
            log_not_found off;
            access_log    off;
        }

        # robots.txt
        location = /robots.txt {
            log_not_found off;
            access_log    off;
        }

        # assets, media
        location ~* \.(?:css(\.map)?|js(\.map)?|jpe?g|png|gif|ico|cur|heic|webp|tiff?|mp3|m4a|aac|ogg|midi?|wav|mp4|mov|webm|mpe?g|avi|ogv|flv|wmv)$ {
        #    add_header  Content-Type    application/x-javascript;
            expires    7d;
            access_log off;
        }

        # svg, fonts
        location ~* \.(?:svgz?|ttf|ttc|otf|eot|woff2?)$ {
            add_header Access-Control-Allow-Origin "*";
            expires    7d;
            access_log off;
        }

        # handle .php
        try_files $uri $uri/ =404;
        location ~ \.php$ {
           # fastcgi_pass                  127.0.0.1:8080;
            fastcgi_pass                  unix:/var/run/php/php7.3-fpm.sock;

            # 404
            #try_files                     $uri =404;

            # default fastcgi_params
            include                       fastcgi_params;

            # fastcgi settings
            fastcgi_index                 index.php;
            fastcgi_buffers               8 1600k;
            fastcgi_buffer_size           3200k;

            # fastcgi params
           #fastcgi_param DOCUMENT_ROOT   $realpath_root;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            #fastcgi_param PHP_ADMIN_VALUE "open_basedir=$base/:/usr/lib/php/:/tmp/";
        }
    }

    # subdomains redirect
    server {
        listen              443 ssl http2;
        listen              [::]:443 ssl http2;
        server_name         *.quentinguiheneuc.fr;

        # SSL
        ssl_certificate     /etc/nginx/ssl/quentinguiheneuc.fr.crt;
        ssl_certificate_key /etc/nginx/ssl/quentinguiheneuc.fr.deprotected.key;
        return              301 https://quentinguiheneuc.fr$request_uri;
    }

    # HTTP redirect
    server {
        listen      80;
        listen      [::]:80;
        server_name .quentinguiheneuc.fr;
        return      301 https://quentinguiheneuc.fr$request_uri;

    }
}
```
Then verify that nginx is correctly running:
```sh
root@/etc/nginx$ systemctl status nginx
● nginx.service - A high performance web server and a reverse proxy server
   Loaded: loaded (/lib/systemd/system/nginx.service; enabled; vendor preset: enabled)
   Active: active (running) since Fri 2021-04-02 08:20:31 CEST; 1h 21min ago
     Docs: man:nginx(8)
  Process: 553 ExecStartPre=/usr/sbin/nginx -t -q -g daemon on; master_process on; (code=exited, status=0/SUCCESS)
  Process: 602 ExecStart=/usr/sbin/nginx -g daemon on; master_process on; (code=exited, status=0/SUCCESS)
 Main PID: 603 (nginx)
    Tasks: 5 (limit: 4640)
   Memory: 113.2M
   CGroup: /system.slice/nginx.service
           ├─603 nginx: master process /usr/sbin/nginx -g daemon on; master_process on;
           ├─604 nginx: worker process
           ├─605 nginx: worker process
           ├─606 nginx: worker process
           └─607 nginx: worker process

# if you have any issues with nginx, like an "exit code = 1" or a failed loading, please ask stackoverflow. Otherwise, we can go to the next step : fail2ban.

```


## Fail2ban:
Install the package:
```sh
  apt-get install fail2ban
```
Lead yourself to the main directory:
```
  cd ./etc/fail2ban/
```
Make sure you get a correct installation by checking all th files, in the main directory you should have these:
```sh
  root@/etc/fail2ban$ ls
  action.d       fail2ban.d  jail.conf  paths-arch.conf    paths-debian.conf
  fail2ban.conf  filter.d    jail.d     paths-common.conf  paths-opensuse.conf
```
Then check if fail2ban is running
  ```
  systemctl status fail2ban
  ```
Before continue, make a copy of jail.conf, do never touch this file but its double that'll be named jail.local
```
  mv jail.conf /backup/jail.conf
```
Then, you'll need to add to `jail.local` the following sections that you can find [here](./jail_local.md).

After that, go to `filter.d/` and create a filter for each sections you added in `jail.local`. You can find them [here](./filter_d.md).

You'll need to restart the fail2ban service to implements your changes.
```sh
  systemctl restart fail2ban
```

Check your enabled filters:
```sh
root@~$ fail2ban-client status 
Status
├─ Number of jail:      7
└─ Jail list:   nginx, nginx-4xx, nginx-badbots, nginx-nohome, nginx-noproxy, nginx-noscript, sshd
```

Check if fail2ban returns any error:
```sh
root@/etc/fail2ban$ systemctl status fail2ban
  ● fail2ban.service - Fail2Ban Service
    Loaded: loaded (/lib/systemd/system/fail2ban.service; enabled; vendor preset: enabled)
    Active: active (running) since Thu 2021-03-25 11:56:56 CET; 12s ago
      Docs: man:fail2ban(1)
    Process: 29809 ExecStartPre=/bin/mkdir -p /var/run/fail2ban (code=exited, status=0/SUCCESS)
  Main PID: 29810 (fail2ban-server)
      Tasks: 15 (limit: 4640)
    Memory: 15.8M
    CGroup: /system.slice/fail2ban.service
            └─29810 /usr/bin/python3 /usr/bin/fail2ban-server -xf start

  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:    findtime: 600
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:    banTime: 60
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'sshd' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx-4xx' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx-noscript' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx-badbots' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx-nohome' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]:  Jail 'nginx-noproxy' started
  mars 25 11:56:57 quentinguiheneuc fail2ban-server[29810]: Server ready
```

If you want to see the details of the bans being enforced by any one jail, you can do:
```sh
root@/$ sudo fail2ban-client status nginx-http-auth 
Status for the jail: nginx-http-auth
|- Filter
|  |- Currently failed: 0
|  |- Total failed:     0
|  `- File list:        /var/log/nginx/error.log /var/log/nginx/sd-100246.dedibox.fr-error.log /var/log/nginx/quentinguiheneuc.fr.error.log
`- Actions
   |- Currently banned: 0
   |- Total banned:     0
   `- Banned IP list:
```

Finally, if you want to ban an IP yourself, just type:
```sh
  fail2ban-client -vvv set JAIL banip WW.XX.YY.ZZ
  # where WW.XX.YY.ZZ is the IP that bothering you
```
