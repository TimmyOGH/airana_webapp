<?php 
session_start();

require_once 'config.php';

$rowID = $_POST['deleteRowID'];

try {
    $conn = connect();
    $sql = "delete from Admin where aid = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $rowID, PDO::PARAM_INT);
    $st->execute();

    $resetAutoIncre = "alter table Admin auto_increment = :rowID";
    $reset_st = $conn->prepare($resetAutoIncre);
    $reset_st->bindValue(":rowID", $rowID, PDO::PARAM_INT);
    $reset_st->execute();

    $conn = null;
  
} catch (PDOException $e) { 
    $conn = null;
    die("Query failed: " . $e->getMessage());
}

header("Location: /airana/admin/admin_html/admin_account.html");
exit();
