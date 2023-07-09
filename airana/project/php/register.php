<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg_username']) && isset($_POST['reg_email']) && isset($_POST['reg_pwd']) && isset($_POST['reg_conf_pwd'])) {
    $reg_email = $_POST['reg_email'];
    $reg_username = $_POST['reg_username'];
    $reg_pwd = $_POST['reg_pwd'];
    $reg_conf_pwd = $_POST['reg_conf_pwd'];

    try {
        // Check if username already exists
        $conn = connect();
        $getUsername = "SELECT * FROM User WHERE username = :username";
        $username_st = $conn->prepare($getUsername);
        $username_st->bindValue(":username", $reg_username, PDO::PARAM_STR);
        $username_st->execute();
        $usernameRes = $username_st->fetch();

        // Check if email already registered
        $getEmail = "SELECT * FROM User WHERE email = :email";
        $email_st = $conn->prepare($getEmail);
        $email_st->bindValue(":email", $reg_email, PDO::PARAM_STR);
        $email_st->execute();
        $emailRes = $email_st->fetch();

        $usernameValid = !$usernameRes;
        $emailValid = !$emailRes;
        $passwordValid = ($reg_pwd === $reg_conf_pwd);

        if ($usernameValid && $emailValid && $passwordValid) {
            // Insert new user data
            $insertData = "INSERT INTO User (username, password, email) VALUES (:username, :password, :email)";
            $insert_st = $conn->prepare($insertData);
            $insert_st->bindValue(":username", $reg_username, PDO::PARAM_STR);
            $insert_st->bindValue(":password", $reg_pwd, PDO::PARAM_STR);
            $insert_st->bindValue(":email", $reg_email, PDO::PARAM_STR);
            $insert_st->execute();

            $_SESSION['registerSuccess'] = true;
            header("Location: /airana/project/html/main.html");
        exit();
        } else {
            if (!$usernameValid) {
                $_SESSION['usernameExists'] = true;
            }
            if (!$emailValid) {
                $_SESSION['emailExists'] = true;
            }
            if (!$passwordValid) {
                $_SESSION['passwordsUnmatch'] = true;
            }
        }

        $conn = null;

        header("Location: /airana/project/html/register.html");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
