<?php
session_start();
//audit logout
require_once "../include/cn.php";
date_default_timezone_set('Asia/Manila');
$user = $_SESSION["username"];
$action = "Logged out";
$dateandtime = date("Y-m-d H:i:s");
$sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
$conn->query($sql) or die();
session_destroy();
header("Location: ../index.php");