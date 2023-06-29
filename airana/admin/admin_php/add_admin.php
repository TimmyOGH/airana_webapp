<?php
session_start();

require_once 'config.php';

$add_admin_username = $_POST['add_admin_username'];
$add_admin_password = $_POST['add_admin_password'];

try {
  $conn = connect();
  $sql = "insert into Admin (username, password) values (:username, :password)";
  $st = $conn->prepare($sql);
  $st->bindValue(":username", $add_admin_username, PDO::PARAM_STR);
  $st->bindValue(":password", $add_admin_password, PDO::PARAM_STR);
  $st->execute();
  $conn = null;

} catch (PDOException $e) { 
  $conn = null;
  die("Query failed: " . $e->getMessage());
}

header("Location: /airana/admin/admin_html/admin_account.html");
exit();
?>