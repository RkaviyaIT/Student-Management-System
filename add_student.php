
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
}


$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";


$data=new mysqli($host,$user,$password,$db);


if(isset($_POST['add_student'])){
    $username=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $usertype="student";
    $class_id = $_POST['class_id'];

$check="SELECT * FROM user WHERE username='$username' ";

$check_user=mysqli_query($data,$check);


$row_count=mysqli_num_rows($check_user);

if($row_count>=1){
    echo "<script type='text/javascript'> 
    alert('Username already Exist.Try another name'); 
    </script> ";
}else{

$sql="INSERT INTO user(username,email,phone,usertype,password,class_id) VALUES ('$username','$email','$phone','$usertype','$password','$class_id')";


$res=mysqli_query($data,$sql);

if($res){
    echo "<script type='text/javascript'> 
    alert('Data uploaded successfully'); 
    </script> ";
}else{
    echo "Upload Failed";
}
}
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Dashboard</title>

        <style type="text/css">
        label{
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg{
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
        </style>
        <?php 
        include 'admin_css.php';
        ?>
    </head>
    <body>
    <?php
        include 'admin_sidebar.php';
    ?>
        <div class="content">
        <center>    
            <h1>Add student </h1>


            <div class="div_deg">
            <form action="" method="POST">
               
            <div>
                <label>Username</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone">
            </div>
            <div>
                <label>Password</label>
                <input type="text" name="password">
            </div>
            <div>
                <label>Class</label>
                <select name="class_id" required>
                    <option value="">Select Class</option>
                    <?php
                    $sql = "SELECT * FROM class";
                    $result = mysqli_query($data, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" name="add_student" value="Add Student" >

            </div>

            </form>
            </div>
        
        </center>
        </div>
    </body>
</html>