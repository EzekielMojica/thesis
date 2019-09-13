<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.*, tblnoa.course, tblindigenous.* FROM tblindigenous INNER JOIN tblnoa ON tblindigenous.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
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
                            <th>Indigenous Group</th>
                            <th>Course</th>
                            <th>Contact Number</th>
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
                        <td>$row[indigenousgroup]</td>
                        <td>$row[course]</td>
                        <td>$row[cellphone]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=indigenous.doc");
    echo $output;
}else{
    header("Location: indigenous.php");
}
