<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['offenceno'])){
    $offenceno=  test_input($_GET['offenceno']);
    $sql = "SELECT status FROM tblstudentoffence WHERE offenceno = '$offenceno'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    if ($row['status'] == "Cleared"){
        $status = "Pending";
    }else{
        $status = "Cleared";
    }
    $sql="UPDATE tblstudentoffence SET status = '$status' WHERE offenceno = '$offenceno'";
    $conn->query($sql);
    header('Location: studentoffence.php');

}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}