<?php
require 'db_connect.php';
$pdo=getDbConnection();
$id=(int)($_GET['id']??0);
$pdo->prepare("DELETE FROM students WHERE id=?")->execute([$id]);
header("Location: db_list_students.php");