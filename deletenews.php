<?php
require_once "include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_POST['id']) && !isset($_POST['password'])) {
        header('Location: news.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_POST['password'];
        $newsnum = $_POST['id'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {

            $sql = "SELECT path FROM tblnews WHERE newsnum = '$newsnum'";
            $result = $conn->query($sql)  or die (mysqli_error($conn));
            $row = $result->fetch_array();
            unlink($row['path']);

            $sql = "DELETE FROM tblnews WHERE newsnum = '$newsnum'";
            $conn->query($sql)  or die (mysqli_error($conn));

            //audit delete
            date_default_timezone_set('Asia/Manila');
            $user=$_SESSION["username"];
            $action = "Deleted a news record.";
            $dateandtime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
            $conn->query($sql) or die(mysqli_error($conn));;

            echo "<script>alert('News Successfully Deleted')</script>";
            header("Location: news.php");
        }
    }
}