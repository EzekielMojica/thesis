<?php  
require "../include/cn.php";

$output = '';
$start = $_GET['start'];
$end = $_GET['end'];
$sql = "SELECT * FROM tblaccomplished WHERE (DATE(proposedate) >='$start' AND  DATE (proposedate) <= '$end')";
$result = $conn->query($sql);

if(mysqli_num_rows($result) > 0)
{
  $output .= ' <table border="1">
  <thead>
  <tr>
  <th>Activity No.</th>
  <th>Name of Organization</th>
  <th>Proposed Date</th>
  <th>Activity</th>
  <th>Name</th>
  <th>Date</th>
  <th>Participants</th>
  <th>Remarks</th>
  </tr>
  </thead>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <tr>
   <td>'.$row['accomplishedno'].'</td>
   <td>'.$row['orgname'].'</td>   
   <td>'.$row['proposedate'].'</td>     
   <td>'.$row['activity'].'</td>
   <td>'.$row['name'].'</td>
   <td>'.$row['date'].'</td>
   <td>'.$row['participants'].'</td>
   <td>'.$row['remarks'].'</td>
   </tr>
   ';
 }
 $output .= '</table>';
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=report.xls');
 echo $output;
}
