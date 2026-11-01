# Apache local HTTPS (development only)
# Create a self-signed certificate (OpenSSL):
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout myproject.local.key -out myproject.local.crt \
  -subj "/CN=myproject.local"
# Enable Apache SSL module and configure a :443 VirtualHost with SSLEngine on,
# SSLCertificateFile and SSLCertificateKeyFile pointing to these files.
# A self-signed certificate triggers a browser warning; do not use in production.
