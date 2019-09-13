<?php
require_once "include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['newsnum']) && !isset($_SESSION['logid'])) {
    header('Location: news.php');
    exit;
} else {
    $newsnum = test_input($_POST['newsnum']);
    $title = test_input($_POST['title']);
    $newsdate = test_input($_POST['newsdate']);
    $content = $_POST['content'];

    $sql = "UPDATE tblnews SET title = '$title', newsdate = '$newsdate', content = '$content' WHERE newsnum='".$_POST['newsnum']."'";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a news record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: news.php');
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}