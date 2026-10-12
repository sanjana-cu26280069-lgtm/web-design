sudo python3 -m venv /var/www/venv
sudo /var/www/venv/bin/pip install pymysql sqlalchemy

WSGIDaemonProcess pyapp python-home=/var/www/venv python-path=/var/www/wsgi
WSGIProcessGroup pyapp
WSGIScriptAlias /hello /var/www/wsgi/hello.py

sudo systemctl reload apache2
