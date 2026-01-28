
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
}

// ✅ PART 2: Include permission helper
include 'permission_helper.php';

// ✅ PART 2: Check if user has permission to view students
requirePermission('view_students');

$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";

$data=new mysqli($host,$user,$password,$db);

// ✅ PART 1: Uses database INDEX - searches on indexed columns (usertype, class_id, username)
// MySQL will use idx_student_search index and jump directly to matching rows
// Instead of checking all rows, it goes straight to "student" usertype
$sql="SELECT user.*, class.name AS class_name FROM user LEFT JOIN class ON user.class_id = class.id WHERE usertype='student' ";

$result=mysqli_query($data,$sql);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Dashboard</title>
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
            <h1>Student Data</h1>

            <?php
             if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
             }
               unset($_SESSION['message']);
            ?>
            <br><br>
            <table border="1px">
               
                <tr>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">UserName</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Email</th>
                <th style="padding:20px; font-size: 15px;  border-right: 1px solid black; border-bottom:1px solid black">Phone</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Password</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Class</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Delete</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Update</th>

                </tr>

<?php
while($info=$result->fetch_assoc()){

?>

                <tr>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue">
            <?php echo "{$info['username']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php echo "{$info['email']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php echo "{$info['phone']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php echo "{$info['password']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php echo "{$info['class_name']}"; ?></td>

            <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php 
            echo "<a onclick=\" javascript:return confirm('Are Your Sure To Delete This ');\" class='btn btn-danger'  href='delete.php?student_id={$info['id']}'> Delete </a>";
             ?>
             
            </td>
            
            <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
    <?php 
    if (isset($info['id'])) {
        echo "<a class='btn btn-primary' href='update_student.php?student_id={$info['id']}'>Update</a>"; 
    } else {
        echo "ID not available.";
    }
    ?>
</td>



                </tr>

<?php
    }

    ?>
            </table>
            </center>
        </div>
    </body>
</html>