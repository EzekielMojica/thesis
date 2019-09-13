<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head lang="en">

    <link rel="shortcut icon" href="../pictures/icon.ico">
    <title>Institutional Student Program and Services | Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/moment.js"></script>
    <script src="../fullcalendar-3.9.0/fullcalendar.js"></script>
    <script src="../DataTables/datatables.min.js"></script>
    <script src="//cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="../fullcalendar-3.9.0/fullcalendar.css">
    <link rel="stylesheet" href="../fullcalendar-3.9.0/fullcalendar.print.css" media="print">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css">

</head>
<body class="fixed-nav sticky-footer bg-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">
        <img src="../pictures/icon.ico" width="50" height="50" class="pull-left">
        Institutional Student Programs and Services | <?php echo $_SESSION["x"] ?>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="accordion" style="overflow: auto">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <span class="fas fa-tachometer-alt"></span>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admission">
                <a class="nav-link" href="admission.php">
                    <span class="fas fa-users"></span>
                    <span class="nav-link-text">Admission</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Scholarship">
                <a class="nav-link" href="scholarship.php">
                    <span class="fas fa-graduation-cap"></span>
                    <span class="nav-link-text">Scholarship</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="PWD">
                <a class="nav-link" href="pwd.php">
                    <span class="fas fa-wheelchair"></span>
                    <span class="nav-link-text">PWD</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Solo Parent">
                <a class="nav-link" href="soloparent.php">
                    <span class="fas fa-user"></span>
                    <span class="nav-link-text">Solo Parent</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Indigenous Group">
                <a class="nav-link" href="indigenous.php">
                    <span class="fas fa-users"></span>
                    <span class="nav-link-text">Indigenous Student</span>
                </a>
            </li>
           <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Special Student">
                <a class="nav-link" href="specialstudent.php">
                    <span class="fas fa-users"></span>
                    <span class="nav-link-text">Special Student</span>
                </a>
            </li> -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Foreign Student">
                <a class="nav-link" href="foreignstudent.php">
                    <span class="fas fa-plane"></span>
                    <span class="nav-link-text">Foreign Student</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Boarding House">
                <a class="nav-link" href="boardinghouse.php">
                    <span class="fas fa-home"></span>
                    <span class="nav-link-text">Boarding House</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evaluation Form">
                <a class="nav-link" href="seminar.php">
                    <span class="fas fa-clipboard"></span>
                    <span class="nav-link-text">Seminars Attended</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Others">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#others"
                   data-parent="#exampleAccordion">
                    <span class="fas fa-archive"></span>
                    <span class="nav-link-text">Others</span>
                </a>
                <ul class="sidenav-second-level collapse" id="others">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add News">
                        <a class="nav-link" href="balita.php">
                            <span class="fas fa-newspaper"></span>
                            <span class="nav-link-text">Add News</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Accomplishment Report">
                <a class="nav-link" href="accomplishmentreport.php">
                    <span class="fas fa-chart-bar"></span>
                    <span class="nav-link-text">Accomplishment Report</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <span class="fas fa-sign-out-alt"></span>
                    <span>Log out</span></a>
            </li>
        </ul>
    </div>
</nav>

