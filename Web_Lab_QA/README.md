# Web Design Practical – Lab 09 and Lab 10

This ZIP contains source-code answers for all 20 tasks in Lab 09 and all 20 tasks in Lab 10, based on the two supplied assignment sheets.

## Folder contents
- `Lab09/Task01` … `Lab09/Task20`: individual PHP/SQL/JavaScript examples.
- `Lab10/Task01` … `Lab10/Task20`: individual Git/PHP/MVC/API/security/Apache examples.
- `shared/schema.sql`: MySQL schema for users, products, orders and order items.
- `shared/config/database.php`: PDO connection template.
- `shared/config/helpers.php`: output escaping, login and CSRF helpers.
- `shared/README_SETUP.md`: setup instructions and important limitations.

## Before running
- Update the database username/password in `shared/config/database.php`.
- Import `shared/schema.sql` into MySQL for database exercises.
- A few tasks require Apache, SMTP/PHPMailer, HTTPS, or GitHub configuration; follow the notes in each task.
- Never upload real passwords, API tokens, SMTP credentials, or private keys to GitHub.

## Important for your laptop
You previously said XAMPP and MySQL are not installed. These files are the code deliverables, but database and Apache tasks cannot be genuinely executed on that laptop until the required services are installed/configured. This ZIP does not pretend to contain real VS Code run screenshots or fabricated execution results.

## Upload to your repository
1. Extract this ZIP.
2. Open your GitHub repository and open `Web_Lab_QA`.
3. Choose **Add file → Upload files**.
4. Upload the two folders `Lab09` and `Lab10` plus `README.md`, `.gitignore`, and `shared`.
5. Scroll down and click **Commit changes**.
