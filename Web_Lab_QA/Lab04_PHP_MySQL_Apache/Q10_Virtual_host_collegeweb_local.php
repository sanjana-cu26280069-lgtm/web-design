sudo mkdir -p /var/www/collegeweb && echo "<h1>College Web</h1>" | sudo tee /var/www/collegeweb/index.html
sudo nano /etc/apache2/sites-available/collegeweb.conf

<VirtualHost *:80>
    ServerName collegeweb.local
    DocumentRoot /var/www/collegeweb
    ErrorLog ${APACHE_LOG_DIR}/collegeweb-error.log
    CustomLog ${APACHE_LOG_DIR}/collegeweb-access.log combined
</VirtualHost>

sudo a2ensite collegeweb.conf
echo "127.0.0.1 collegeweb.local" | sudo tee -a /etc/hosts
sudo apache2ctl configtest && sudo systemctl reload apache2
