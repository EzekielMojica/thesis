<?php
require "../include/cn.php";
if (isset($_GET['eventname'])) {
    $keyword = $_GET['eventname'];
    $eventname = array();
    $sql = "SELECT * FROM tblevent WHERE title LIKE '" . $keyword . "%'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $eventname[] = $row['title'];
    }
    echo json_encode($eventname);
}