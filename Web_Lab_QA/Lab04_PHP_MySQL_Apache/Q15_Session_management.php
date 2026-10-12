<?php
session_start();
$_SESSION['user'] = 'amit';
echo "Logged in. <a href='s_page.php'>Go to page</a>";

<?php
session_start();
echo isset($_SESSION['user']) ? "Welcome, " . htmlspecialchars($_SESSION['user']) . " <a href='s_logout.php'>Logout</a>" : "Please login first.";

<?php
session_start(); session_unset(); session_destroy();
echo "Logged out.";
