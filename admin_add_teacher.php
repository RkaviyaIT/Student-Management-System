
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

$data = new mysqli($host, $user, $password, $db);

if (isset($_POST['add_teacher'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Check if 'image' key exists and the file was uploaded successfully
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name']; // Temporary file path
        $dst = "./image/" . $file;
        $dst_db = "image/" . $file;

        // Move the uploaded file
        if (move_uploaded_file($temp_name, $dst)) {
            $sql = "INSERT INTO teacher (name, description, image) VALUES ('$name', '$description', '$dst_db')";

            $res = mysqli_query($data, $sql);

            if ($res) {
                echo "<script type='text/javascript'> 
                    alert('Data uploaded successfully'); 
                </script>";
            } else {
                echo "Upload Failed";
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
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
            <h1>Add Teacher</h1><br><br>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">

                <div>
                    <label>Teacher Name : </label>
                    <input type="text" name="name">
                </div><br>

                <div>
                    <label>Description :</label>
                    <textarea name="description"></textarea>
                </div><br>

                <div>
                    <label>Image :</label>
                    <input type="file" name="image">
                </div><br>


                <div>
                <input type="submit" class="btn btn-primary" name="add_teacher" value="Add Teacher" >

            </div>
                </form>
            </div>
            </center>
        </div>
    </body>
</html>