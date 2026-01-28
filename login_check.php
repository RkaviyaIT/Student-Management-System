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
         
         // ✅ PART 2: Load permissions once at login (stored in memory)
         $_SESSION['permissions'] = getPermissionsForUser($row['id'], $data);

        header("location:studenthome.php");
     }
     elseif($row["usertype"]=="admin"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="admin";
        $_SESSION['user_id']=$row['id'];
        
        // ✅ PART 2: Load permissions once at login (stored in memory)
        $_SESSION['permissions'] = getPermissionsForUser($row['id'], $data);

        header("location:adminhome.php");
     }else{
       $message="username or password do not match";
     $_SESSION['loginMessage']=$message;
     header("location:login.php");
    }
}

// ✅ PART 2: Function to get all permissions for a user (loaded once at login, then checked from memory)
function getPermissionsForUser($userId, $data) {
    $permissions = array();
    
    // Get user's role
    $roleQuery = "SELECT role_id FROM user WHERE id = " . intval($userId);
    $roleResult = mysqli_query($data, $roleQuery);
    $roleRow = mysqli_fetch_array($roleResult);
    
    if($roleRow) {
        $roleId = $roleRow['role_id'];
        
        // Get all permissions for this role
        $permQuery = "
            SELECT p.name 
            FROM permissions p
            INNER JOIN role_permissions rp ON p.id = rp.permission_id
            WHERE rp.role_id = " . intval($roleId);
        
        $permResult = mysqli_query($data, $permQuery);
        
        while($permRow = mysqli_fetch_array($permResult)) {
            $permissions[] = $permRow['name'];
        }
    }
    
    return $permissions;
}
?>
