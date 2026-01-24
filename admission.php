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


$sql="SELECT * FROM admission ";

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
            <h1>Applied For Admission</h1>

            <br><br>
            <table border="1px" >
            <tr>
        <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Name</th>
        <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Email</th>
        <th style="padding:20px; font-size: 15px;  border-right: 1px solid black; border-bottom:1px solid black">Phone</th>
        <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Message</th>
    </tr>


<?php
while($info=$result->fetch_assoc()){

?>


    <tr>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black">
            <?php echo "{$info['name']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black">
            <?php echo "{$info['email']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black">
            <?php echo "{$info['phone']}"; ?></td>
        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black">
            <?php echo "{$info['message']}"; ?></td>
    </tr>

    <?php
    }

    ?>
            </table>
            </center>
        </div>
    
    </body>
</html>