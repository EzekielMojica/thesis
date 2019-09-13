<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['itemno'])) {
    header('Location: lostfound.php');
    exit;
} else {
    $itemno = test_input($_GET['itemno']);
    $sql = "SELECT * FROM tbllostandfound WHERE itemno = '$itemno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: lostfound.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editLostandfound'])) {
    $itemno = test_input($_GET['itemno']);
    $datefound = test_input($_POST['datefound']);
    $foundby = test_input($_POST['foundby']);
    $time = test_input($_POST['time']);
    $itemname = test_input($_POST['itemname']);
    $quantity = test_input($_POST['quantity']);
    $description = test_input($_POST["description"]);
    $remarks = test_input($_POST["remarks"]);
    $owner = test_input($_POST["owner"]);
    $dateretrive = test_input($_POST["dateretrive"]);

    $sql = "UPDATE tbllostandfound SET datefound='$datefound' ,foundby='$foundby',time='$time', itemname='$itemname', quantity='$quantity', remarks='$remarks', owner='$owner', dateretrive= '$dateretrive',detail= '$description' WHERE itemno = '$itemno'";
    $conn->query($sql);

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a lost and found record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: lostfound.php');
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
                <span class="fas fa-shopping-basket"></span>
                Lost and Found
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="datefound">Date Found</label>
                        <input value="<?php echo $row['datefound']?>" name="datefound" type="text" id="datefound"
                               class="form-control"
                               placeholder="YYYY-MM-DDD"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    </div>
                    <div class="form-group">
                        <label for="foundby">Found By</label>
                        <input value="<?php echo $row['foundby']?>" type="text" name="foundby" class="form-control" id="foundby"
                               placeholder="Found By">
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input value="<?php echo $row['time']?>" name="time" type="text" id="time"
                               class="form-control"
                               placeholder="HH:MM"
                               pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])">
                    </div>
                    <div class="form-group">
                        <label for="itemname">Item Name</label>
                        <input value="<?php echo $row['itemname']?>" type="text" name="itemname" class="form-control" id="itemname"
                               placeholder="Item Name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input value="<?php echo $row['quantity']?>" type="text" name="quantity" class="form-control" id="quantity"
                               placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea name="description" class="form-control mb-3" id="description" rows="6"><?php echo $row['detail']?>"</textarea>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Remarks</label>
                        <select value="<?php echo $row['remarks']?>" name="remarks" class="form-control" id="remarks">
                            <option value="">Remarks</option>
                            <optgroup>
                                <option value="Claimed">Claimed</option>
                                <option value="Unclaimed">Unclaimed</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Owner</label>
                        <input  value="<?php echo $row['owner']?>" type="text" name="owner" class="form-control" id="owner"
                               placeholder="Owner">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Date Retrieved</label>
                        <input  value="<?php echo date("Y-m-d")?>" type="text" name="dateretrive" class="form-control" id="dateretrive"
                               placeholder="Date Retrieved">
                    </div>
                    <div class="text-center">
                        <input name="editLostandfound" type="submit" class="mr-5 btn btn-primary" value="Edit">
                        <input type="button" value="Go Back" onclick="window.history.back()"
                               class="ml-5 btn btn-secondary">
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
