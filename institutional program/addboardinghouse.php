<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addBoardingHouse'])) {

    $bhousename = test_input($_POST['bhousename']);
    $landlord = test_input($_POST['landlord']);
    $address = test_input($_POST['address']);

    $sql = "INSERT INTO tblboardinghouse(bhousename, landlord, address) VALUES ('$bhousename', '$landlord', '$address')";
    $result = $conn->query($sql);

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a record in boarding house.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Boarding House record successfully added!');
        window.location='boardinghouse.php';
        </script>";
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
                <span class="fas fa-user-plus"></span>
                Add Boarding House
            </div>
            <div class="card-body">
                <form action="addboardinghouse.php" onsubmit="return validate_bhouse()" method="post">
                    <div class="form-group row" hidden="">
                        <label for="id" class="col-sm-2 col-form-label">ID:</label>
                        <div class="col">
                            <input name="id" type="text" disabled id="id" class="form-control"
                                        placeholder="ID"></div>
                    </div>
                    <div class="form-group row">
                        <label for="bhousename" class="col-sm-2 col-form-label">Name of the Boarding House:</label>
                        <div class="col">
                            <input name="bhousename" type="text" id="bhousename" class="form-control"
                                        placeholder="Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="landlord" class="col-sm-2 col-form-label">Landlord/Landlady:</label>
                        <div class="col">
                            <input name="landlord" type="text" class="form-control" id="landlord"
                                        placeholder="Landlord/Landlady"></div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col">
                            <input name="address" type="text" id="address" class="form-control"
                                        placeholder="Address"></div>
                    </div>  
                    <div class="text-center">
                        <input name="addBoardingHouse" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="boardinghouse.php" class="ml-5 btn btn-secondary">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>

<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>

</body>

</html>
