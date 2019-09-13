<?php
require_once "../include/cn.php";

include_once "../php-reports-master/src/PHPReports.php";

use PHPReports\PHPReports;
if (!isset($_SESSION)){
    session_start();
}
if (isset($_GET['nstp'])) {
    $nstp = test_input($_GET['nstp']);
    $date = $_GET['date'];
    if ($_GET['program'] == 'CWTS'){
        $prog = "Civic Welfare Training Service";
    }else{
        $prog = "Literacy Training Service";
    }
    $sql = "SELECT * FROM tblnstpenrollees WHERE nstp = '$nstp'";
    $result = $conn->query($sql)or die(mysqli_error($conn));
    if ($result->num_rows == 0) { // doesnt exist
        echo "<script>alert('This student doesnt exist'); window.history.back();</script>";
    } else {

        $pr = new PHPReports('89in68ze6h63vhkzrcvxbg5x');
        $pr->setTemplateId(1419);
        $pr->setOutputFileType(PHPReports::OUTPUT_DOCX);
        $pr->setOutputAction(PHPReports::ACTION_FORCE_DOWNLOAD);
        $pr->setOutputFileName('Certificate of ' . $_GET['name'] . '.docx');
        $pr->setTemplateVariables(
            array(
                'name' => $_GET['name'],
                'date' => $_GET['date'],
                'program'=>$prog,
                'nstp'=>$_SESSION['x'],
                'campusadmin'=>$_SESSION['campusadmin'],
                'director'=>$_SESSION['director'],
            ));
        $pr->generateReport();

    }
} else {
    header('Location: nstpenrollees.php');
}
