<?php
error_reporting(0);
session_start();


$host="localhost";
$user="root";
$password="Rkaviya@123";
$db="schoolproject";

$data=new mysqli($host,$user,$password,$db);

if($_GET['student_id']){

    $user_id=$_GET['student_id'];

    $sql="DELETE FROM user WHERE  id='$user_id' ";

    $result=mysqli_query($data,$sql);

    if($result){

        $_SESSION['message']="Delete Student is Successful";
        header("location:view_student.php");
        exit();
    }
}


?>