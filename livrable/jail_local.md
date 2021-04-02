# Welcome
## Here you'll find what to add in the file `jail.local`

-First, complete the missing lines with what follows:
```sh
ignoreip = 127.0.0.1/8 your_home_IP # do not forget to ban your localhost, it would be painful if you cannot connect to your own server
bantime = 60      # Time of ban, it's in second

findtime = 3600   # These lines combine to ban clients that fail
maxretry = 3      # to authenticate 3 times within a half hour.
```

Once it's done, add those blocks:
```sh
# To enable log monitoring for Nginx login attempts, we will enable the [nginx-http-auth] jail. Edit the enabled directive within this section so that it reads “true”.
[nginx-http-auth]

enabled  = true
filter   = nginx-http-auth
port     = http,https
logpath  = /var/log/nginx/error.log

# We can create an [nginx-noscript] jail to ban clients that are searching for scripts on the website to execute and exploit. If you do not use PHP or any other language in conjunction with your web server, you can add this jail to ban those who request these types of resources.
[nginx-noscript]

enabled  = true
port     = http,https
filter   = nginx-noscript
logpath  = /var/log/nginx/access.log
maxretry = 6

# We can add a section called [nginx-badbots] to stop some known malicious bot request patterns.
[nginx-badbots]

enabled  = true
port     = http,https
filter   = nginx-badbots
logpath  = /var/log/nginx/access.log
maxretry = 2

# If you do not use Nginx to provide access to web content within users’ home directories, you can ban users who request these resources by adding an [nginx-nohome] jail.
[nginx-nohome]

enabled  = true
port     = http,https
filter   = nginx-nohome
logpath  = /var/log/nginx/access.log
maxretry = 2

# We should ban clients attempting to use our Nginx server as an open proxy. We can add an [nginx-noproxy] jail to match these requests.
[nginx-noproxy]

enabled  = true
port     = http,https
filter   = nginx-noproxy
logpath  = /var/log/nginx/access.log
maxretry = 2
```