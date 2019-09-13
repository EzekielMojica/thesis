<?php

include_once '../include/cn.php';
$task = $_POST['task'];
$sql = "INSERT INTO tblnote (task) VALUES ('$task')";
$conn->query($sql);

//audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a note.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

header('Content-Type: application/json');
echo '{"id":"' . $conn->insert_id . '"}';
exit;