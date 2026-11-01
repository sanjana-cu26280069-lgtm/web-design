# Shared setup and important notes

1. Install PHP 8.1+ and MySQL 8+ (or use a college/lab server). XAMPP is optional, not required.
2. Create the database by importing `schema.sql` into MySQL.
3. Copy `config/database.php` to your PHP project and change the database username/password.
4. Run a PHP example from its project root with `php -S localhost:8000 -t public` where applicable.
5. For web-server features (.htaccess, virtual hosts, HTTPS), use Apache; PHP's built-in server does not read `.htaccess`.
6. Email examples need Composer + PHPMailer + SMTP credentials. Never commit real credentials.
7. Upload examples require writable storage directories. Production uploads should be outside the public web root.
8. These are source-code lab solutions, not screenshots of execution on your laptop. Since MySQL/XAMPP/Apache are not installed on your stated setup, database/server-dependent tasks cannot be genuinely run there until those services are configured.
