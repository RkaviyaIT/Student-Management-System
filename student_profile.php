
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}

$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";

$data=new mysqli($host,$user,$password,$db);

$name=$_SESSION['username'];

$sql="SELECT * FROM user WHERE username='$name' ";


$result=mysqli_query($data,$sql);

$info=mysqli_fetch_assoc($result);


if(isset($_POST['update_profile'])){

    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];


    $query="UPDATE user SET email='$email',phone='$phone' , password='$password' WHERE username='$name' ";

    $result2=mysqli_query($data,$query);

    if($result2){
      header("location:student_profile.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Student Dashboard</title>
        <?php
         include 'student_css.php';
       ?>

<style type="text/css">
            label{
                display: inline-block;
                width: 100px;
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: right;
            }

            .div_deg{
                background-color: skyblue;
                width: 400px;
                padding-top: 70px;
                padding-bottom: 70px;
            
            }
        </style>
    </head>
    <body>
       <?php
         include 'student_sidebar.php';
       ?>

       <div class="content">

       <center>
        <h1>Update Profile</h1><br><br>
       <form action="#" method="POST">
        <div class="div_deg">

                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo "{$info['email']}"; ?> ">
                    </div>

                    <div>
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?php echo "{$info['phone']}"; ?> ">
                    </div>

                    <div>
                        <label>PassWord</label>
                        <input type="text" name="password" value="<?php echo "{$info['password']}"; ?> ">
                    </div>

                    <div>
                        
                        <input class="btn btn-success" type="submit" name="update_profile" value="update">
                    </div>
        </div>
                </form>
       </center>
       </div>

    
    </body>
</html>