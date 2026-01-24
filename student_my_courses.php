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

$student_id = $_SESSION['user_id']; // Assuming we store user_id in session

// Get student info
$student_sql = "SELECT user.*, class.name AS class_name FROM user JOIN class ON user.class_id = class.id WHERE user.id='$student_id'";
$student_result = mysqli_query($data, $student_sql);
$student_info = mysqli_fetch_assoc($student_result);

$sql="SELECT courses.name, courses.description, teacher.name AS teacher_name, class.name AS class_name 
      FROM user 
      JOIN courses ON user.class_id = courses.class_id 
      JOIN teacher ON courses.teacher_id = teacher.id 
      JOIN class ON courses.class_id = class.id 
      WHERE user.id='$student_id'";

$result=mysqli_query($data,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Courses</title>
    <?php include 'student_css.php'; ?>
</head>
<body>
    <?php include 'student_sidebar.php'; ?>
    <div class="content">
        <h1>My Profile</h1>
        <p><strong>Username:</strong> <?php echo $student_info['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $student_info['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $student_info['phone']; ?></p>
        <p><strong>Class:</strong> <?php echo $student_info['class_name']; ?></p>
        <br>
        <h1>My Courses</h1>
        <table border="1px">
            <tr>
                <th style="padding:20px; font-size: 15px;">Course Name</th>
                <th style="padding:20px; font-size: 15px;">Description</th>
                <th style="padding:20px; font-size: 15px;">Teacher</th>
                <th style="padding:20px; font-size: 15px;">Class</th>
            </tr>
            <?php while($info=$result->fetch_assoc()){ ?>
            <tr>
                <td style="padding:20px;"><?php echo "{$info['name']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['description']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['teacher_name']}"; ?></td>
                <td style="padding:20px;"><?php echo "{$info['class_name']}"; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>