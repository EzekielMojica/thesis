<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['id'])) {
    header('Location: account.php');
    exit;
} else {
    $id = test_input($_GET['id']);
    $sql = "SELECT * FROM tbllogin WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: account.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editAccount'])) {

    $name = test_input($_POST['name']);
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    $sql = "UPDATE tbllogin SET name = '$name', username ='$username', password='$password' WHERE id='".$_GET['id']."'";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a case report record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: account.php');
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
                <span class="fas fa-calendar-alt"></span>
                Edit Account
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="fname">Name:</label>
                        <div class="col-md-10">
                            <input value="<?php echo "$row[name]"?>" id="name" type="text" name="name" class="form-control" placeholder="Name"
                                   pattern="[a-zA-Z .]{2,30}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="username">Username:</label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input value="<?php echo "$row[username]"?>" type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="password">Password:</label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input value="<?php echo "$row[password]"?>" type="password" name="password" minlength="6" class="form-control"
                                       placeholder="Password"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="editAccount" class="btn btn-primary">Edit</button>
                        <a href="account.php" class="ml-5 btn btn-secondary">Go Back</a>
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
