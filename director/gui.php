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
    <title>OSAS Director | Dashboard</title>
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
        Office of the Student Affairs Director | <?php echo $_SESSION["x"] ?>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav scroll" id="accordion" style="overflow: auto" >
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <span class="fas fa-tachometer-alt"></span>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Account Management">
                <a class="nav-link" href="account.php">
                    <span class="fas fa-user"></span>
                    <span class="nav-link-text">Account Management</span>
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
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload Files">
                        <a class="nav-link" href="download.php">
                            <span class="fas fa-file"></span>
                            <span class="nav-link-text">Upload Files</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload Files">
                        <a class="nav-link" href="lostandfound.php">
                            <span class="fas fa-shopping-basket"></span>
                            <span class="nav-link-text">Lost and Found</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
                        <a class="nav-link" href="settings.php">
                            <span class="fas fa-cogs"></span>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
                <a class="nav-link" href="messages.php">
                    <span class="fas fa-envelope"></span>
                    <span class="nav-link-text">Messages</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evaluation Form">
                <a class="nav-link" href="seminar.php">
                    <span class="fas fa-clipboard"></span>
                    <span class="nav-link-text">Seminars Attended</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evaluation Form">
                <a class="nav-link" href="noa.php">
                    <span class="fas fa-file"></span>
                    <span class="nav-link-text">N.O.A</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evaluation Form">
                <a class="nav-link" href="incoming.php">
                    <span class="fas fa-file"></span>
                    <span class="nav-link-text">Letters/Memo</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Audit Trail">
                <a class="nav-link" href="audittrail.php">
                    <span class="fas fa-search"></span>
                    <span class="nav-link-text">Audit Trail of Transaction</span>
                </a>
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
