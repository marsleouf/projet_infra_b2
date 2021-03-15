# Liste des commandes

- Pour le ssl autosigne:

  ```
    sudo openssl genrsa -des3 -out quentinguiheneuc.fr.key 2048
    sudo openssl req -new -key quentinguiheneuc.fr.key -out quentinguiheneuc.fr.csr
    sudo openssl req -new -key quentinguiheneuc.fr.key -out quentinguiheneuc.fr.csr
    sudo openssl x509 -req -in quentinguiheneuc.fr.csr -signkey quentinguiheneuc.fr.key -out quentinguiheneuc.fr.crt
    sudo openssl pkcs12 -export -out quentinguiheneuc.fr.pfx -inkey quentinguiheneuc.fr.key -in quentinguiheneuc.fr.crt -certfile quentinguiheneuc.fr.crt
  ```

- Pour le fail2ban:
  ```
    1419  sudo apt install fail2ban
    1420  sudo nano /etc/fail2ban/filter.d/nginx-4xx.conf
    1421  cd ..
    1422  cd ./etc/fail2ban/
    1423  grep log
    1424  ls
    1425  whereis .log
    1426  cat /var/log/fail2ban.log
    1427  sudo cat /var/log/fail2ban.log
    1428  whereis fail2ban.log
    1429  cat /etc/fail2ban/fail2ban.log
    openssl genrsa -des3 -out admin-serv.net.key 2048
  ```
