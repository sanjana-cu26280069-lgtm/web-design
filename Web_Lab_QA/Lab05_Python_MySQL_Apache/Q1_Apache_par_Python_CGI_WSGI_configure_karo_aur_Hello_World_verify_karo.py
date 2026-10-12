#!/usr/bin/python3
print("Content-Type: text/html\n")
print("<h1>Hello World from Python CGI</h1>")

sudo chmod +x /usr/lib/cgi-bin/hello.py
curl http://localhost/cgi-bin/hello.py

def application(environ, start_response):
    start_response("200 OK", [("Content-Type", "text/plain")])
    return [b"Hello World from WSGI"]

WSGIScriptAlias /hello /var/www/wsgi/hello.py
<Directory /var/www/wsgi>
    Require all granted
</Directory>

sudo a2enconf wsgi-lab && sudo systemctl reload apache2
curl http://localhost/hello
