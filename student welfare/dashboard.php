<?php
include_once "gui.php";
require "../include/cn.php";
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php
                include_once 'student.php';
                ?>
            </div>
            <!--//2nd column-->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-calendar-alt"></span>
                        Calendar of Activities
                    </div>
                    <div class="card-body">
                        <?php
                        include "../include/calendar.php";
                        ?>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-calculator"></span>
                        Number of Students by Course
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" class="img-fluid"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>
<script>
    $(document).ready(function(){
        var ctx = $("#myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["BSF", "BSED", "BEED", "BSHM", "BSBM", "BSCS", "BSIT", "TCP"],
                datasets: [{
                    label: '# of Students',
                    data: [ <?php
                        $sql = "SELECT COUNT(*) AS BSF FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE tblnoa.course = 'BSF'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSF'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BSED FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BSED'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSED'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BEED FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BEED'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BEED'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BSHM FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BSHM'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSHM'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BSBM FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BSBM'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSBM'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BSCS FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BSCS'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSCS'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS BSIT FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'BSIT'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['BSIT'];
                        ?>,
                        <?php
                        $sql = "SELECT COUNT(*) AS TCP FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano WHERE course = 'TCP'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_array();
                        echo $row['TCP'];
                        ?>],
                    backgroundColor: [
                        'rgba(0,0,128)',
                        'rgba(0,0,255)',
                        'rgba(51, 153, 51)',
                        'rgba(255,204,0)',
                        'rgba(102, 102, 153)',
                        'rgba(255,0,0)',
                        'rgba(255, 102, 0)',
                        'rgba(54, 162, 235, 1)',

                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
</script>
<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" type="text/javascript"></script>
</body>
</html>
