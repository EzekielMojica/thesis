<?php
include_once "gui.php";
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['register'])) {
    $name = test_input($_POST['fname']) . " " . test_input($_POST['lname']);
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $sql = "INSERT INTO tbllogin (name, username, password) VALUES ('$name', '$username', '$password')";
    $result = $conn->query($sql);
    echo "<script>alert('record successfully added!')</script>";
}

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-calendar-alt"></span>
                Register
            </div>
            <div class="card-body">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="fname">First Name:</label>
                        <div class="col-md-10">
                            <input id="fname" type="text" name="fname" class="form-control" placeholder="First Name"
                                   pattern="[a-zA-Z ]{2,30}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="lname">Last Name:</label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name"
                                       pattern="[a-zA-Z ]{2,30}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="username">Username:</label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="password">Password:</label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="password" name="password" minlength="6" class="form-control"
                                       placeholder="Password"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
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


