<?php
include_once "include/header.php";
include_once "include/cn.php";
if (isset($_POST['addMessage'])){
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $message = test_input($_POST['message']);
    $sql = "INSERT INTO tblmessage VALUES (null, '$name', '$email', '$message')";
    $result = $conn->query($sql);
    echo "<script>alert('Message sent');</script>";
}
?>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ce"><br>
                <h1 class="text-center"><span id="icon" class="fas fa-info-circle"></span></h1>
                <h3 class="text-center">CAVITE STATE UNIVERSITY NAIC</h3>
                <p class="text-center"><b>Address:</b> Bucana, Naic, Cavite</p>
                <p class="text-center"><b>Tel. No. :</b> (046) 856-0943</p>
                <p class="text-center"><b>Fax. No. :</b> (046) 856-0942</p>
                <p class="text-center"><b>E-mail:</b> info@cvsu-naic.edu.ph</p>
                <h4><b><p class="text-center">Office of the Registrar</p></b></h4>
                <p class="text-center"><b>Tel. No. :</b> (046) 856-0401</p>
                <p class="text-center"><b>E-mail:</b> registrar@cvsu-naic.edu.ph</p>
            </div>
        </div>
        <div class="jumbotron" style="background-color: white">
            <form method="post">
                <div class="form-group">
                    <input required type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <input required type="email" name="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <textarea required name="message" class="form-control" rows="6" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                    <input name="addMessage" type="submit" class="btn btn-primary" value="Send">
                </div>
            </form>
        </div>
    </div>

</div>
<?php
include_once "include/footer.php";
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>
