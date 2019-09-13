<?php  
require "../include/cn.php";

$output = '';
$ctr=1;
$formula ='=';
$sql = "SELECT type, COUNT(type) AS noofscholar FROM tblscholarship GROUP BY type";
$result = $conn->query($sql);

if(mysqli_num_rows($result) > 0)
{
  $output .= ' <table border="1">
  <thead>
  <tr>
  <th>Type of Scholarship</th>
  <th>No. of Scholar</th>
  </tr>
  </thead>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $ctr+=1;
   $output .= '
   <tr>
   <td>'.$row['type'].'</td>
   <td>'.$row['noofscholar'].'</td>   
   </tr>
   ';
 }
  $output .= '
   <tr>
   <td><b>Total:</b></td>
   ';
   for ($i=2; $i <=$ctr ; $i++) {
     if($i == $ctr){
      $formula .= 'B'.$i;
      break;
    } 
    $formula .= 'B'.$i.'+';
   }
    $output.='<td>'.$formula.'</td>';
   $output.='</tr>';
 $output .= '</table>';
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=summary.xls');
 echo $output;
}else{
    header("Location:scholarship.php");
}
