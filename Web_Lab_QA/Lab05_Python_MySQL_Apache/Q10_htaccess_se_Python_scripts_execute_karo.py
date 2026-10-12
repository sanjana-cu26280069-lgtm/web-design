# /etc/apache2/conf-available/pyweb.conf
<Directory /var/www/html/pyapp>
    AllowOverride All
</Directory>

Options +ExecCGI
AddHandler cgi-script .py
DirectoryIndex index.py

sudo a2enconf pyweb && sudo systemctl reload apache2
sudo chmod +x /var/www/html/pyapp/*.py
