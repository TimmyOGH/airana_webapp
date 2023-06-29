<?php
session_start();

require_once 'config.php';

$admin_login_username = $_POST['admin_login_username'];
$admin_login_password = $_POST['admin_login_password'];

try {
    $conn = connect();
    $sql = "select * from Admin where username = :username and password = :password";
    $st = $conn->prepare($sql);
    $st->bindValue(":username", $admin_login_username, PDO::PARAM_STR);
    $st->bindValue(":password", $admin_login_password, PDO::PARAM_STR);
    $st->execute();

    $row = $st->fetch();
    $conn = null;

    if ($row) {
        // Set session variable to remember login status
        $_SESSION['adminLoggedIn'] = true;
    
        // Redirect to the same HTML file
        header("Location: /airana/admin/admin_html/admin_account.html");
        exit();
    
    } else {
        $_SESSION['loginError'] = '*username or password is incorrect*';
        header("Location: /airana/admin/admin_html/admin_account.html");
        exit();
    }

} catch (PDOException $e) {
    $conn = null;
    die("Query failed: " . $e->getMessage());
}
?>