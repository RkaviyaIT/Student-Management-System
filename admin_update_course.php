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

if (isset($_GET['course_id'])) {
    $id = $_GET['course_id'];
    $sql="SELECT * FROM courses WHERE id='$id'";
    $result=mysqli_query($data,$sql);
    $info=$result->fetch_assoc();
}

if(isset($_POST['update_course'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $teacher_id=$_POST['teacher_id'];
    $class_id=$_POST['class_id'];

    $query="UPDATE courses SET name='$name', description='$description', teacher_id='$teacher_id', class_id='$class_id' WHERE id='".$_GET['course_id']."'";

    $result2=mysqli_query($data,$query);

    if($result2){
        echo "<script type='text/javascript'>
            alert('Course updated successfully');
        </script>";
        header("location:admin_view_course.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Course</title>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <center>
        <h1>Update Course</h1>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label>Course Name</label>
                    <input type="text" name="name" value="<?php echo $info['name']; ?>" required>
                </div>
                <div>
                    <label>Description</label>
                    <textarea name="description" required><?php echo $info['description']; ?></textarea>
                </div>
                <div>
                    <label>Teacher</label>
                    <select name="teacher_id" required>
                        <?php
                        $sql = "SELECT * FROM teacher";
                        $result = mysqli_query($data, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $selected = ($row['id'] == $info['teacher_id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                        }
                        ?>
                    </select>
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
                    <input type="submit" name="update_course" value="Update Course" class="btn btn-primary">
                </div>
            </form>
        </div>
        </center>
    </div>
</body>
</html>