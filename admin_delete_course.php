<?php
error_reporting(0);
session_start();

$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";

$data=new mysqli($host,$user,$password,$db);

if($_GET['course_id']){
    $course_id=$_GET['course_id'];

    $sql="DELETE FROM courses WHERE id='$course_id'";

    $result=mysqli_query($data,$sql);

    if($result){
        $_SESSION['message']="Delete Course is Successful";
        header("location:admin_view_course.php");
        exit();
    }
}
?>