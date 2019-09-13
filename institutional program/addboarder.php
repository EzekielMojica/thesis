<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['noano'])){
    $noano = test_input($_GET['noano']);
    $sql = "SELECT tbladmission.*, tblnoa.course FROM tblnoa INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE noano = '$noano'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
}else{
    header('Location: foreignstudent.php');
}
if (!isset($_GET['id'])){
    header("Location: boardinghouse.php");
}else{
    $id = $_GET['id'];
}
    $sql = "INSERT INTO tblboarder VALUES (null,'$id', '$noano')";
    $result = $conn->query($sql)or die (mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a boarder.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Student boarder record successfully added!');
        window.location='boarder.php?id=$id';
        </script>";

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}