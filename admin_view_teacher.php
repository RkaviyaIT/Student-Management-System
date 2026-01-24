
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


$sql="SELECT * FROM teacher ";

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
            <h1>Teacher Data</h1>

            <?php
             if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
             }
               unset($_SESSION['message']);
            ?>
            <br><br>
            <table border="1px">
               
                <tr>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Teacher Name</th>
                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">About Teacher</th>
                <th style="padding:20px; font-size: 15px;  border-right: 1px solid black; border-bottom:1px solid black">Image</th>

                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Delete</th>

                <th style="padding:20px; font-size: 15px; border-right: 1px solid black; border-bottom:1px solid black">Update</th>


                </tr>

<?php
while($info=$result->fetch_assoc()){

?>

        <tr>


        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue">
            <?php echo "{$info['name']}"; ?></td>


        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php echo "{$info['description']}"; ?></td>
            


        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
        <img height="100px" width="100px" src="<?php echo "{$info['image']}"; ?>"></td>


        <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
            <?php 
            echo "<a onclick=\" javascript:return confirm('Are Your Sure To Delete This ');\" class='btn btn-danger'  href='admin_delete.php?teacher_id={$info['id']}'> Delete </a>";
             ?>
             
            </td>


            <td style="padding:20px; border-right: 1px solid black; border-bottom:1px solid black; background-color:skyblue ">
        <?php 
    if (isset($info['id'])) {
        echo "<a class='btn btn-primary' href='update_teacher.php?teacher_id={$info['id']}'>Update</a>"; 
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