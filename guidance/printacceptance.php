<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.name, tblnoa.course, tblacceptanceslip.* FROM tblacceptanceslip INNER JOIN tblnoa ON tblacceptanceslip.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Semester</th>
                            <th>Reason</th>
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
                        <td>$row[date]</td>          
                        <td>$row[semester]</td>           
                        <td>$row[reason]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=acceptanceslip.doc");
    echo $output;
}else{
    header("Location: studentoffence.php");
}
