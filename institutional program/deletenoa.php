<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_GET['noano']) && !isset($_GET['password'])) {
        header('Location: noa.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_GET['password'];
        $noaNo = $_GET['noano'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {
            $sql = "DELETE FROM tblnoa WHERE noano = '$noaNo";
            $result = $conn->query($sql)  or die (mysqli_error($conn));

            //audit delete
            date_default_timezone_set('Asia/Manila');
            $user=$_SESSION["username"];
            $action = "Deleted a NOA record.";
            $dateandtime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
            $conn->query($sql) or die(mysqli_error($conn));

            echo "<script>alert('Notice of Admission Successfully Deleted'); window.history.back();</script>";
        }
    }
}