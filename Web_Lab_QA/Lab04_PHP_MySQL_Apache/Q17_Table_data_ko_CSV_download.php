<?php
require 'db.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="students.csv"');
$out = fopen('php://output', 'w');
fputcsv($out, ['ID', 'Name', 'Email', 'Enrollment Date']);
foreach ($pdo->query("SELECT * FROM students") as $row) fputcsv($out, $row);
fclose($out);
