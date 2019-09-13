<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
?>

<div class="content-wrapper">
    <div class="container-fluid">
           <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSF Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSF" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSF'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_array()) {
                        echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSED Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSED" class="table display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSED'";
                        $result = $conn->query($sql);
                         while ($row = $result->fetch_array()) {
                        echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                    }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BEED Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BEED" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BEED'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_array()) {
                        echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                    }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSHM Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSHM" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSHM'";
                        $result = $conn->query($sql) or die(mysqli_error($conn));
                        while ($row = $result->fetch_array()) {
                        echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                    }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSBM Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSBM" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSBM'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                                <td>$row[studno]</td>
                                <td>$row[lastname], $row[firstname] $row[middlename]</td>
                                <td>$row[course]</td>
                                <td>$row[religion]</td>                     
                                <td>$row[contactno]</td>
                                <td>$row[facebook]</td>
                                <td>$row[email]</td>
                                <td>$row[barangay] $row[municipality], $row[city_province]</td>
                                <td class=\"text-center\">                     
                                        <a href='editstudent.php?studno=$row[studno]'><span class=\"fas fa-edit\"></span></a>
                                        <a href='javascript:gotoModal($row[studno]);'> <span class=\"fas fa-minus-circle\"></span> </a>               
                                </td>
                            </tr>";
                        }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSCS Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSCS" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSCS'";
                        $result = $conn->query($sql);
                         while ($row = $result->fetch_array()) {
                        echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                    }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    BSIT Students
                </div>
                <div class="card-body table-responsive">
                    <table id="BSIT" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'BSIT'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                        }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="fas fa-user"></span>
                    TCP Students
                </div>
                <div class="card-body table-responsive">
                    <table id="TCP" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Religion</th>
                                <th>Mobile No.</th>
                                <th>FB Account</th>
                                <th>E-Mail Address</th>
                                <th>Home Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE course = 'TCP'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                            <td>$row[studno]</td>
                            <td>$row[name]</td>
                            <td>$row[course]</td>
                            <td>$row[religion]</td>                     
                            <td>$row[contactno]</td>
                            <td>$row[facebook]</td>
                            <td>$row[email]</td>
                            <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        </tr>";
                        }
                        ?>  
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>


<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSF').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSED').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BEED').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSHM').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSBM').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSCS').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#BSIT').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#TCP').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return '<b>Total Number of Students:&nbsp;' + total + '</b>';
            },
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
