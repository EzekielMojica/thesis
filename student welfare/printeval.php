<?php
require "../include/cn.php";
$eventid = $_GET['eventid'];

$output = '';
$formula = '=';

$sql = "SELECT * FROM tblevent WHERE eventid = '$eventid'";
$result = $conn->query($sql);
$row = $result->fetch_array();

if (mysqli_num_rows($result) > 0) {
    $output .= ' <table border="1">
  <thead>
  <tr>
  <th>Particulars</th>
                            <th>Poor</th>
                            <th>Fair</th>
                            <th>Satisfactory</th>
                            <th>Very Satisfactory</th>
                            <th>Excellent</th>
                            <th>Total</th>
  </tr>
  </thead><tbody>
  ';
    $output .= "<tr><td class=\"text-left\">Meeting of your expectations</td>";
    $sql = "
                            SELECT
                            COUNT(IF(expectation = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(expectation = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(expectation = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(expectation = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(expectation = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(expectation) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }

    $output .= "</tr><tr><td class=\"text-left\">Attainment of the objectives</td>";
    $sql = "
                            SELECT
                            COUNT(IF(objective = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(objective = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(objective = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(objective = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(objective = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(objective) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }

    $output .= "</tr><tr> <td class=\"text-left\">Timeliness of the activity</td>";
    $sql = "
                            SELECT
                            COUNT(IF(timeliness = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(timeliness= 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(timeliness = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(timeliness = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(timeliness = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(timeliness) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }

    $output .= "</tr><tr><td class=\"text-left\">Topics included</td>";
    $sql = "
                            SELECT
                            COUNT(IF(topic = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(topic= 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(topic = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(topic = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(topic = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(topic) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }

    $output .= "</tr><tr>
                            <th colspan=\"7\">Methodologies used</th>
                        </tr>";


    $output .= "<tr><td>Activities</td>";
    $sql = "
                            SELECT
                            COUNT(IF(activities = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(activities = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(activities = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(activities = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(activities = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(activities) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }


    $output .= "</tr><tr> <td>Instructional/Presentation Aids</td>";
    $sql = "
                            SELECT
                            COUNT(IF(ims = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(ims = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(ims = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(ims = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(ims = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(ims) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }

    $output .= " <tr>
                            <th colspan=\"7\">Resource Speaker</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Poor</th>
                            <th>Fair</th>
                            <th>Satisfactory</th>
                            <th>Very Satisfactory</th>
                            <th>Excellent</th>
                            <th>Total</th>
                        </tr>";

    $sql = "SELECT name,
                            COUNT(IF(rate='Poor', 'YES', NULL)) AS Poor, 
                            COUNT(IF(rate = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(rate = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(rate = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(rate = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(rate) AS total FROM tblspeaker
                            WHERE eventid = $eventid GROUP BY name";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) {
        $output .= "<tr>";
        $output .= "<td>$row[name]</td>";
        $output .= "<td>$row[1]</td>";
        $output .= "<td>$row[2]</td>";
        $output .= "<td>$row[3]</td>";
        $output .= "<td>$row[4]</td>";
        $output .= "<td>$row[5]</td>";
        $output .= "<td>$row[6]</td>";
        $output .= "</tr>";
    }

    $output .= "<tr><td>Management Team</td></td>";
    $sql = "
                            SELECT
                            COUNT(IF(management = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(management = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(management = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(management = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(management = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(management) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }


    $output .= "</tr><tr><td>Venue</td>";
    $sql = "
                            SELECT
                            COUNT(IF(venue = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(venue = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(venue = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(venue = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(venue = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(venue) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }


    $output .= "</tr><tr><td>Food</td>";
    $sql = "
                            SELECT
                            COUNT(IF(food = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(food = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(food = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(food = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(food = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(food) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }



    $output .= "</tr><tr><td>Accommodation</td>";
    $sql = "
                            SELECT
                            COUNT(IF(accommodation = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(accommodation = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(accommodation = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(accommodation = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(accommodation = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(accommodation) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    for ($j = 0; $j < (count($row) / 2); $j++) {
        $output .= "<td>$row[$j]</td>";
    }
$output .="</tr></tbody></table>";
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=evaluationresult.doc");
    echo $output;
} else {
    header("Location: result.php?eventid=$eventid");
}
