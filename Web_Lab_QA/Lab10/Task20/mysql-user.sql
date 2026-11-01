-- Run as a database administrator; replace the password.
CREATE USER 'webapp_user'@'localhost' IDENTIFIED BY 'REPLACE_WITH_LONG_RANDOM_PASSWORD';
GRANT SELECT, INSERT, UPDATE, DELETE ON webapp_db.* TO 'webapp_user'@'localhost';
FLUSH PRIVILEGES;
-- Do not use root credentials in the PHP application.
-- Add only narrowly scoped privileges if your application genuinely needs them.
