<?php
session_start();
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
echo 'Welcome, ' . htmlspecialchars($_SESSION['user_name'] ?? 'user', ENT_QUOTES, 'UTF-8');
