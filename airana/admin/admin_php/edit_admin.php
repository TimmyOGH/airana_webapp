<?php 
session_start();

require_once 'config.php';

$edit_admin_username = $_POST['edit_admin_username'];
$edit_admin_password = $_POST['edit_admin_password'];

$rowID = $_POST['editRowID'];

try {
    $conn = connect();
    $sql = "update Admin set username = :username, password = :password where aid = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":username", $edit_admin_username, PDO::PARAM_STR);
    $st->bindValue(":password", $edit_admin_password, PDO::PARAM_STR);
    $st->bindValue(":id", $rowID, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  
} catch (PDOException $e) { 
    $conn = null;
    die("Query failed: " . $e->getMessage());
}

header("Location: /airana/admin/admin_html/admin_account.html");
exit();
