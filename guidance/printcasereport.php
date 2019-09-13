<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT tbladmission.name, tblnoa.course, tblcasereport.* FROM tblcasereport INNER JOIN tblnoa ON tblcasereport.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
                           <th>Date</th>
                            <th>Semester</th>
                            <th>Name</th>
                            <th>Contact #</th>
                            <th>Course</th>
                            <th>Type</th>
                            <th>Status</th>
  </tr>
  </thead>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $ctr += 1;
        $output .= "
   <tr>
    <td>$ctr</td>        
                        <td>$row[date]</td>    
                        <td>$row[semester]</td> 
                        <td>$row[name]</td>
                        <td>$row[contactno]</td>  
                        <td>$row[course]</td>
                        <td>$row[type]</td>         
                        <td>$row[status]</td>
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=casereport.doc");
    echo $output;
}else{
    header("Location: studentoffence.php");
}
