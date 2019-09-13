<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.*, tblnoa.course, tblnstpenrollees.* FROM tblnstpenrollees INNER JOIN tblnoa ON tblnstpenrollees.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
              <th>Serial No.</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Course/Program</th>
                            <th>Gender</th>
                            <th>Birthdate</th>                   
                            <th>Provincial Address</th>                            
                            <th>Contact Number</th>
                            <th>E-mail</th>
  </tr>
  </thead>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $ctr += 1;
        $output .= "
   <tr>
    <td>$ctr</td>      
                         <td>$row[serialno]</td>
                        <td>$row[category]</td>
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[gender]</td>                     
                        <td>$row[dateofbirth]</td>                        
                        <td>$row[paddress]</td>
                        <td>$row[cellphone]</td>
                        <td>$row[email]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header('Content-Type: application/xls');
    header("Content-Disposition: attachment; filename=nstp.xls");
    echo $output;
}else{
    header("Location: indigenous.php");
}
