<?php
error_reporting(0);
session_start();
session_destroy();

if($_SESSION['message']){
    $message=$_SESSION['message'];
    echo "<script type='text/javascript'>

     alert('$message');
    </script>";
}


$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";


$data=new mysqli($host,$user,$password,$db);

$sql="SELECT * FROM teacher";

$res=mysqli_query($data,$sql);
?>





<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <nav>
            <label class="logo">W-School</label>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="#adm">Admission</a></li>
                <li><a href="login.php" class="btn btn-success">Login</a></li>
            </ul>
        </nav>
        <div class="section1">
            <label class="img_txt">We teach Students With Care</label>
           <img class="mainimg" src="school.png">
        </div>
        <div class="container">
            <div class="row">

            <div class="col-md-4">
               <img class="welcom_img" src="playground.jpg">
            </div>

            <div class="col-md-8">
             <h1>Welcome to our W-School!</h1>
             <p>Lorem ipsum dolor sit amet consectetur adipisicing 
                elit. Nihil vel ipsa exercitationem? Ratione at 
                nesciunt dignissimos omnis consequuntur impedit 
                voluptate. Quibusdam animi perferendis qua
                e saepe illum consectetur quis officia delectus?Lorem ips
                um dolor sit amet consectetur, adipisicing elit.
                 Sed, eos nostrum odio soluta labore quae mollitia? Illo ratione doloremque sapiente ad unde tenetur, modi, debitis dolorum quidem, vero quos id.</p>
            </div>
            </div>
        </div>
        <center>
            <h1>Our Teachers</h1>
        </center>
        <div class="container">
            <div class="row">

            <?php
                
                while($info=$res->fetch_assoc()){
            ?>
                <div class="col-md-4">
                  <img class="teacher" src="<?php echo "{$info['image']}" ?>">
                  <h3><?php echo "{$info['name']}" ?></h3>

                  <h5><?php echo "{$info['description']}" ?></h5>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <center>
            <h1>Our Courses</h1>
        </center>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="teacher" src="digital_marketing.png">

                      <h1>Digital Marketing Course</h1>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="graphic_design.png">
                  <h1>Graphic designing Course</h1>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="web_development.png">
                    <h1>Web Development Course</h1>
                </div>
            </div>
        </div>
        <center><h1 class="adm">Admission Form</h1></center>
        <div align="center" class="admission_form">
            <form action="data_check.php" method="POST">
                <div class="adm_int">
                    <label class="label_text">Name</label>
                    <input class="input_deg" type="text" name="name">
                </div>
                <div class="adm_int">
                    <label class="label_text">Email</label>
                    <input class="input_deg" type="text" name="email">
                </div>
                <div class="adm_int">
                    <label class="label_text">Phone</label>
                    <input class="input_deg" type="text" name="phone">
                </div>
                <div class="adm_int">
                    <label class="label_text">Message</label>
                    <textarea class="input_txt" name="message"></textarea>
                </div>
                <div class="adm_int">
                    <input class="btn btn-primary" id="submit" type="submit" value="Apply" name="apply">
                </div>
            </form>

        </div>
        <footer >
            <h3 class="footer_text">All @copyright reserved by web tech knowledge</h3>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    </body>
</html>