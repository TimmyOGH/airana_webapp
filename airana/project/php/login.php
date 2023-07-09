<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_username']) && isset($_POST['login_pwd'])) {
    $login_username = $_POST['login_username'];
    $login_pwd = $_POST['login_pwd'];

    try {
        // check if username and password match a record in the database
        $conn = connect();
        $getSingleRow = "SELECT * FROM User WHERE username = :username AND password = :password";
        $st = $conn->prepare($getSingleRow);
        $st->bindValue(":username", $login_username, PDO::PARAM_STR);
        $st->bindValue(":password", $login_pwd, PDO::PARAM_STR);
        $st->execute();
        $res = $st->fetch();

        if ($res) {
            $_SESSION['loginSuccess'] = true;
            header("Location: /airana/project/html/main.html");
            exit();
        } else {
            $_SESSION['loginFailure'] = true;
            header("Location: /airana/project/html/login.html");
            exit();
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
?>
