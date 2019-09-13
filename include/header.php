<?php
require_once "cn.php";
session_start();

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbllogin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    if ($result->num_rows == 0) { //no result
        echo "<script>
    		    alert('Username or Password didn\'t matched!');
    		    history.go(-1);
    		</script>
    		";
    } else {
        switch ($row['id']) {
            case 1:
                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "Director";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: director/dashboard.php");
                break;
            case 2:
                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "Student Welfare";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: student welfare/dashboard.php");
                break;
            case 3:
                $sql1 = "SELECT name FROM tblsettings WHERE position='OSAS Director'";
                $result1 = $conn->query($sql1) or die(mysqli_error($conn));
                $row1 = $result1->fetch_array();
                $_SESSION['director'] = $row1['name'];
                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "Guidance";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: guidance/dashboard.php");
                break;
            case 4:
                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "Student Development";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: student development/dashboard.php");
                break;
            case 5:
                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "Institutional Program";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: institutional program/dashboard.php");
                break;
            case 6:
                $sql1 = "SELECT name FROM tblsettings WHERE position='OSAS Director'";
                $result1 = $conn->query($sql1) or die(mysqli_error($conn));
                $row1 = $result1->fetch_array();
                $_SESSION['director'] = $row1['name'];

                $sql1 = "SELECT name FROM tblsettings WHERE position='Campus Administrator'";
                $result1 = $conn->query($sql1) or die(mysqli_error($conn));
                $row1 = $result1->fetch_array();
                $_SESSION['campusadmin'] = $row1['name'];

                $_SESSION["username"] = $username;
                $_SESSION["x"] = $row['name'];
                $_SESSION["subunit"] = "NSTP";
                $_SESSION["logid"] = $row['id'];
                //audit login
                date_default_timezone_set('Asia/Manila');
                $user=$_SESSION["username"];
                $action = "Logged in";
                $dateandtime = date("Y-m-d H:i:s");
                $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
                $conn->query($sql) or die();

                header("Location: nstp/dashboard.php");
                break;
        }

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="pictures/icon.ico">
    <title>CvSU Naic OSAS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="fullcalendar-3.9.0/fullcalendar.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome-all.min.css">
    <?php
    if (isset($_GET['newsnum'])){
        echo "<head>
    <meta property=\"og:url\"           content=\"https://cvsunaicosas.000webhostapp.com/morenews.php?newsnum=$_GET[newsnum]\" />
    <meta property=\"og:type\"          content=\"website\" />
    <meta property=\"og:title\"         content=\"$row[title]\" />
    <meta property=\"og:description\"   content=\"".htmlspecialchars($row['content'])."\" />
    <meta property=\"og:image\"         content=\"https://cvsunaicosas.000webhostapp.com/$row[path]\" />
</head>";
    }
    ?>
</head>
<body>
<div>
    <img src="pictures/OSAS Banner1.png" alt="Banner" width="100%" class="img-fluid">
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href=index.php style="color: black;">Home</a></li>
            <li class="nav-item"><a class="nav-link" href=about.php style="color: black;">About Us</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   href="#" style="color: black;">Admission</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admission.php">Admission Procedure</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="course.php">Course Offerings</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href=news.php style="color: black;">News Archive</a></li>
            <li class="nav-item"><a class="nav-link" href=studentorgs.php style="color: black;">Student Orgs</a></li>
            <li class="nav-item"><a class="nav-link" href=downloads.php style="color: black;">Downloads</a></li>
            <li class="nav-item"><a class="nav-link" href=contact.php style="color: black;">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href=lostandfound.php style="color: black;">Lost &amp; Found</a>
            </li>
        </ul>

        <?php
        if (isset($_SESSION['logid'])) {
            switch ($_SESSION['logid']){
                case 1:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"director/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
                case 2:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"student welfare/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
                case 3:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"guidance/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
                case 4:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"student development/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
                case 5:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"institutional program/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
                case 6:
                    echo "<span class=\"navbar-text\" style=\"color: black\">
                          <a class=\"nav-link\" href=\"nstp/dashboard.php\">
                          <span class=\"fas fa-arrow-alt-circle-right\"></span>
                          <span>Back to Dashboard</span></a>
                          </span>";
                    break;
            }
        } else {
            echo '
              <form class="form-inline navbar-right" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"
              method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button type="submit" name="login" class="btn btn-success">Login</button>
            </div>
        </form>
            ';
        }
        ?>


    </div>
</nav>


