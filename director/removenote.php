<?php
include_once '../include/cn.php';
$noteno = $_GET['noteno'];
$sql = "DELETE FROM tblnote WHERE noteno = '$noteno'";
$conn->query($sql);
header("Location: dashboard.php");
