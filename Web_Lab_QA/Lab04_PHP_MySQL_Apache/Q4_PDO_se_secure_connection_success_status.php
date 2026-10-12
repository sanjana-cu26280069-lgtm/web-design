<?php
require 'db.php';
echo "Connected successfully to " . $pdo->query("SELECT DATABASE()")->fetchColumn();
