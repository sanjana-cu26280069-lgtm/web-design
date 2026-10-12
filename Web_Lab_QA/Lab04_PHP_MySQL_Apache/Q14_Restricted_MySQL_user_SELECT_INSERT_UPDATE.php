CREATE USER 'webapp'@'localhost' IDENTIFIED BY 'StrongPass#123';
GRANT SELECT, INSERT, UPDATE ON college_db.* TO 'webapp'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'webapp'@'localhost';
