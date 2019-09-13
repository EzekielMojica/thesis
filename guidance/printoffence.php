<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.name, tblnoa.course, tblstudentoffence.* FROM tblstudentoffence INNER JOIN tblnoa ON tblstudentoffence.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
              <th>Name</th>
                            <th>Course</th>
                            <th>Item Confiscated</th>
                            <th>Date Confiscated</th>
                            <th>Semester</th>
                            <th>Offense Commited</th>
                            <th>Penalty</th>
                            <th>Status</th>
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
                        <td>$row[itemconfiscated]</td>                     
                        <td>$row[dateconfiscated]</td>
                        <td>$row[semester]</td>
                        <td>$row[offencecommitted]</td>
                        <td>$row[penalty]</td>
                        <td>$row[status]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=studentoffence.doc");
    echo $output;
}else{
    header("Location: studentoffence.php");
}
