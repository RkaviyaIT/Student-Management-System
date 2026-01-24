
<?php
session_start();
error_reporting(0);
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

if (isset($_GET['teacher_id'])) 
    {
    $id = $_GET['teacher_id'];



$sql="SELECT * FROM teacher WHERE id='$id' ";


$result=mysqli_query($data,$sql);


$info=$result->fetch_assoc();

}

if(isset($_POST['update_teacher'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $file=$_FILES['image']['name'];

    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;

    move_uploaded_file($_FILES['image']['tmp_name'],$dst);


    if($file){

    $query="UPDATE teacher SET name='$name' , description='$description',image='$dst_db' WHERE id='".$_GET['teacher_id']."' ";

    }else{
        $query="UPDATE teacher SET name='$name' , description='$description' WHERE id='".$_GET['teacher_id']."' ";

    }
    $result2=mysqli_query($data,$query);

    if($result2){
      header("location:admin_view_teacher.php");
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
                width: 150px;
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: right;
            }

            .div_deg{
                background-color: skyblue;
                width: 600px;
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
            <h1>Update Teacher</h1>
            


            <div class="div_deg">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?teacher_id=' . $_GET['teacher_id']; ?>" method="POST" enctype="multipart/form-data">

                    

                    <div>
                        <label>Teacher Name</label>
                        <input type="text" name="name" value="<?php echo "{$info['name']}"; ?> ">
                    </div>

                    <div>
                        <label>description</label>
                        <textarea name="description" rows="4"><?php echo "{$info['description']}"; ?> </textarea>
                    </div>

                    <div>
                        <label>Teacher old image</label>
                        <img height="100px" width="100px" src="<?php echo "{$info['image']}"; ?> ">
                    </div>


                    <div>
                    <label>Teacher New image</label>
                        <input type="file" name="image" >
                    </div>

                    <div>
                        
                        <input class="btn btn-success" type="submit" name="update_teacher" value="update">
                    </div>

                </form>
            </div>
            </center>
        </div>
    </body>
</html>