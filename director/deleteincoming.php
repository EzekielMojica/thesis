<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_POST['id']) && !isset($_POST['password'])) {
        header('Location: incoming.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_POST['password'];
        $letterno = $_POST['id'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {

            $sql = "DELETE FROM tblincoming WHERE letterno = '$letterno'";
            $conn->query($sql)  or die (mysqli_error($conn));

            //audit delete
            date_default_timezone_set('Asia/Manila');
            $user=$_SESSION["username"];
            $action = "Deleted an incoming letter/memo record.";
            $dateandtime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
            $conn->query($sql) or die(mysqli_error($conn));

            echo "<script>alert('Letter/Memo Successfully Deleted'); window.history.back();</script>";
        }
    }
}