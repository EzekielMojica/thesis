<?php
include_once '../include/cn.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['action']) or isset($_GET['view'])) {
    if (isset($_GET['view'])) {
        $start = test_input($_GET['start']);
        $end = test_input($_GET['end']);
        $subunit = $_SESSION['subunit'];
        if ($subunit == 'Director') {
            header('Content-Type: application/json');
            $sql = "SELECT eventid AS id, start_event AS start, end_event AS end, title FROM tblevent WHERE (DATE(start_event) >='$start' AND  DATE (start_event) <= '$end')";
            $result = $conn->query($sql) or die($conn->error);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
            exit;
        } else {
            header('Content-Type: application/json');
            $sql = "SELECT eventid AS id, start_event AS start, end_event AS end, title FROM tblevent WHERE (DATE(start_event) >='$start' AND  DATE (start_event) <= '$end') AND subunit = '$subunit'";
            $result = $conn->query($sql) or die($conn->error);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
            exit;
        }
    } elseif ($_POST['action'] == "add") {
        $title = test_input($_POST['title']);
        $venue = test_input($_POST['venue']);
        $description = test_input($_POST['description']);
        $start = $_POST['start'];
        $end = $_POST['end'];
        $subunit = $_POST['subunit'];
        $sql = "INSERT INTO tblevent(title, venue, description, start_event, end_event, subunit) VALUES ('$title', '$venue', '$description', '$start', '$end', '$subunit')";
        $result = $conn->query($sql);
        header('Content-Type: application/json');
        echo '{"id":"' . $conn->insert_id . '"}';
        exit;
    } elseif ($_POST['action'] == "select") {
        $id = test_input($_POST['id']);
        $sql = "SELECT eventid AS id, start_event AS start, end_event AS end, title, venue, description, subunit FROM tblevent WHERE eventid = '$id'";
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc() or die(mysqli_error($conn));
        echo json_encode($row);
        exit;
    } elseif ($_POST['action'] == "update") {
        $id = test_input($_POST['id']);
        $title = test_input($_POST['title']);
        $venue = test_input($_POST['venue']);
        $description = test_input($_POST['description']);
        $start = $_POST['start'];
        $end = $_POST['end'];
        $sql = "UPDATE tblevent SET title = '$title', venue = '$venue', description = '$description', start_event = '$start', end_event = '$end' WHERE eventid = '$id'";
        $conn->query($sql);
        $sql = "SELECT eventid AS id, start_event AS start, end_event AS end, title, venue, description FROM tblevent WHERE eventid = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        exit;
    } elseif ($_POST['action'] == "delete") {
        exit;
    }

}

