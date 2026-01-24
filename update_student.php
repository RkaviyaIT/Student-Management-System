
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

if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];
} else {
    echo "Error: student_id is not set.";
    exit;
}


$sql="SELECT * FROM user WHERE id='$id' ";


$result=mysqli_query($data,$sql);

$info=$result->fetch_assoc();


if(isset($_POST['update'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $class_id = $_POST['class_id'];


    $query="UPDATE user SET username='$name' , email='$email',phone='$phone' , password='$password', class_id='$class_id' WHERE id='$id' ";

    $result2=mysqli_query($data,$query);

    if($result2){
      header("location:view_student.php");
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Dashboard</title>
        <?php 
        include 'admin_css.php';
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
        include 'admin_sidebar.php';
    ?>
   
        <div class="content">
        <center>
            <h1>Update Student</h1>
            


            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>UserName</label>
                        <input type="text" name="name" value="<?php echo "{$info['username']}"; ?> ">
                    </div>

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
                        <label>Class</label>
                        <select name="class_id" required>
                            <?php
                            $sql = "SELECT * FROM class";
                            $result = mysqli_query($data, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = ($row['id'] == $info['class_id']) ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        
                        <input class="btn btn-success" type="submit" name="update" value="update">
                    </div>

                </form>
            </div>
            </center>
        </div>
    </body>
</html>