<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.name, tblnoa.course, tblstudentasst.* FROM tblstudentasst INNER JOIN tblnoa ON tblstudentasst.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Office Assignment</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th>Supervisor</th>
                            <th>Resignation Date</th>
  </tr>
  </thead>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $ctr += 1;
        $output .= "
   <tr>
    <td>$ctr</td>      
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[office]</td>                     
                        <td>$row[startdate]</td>
                        <td>$row[status]</td>
                        <td>$row[supervisor]</td>
                        <td>$row[resigndate]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=studentassistant.doc");
    echo $output;
}else{
    header("Location: students.php");
}
