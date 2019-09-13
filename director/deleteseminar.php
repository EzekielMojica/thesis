<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_POST['id']) && !isset($_POST['password'])) {
        header('Location: seminar.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_POST['password'];
        $seminarNo = $_POST['id'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {

            $sql = "DELETE FROM tblseminar WHERE seminarno = '$seminarNo'";
            $conn->query($sql)  or die (mysqli_error($conn));

            //audit delete
            date_default_timezone_set('Asia/Manila');
            $user=$_SESSION["username"];
            $action = "Deleted a seminar attended record.";
            $dateandtime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
            $conn->query($sql) or die(mysqli_error($conn));

            echo "<script>alert('Seminar Record Successfully Deleted'); window.history.back();</script>";
        }
    }
}