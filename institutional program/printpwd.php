<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.*, tblnoa.course, tblpwd.* FROM tblpwd INNER JOIN tblnoa ON tblpwd.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
             <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Course</th>
                            <th>Type</th>
  </tr>
  </thead>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $ctr += 1;
        $output .= "
   <tr>
    <td>$ctr</td>      
                       <td>$row[name]</td>
                        <td>$row[age]</td>                     
                        <td>$row[gender]</td>
                        <td>$row[address]</td>
                        <td>$row[cellphone]</td>
                        <td>$row[course]</td>
                        <td>$row[type]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=pwd.doc");
    echo $output;
}else{
    header("Location: pwd.php");
}
