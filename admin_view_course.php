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

$sql="SELECT courses.*, teacher.name AS teacher_name, class.name AS class_name FROM courses JOIN teacher ON courses.teacher_id = teacher.id JOIN class ON courses.class_id = class.id";

$result=mysqli_query($data,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Courses</title>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <h1>View Courses</h1>
        <table border="1px">
            <tr>
                <th style="padding:20px; font-size: 15px;">Course Name</th>
                <th style="padding:20px; font-size: 15px;">Description</th>
                <th style="padding:20px; font-size: 15px;">Teacher</th>
                <th style="padding:20px; font-size: 15px;">Class</th>
                <th style="padding:20px; font-size: 15px;">Delete</th>
                <th style="padding:20px; font-size: 15px;">Update</th>
            </tr>
            <?php while($info=$result->fetch_assoc()){ ?>
            <tr>
                <td style="padding:20px;"><?php echo "{$info['name']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['description']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['teacher_name']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['class_name']}"; ?></td>
                <td style="padding:20px;">
                    <a onclick="javascript:return confirm('Are you sure to delete this course?');" class='btn btn-danger' href='admin_delete_course.php?course_id=<?php echo $info['id']; ?>'>Delete</a>
                </td>
                <td style="padding:20px;">
                    <a class='btn btn-primary' href='admin_update_course.php?course_id=<?php echo $info['id']; ?>'>Update</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>