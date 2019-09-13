<?php
require_once "include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_POST['id']) && !isset($_POST['password'])) {
        header('Location: downloads.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_POST['password'];
        $downloadno = $_POST['id'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {

            $sql = "SELECT path FROM tbldownload WHERE downloadno = '$downloadno'";
            $result = $conn->query($sql)  or die (mysqli_error($conn));
            $row = $result->fetch_array();
            unlink($row['path']);

            $sql = "DELETE FROM tbldownload WHERE downloadno = '$downloadno'";
            $conn->query($sql)  or die (mysqli_error($conn));

            //audit delete
            date_default_timezone_set('Asia/Manila');
            $user=$_SESSION["username"];
            $action = "Deleted a downloadable file.";
            $dateandtime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
            $conn->query($sql) or die(mysqli_error($conn));

            echo "<script>alert('File Successfully Deleted'); window.history.back();</script>";
        }
    }
}