<?php
require_once "../include/cn.php";

include_once "../php-reports-master/src/PHPReports.php";

use PHPReports\PHPReports;
if (!isset($_SESSION)){
    session_start();
}
if (isset($_GET['noano'])) {
    $noano = test_input($_GET['noano']);
    $sql = "SELECT * FROM tblnoa WHERE noano = '$noano' AND EXISTS (SELECT * FROM  tblstudentoffence WHERE noano = '$noano' AND status = 'Pending')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { // may offence
        echo "<script>alert('This student have offence record'); window.history.back();</script>";
    } else {
        $pr = new PHPReports('89in68ze6h63vhkzrcvxbg5x');
        $pr->setTemplateId(1403);
        $pr->setOutputFileType(PHPReports::OUTPUT_DOCX);
        $pr->setOutputAction(PHPReports::ACTION_FORCE_DOWNLOAD);
        $pr->setOutputFileName('Good-Moral ' . $_GET['name'] . '.docx');
        $pr->setTemplateVariables(
            array(
                'name' => $_GET['name'],
                'date' => $_GET['date'],
                'director'=>$_SESSION['director'],
            ));
        $pr->generateReport();
    }
} else {
    header('Location: goodmoral.php');
}
