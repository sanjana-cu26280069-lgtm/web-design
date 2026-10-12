sudo tail -f /var/log/apache2/access.log     # XAMPP: C:\xampp\apache\logs\access.log
sudo tail -f /var/log/apache2/error.log
# doosre terminal se requests bhejo:
for i in {1..10}; do curl -s -o /dev/null http://localhost/; done
curl -s -o /dev/null http://localhost/nopage.php       # 404 error generate
ab -n 100 -c 10 http://localhost/                      # performance test (apache2-utils install karo)
