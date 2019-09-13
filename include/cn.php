<?php
    $conn = new mysqli("localhost", "id7572975_osas2", "admin", "id7572975_osas2");
    if ($conn ->connect_error){
       die(mysqli_connect_error());
    }
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}