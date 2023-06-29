<?php 
// func to connect to DB
function connect() {
    $dsn = "mysql:dbname=airanaDB";
    $username = "root";
    $password = "4HISGlory";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
    return $conn;
}
?>
