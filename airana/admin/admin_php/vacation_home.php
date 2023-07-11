<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['home_name']) && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['rating']) && isset($_POST['price']) && isset($_FILES['home_photo_1']) && isset($_FILES['home_photo_2']) && isset($_FILES['home_photo_3'])) {

    $home_name = $_POST['home_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $home_photo_1 = $_FILES['home_photo_1']['name'];
    $home_photo_2 = $_FILES['home_photo_2']['name'];
    $home_photo_3 = $_FILES['home_photo_3']['name'];

    try {
        // connect to airanaDB
        $conn = connect();

        //insert home name, available dates, and price
        $sql1 = "INSERT INTO VacationHome (name, startDate, endDate, price) VALUES (:name, :startDate, :endDate, :price)";
        $st1 = $conn->prepare($sql1);
        $st1->bindValue(":name", $home_name, PDO::PARAM_STR);
        $st1->bindValue(":startDate", $start_date, PDO::PARAM_STR);
        $st1->bindValue(":endDate", $end_date, PDO::PARAM_STR);
        $st1->bindValue(":price", $price, PDO::PARAM_INT);
        $st1->execute();

        // Get the last inserted ID
        $vhid = $conn->lastInsertId();

        //insert home rating
        $sql2 = "INSERT INTO Review (rating, vhid) VALUES (:rating, :vhid)";
        $st2 = $conn->prepare($sql2);
        $st2->bindValue(":rating", $rating);
        $st2->bindValue(":vhid", $vhid);
        $st2->execute();

        //insert home photos
        $sql3 = "INSERT INTO Photo (vhid, photo) VALUES (:vhid, :photo)";
        $st3 = $conn->prepare($sql3);
        $st3->bindValue(":vhid", $vhid, PDO::PARAM_INT);
        $st3->bindValue(":photo", $home_photo_1, PDO::PARAM_STR);
        $st3->execute();

        $sql4 = "INSERT INTO Photo2 (vhid, photo) VALUES (:vhid, :photo)";
        $st4 = $conn->prepare($sql4);
        $st4->bindValue(":vhid", $vhid, PDO::PARAM_INT);
        $st4->bindValue(":photo", $home_photo_2, PDO::PARAM_STR);
        $st4->execute();

        $sql5 = "INSERT INTO Photo3 (vhid, photo) VALUES (:vhid, :photo)";
        $st5 = $conn->prepare($sql5);
        $st5->bindValue(":vhid", $vhid, PDO::PARAM_INT);
        $st5->bindValue(":photo", $home_photo_3, PDO::PARAM_STR);
        $st5->execute();

        $conn = null;

        header("Location: /airana/admin/admin_html/admin_vacation_home.html");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
?>
