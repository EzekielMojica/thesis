<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {

    session_start();
    if (!isset($_GET['offenceno']) && !isset($_GET['password'])) {
        header('Location: studentoffence.php');
        exit;
    } else {
        $name = $_SESSION['x'];
        $password = $_GET['password'];
        $studentNum = $_GET['offenceno'];
        $sql = "SELECT * FROM tbllogin WHERE name = '$name' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) { // mali password
            echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
            exit;
        } else {
            $sql = "DELETE FROM tblstudentoffence WHERE offenceno = '$offenceNo'";
            $result = $conn->query($sql)  or die (mysqli_error($conn));
            echo "<script>alert('Student Offence Successfully Deleted'); window.history.back();</script>";
        }
    }
}