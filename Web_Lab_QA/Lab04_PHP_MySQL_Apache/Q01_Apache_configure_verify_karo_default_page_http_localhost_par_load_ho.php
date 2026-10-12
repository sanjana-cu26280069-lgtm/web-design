sudo systemctl status apache2          # active (running)
curl -I http://localhost               # HTTP/1.1 200 OK

echo "<h1>Apache works</h1>" | sudo tee /var/www/html/index.html
