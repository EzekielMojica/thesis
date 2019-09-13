<?php
require "../include/cn.php";

$output = '';
$ctr=0;
$formula ='=';

$sql = "SELECT * FROM tblboardinghouse ORDER BY id";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>No.</th>
              <th>Boarding House\'s Name</th>
                            <th>Landlord/Landlady</th>
                            <th>Address</th>
  </tr>
  </thead>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $ctr += 1;
        $output .= "
   <tr>
    <td>$ctr</td>      
                       <td>$row[bhousename]</td>
                            <td>$row[landlord]</td>
                            <td>$row[address]</td>  
   </tr>
   ";
    }
    $output .= '</table>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=boardinghouse.doc");
    echo $output;
}else{
    header("Location: boardinghouse.php");
}
