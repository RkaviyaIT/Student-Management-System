<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login form</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body background="playground.jpg" class="body_deg">
        <center>

        <div class="form_deg">
<center class="title_deg">Login Form
    <h4>
        <?php
        error_reporting(0);
        session_start();
        session_destroy();
        echo $_SESSION['loginMessage'];
        ?>
    </h4>
</center>
<form action="login_check.php" method="POST" class="login_form"> 
    <div>
       <label class="label_deg" >Username</label>
       <input type="text" name="username">

    </div>
    <div>
        <label class="label_deg">Password</label>
        <input type="password" name="password">
    </div>

    <div>
        
        <input type ="submit" name="submit" value="login" class="btn btn-primary">

    </div>
</form>

        </div>

        </center>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    </body>
</html>