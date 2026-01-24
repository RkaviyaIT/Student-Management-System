<?php
error_reporting(0);


session_start();

$host="localhost";
$username="root";
$password="Rkaviya@123";

$database="schoolproject";

$data=new mysqli($host,$username,$password,$database);
if($data->connect_error){
    die("Connection failed: ".$data->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['username'];
    $pass=$_POST['password'];


    $sql="select * from user where username='".$name."' AND password='".$pass."' ";

     $result=mysqli_query($data,$sql);

     $row=mysqli_fetch_array($result);

     if($row["usertype"]=="student"){
        
        $_SESSION['username']=$name;
         $_SESSION['usertype']="student";
         $_SESSION['user_id']=$row['id'];

        header("location:studenthome.php");
     }
     elseif($row["usertype"]=="admin"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="admin";
        $_SESSION['user_id']=$row['id'];

        header("location:adminhome.php");
     }else{
       $message="username or password do not match";
     $_SESSION['loginMessage']=$message;
     header("location:login.php");
    }
}
?>