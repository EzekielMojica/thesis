<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
                <th>Name</th>
                <th>Course</th>
                <th>Religion</th>
                <th>Mobile No.</th>
                <th>FB Account</th>
                <th>E-Mail Address</th>
                <th>Home Address</th>
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
                        <td>$row[religion]</td>                     
                        <td>$row[contactno]</td>
                        <td>$row[facebook]</td>
                        <td>$row[email]</td>
                        <td>$row[barangay] $row[municipality], $row[city_province]</td>   
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=studentdirectory.doc");
    echo $output;
}else{
    header("Location: students.php");
}
