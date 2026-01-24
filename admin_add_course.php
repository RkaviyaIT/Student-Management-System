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

$data = new mysqli($host, $user, $password, $db);

if (isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];
    $class_id = $_POST['class_id'];

    $sql = "INSERT INTO courses (name, description, teacher_id, class_id) VALUES ('$name', '$description', '$teacher_id', '$class_id')";

    $res = mysqli_query($data, $sql);

    if ($res) {
        echo "<script type='text/javascript'>
            alert('Course added successfully');
        </script>";
    } else {
        echo "Failed to add course";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Course</title>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <center>
        <h1>Add Course</h1>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label>Course Name</label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                </div>
                <div>
                    <label>Teacher</label>
                    <select name="teacher_id" required>
                        <option value="">Select Teacher</option>
                        <?php
                        $sql = "SELECT * FROM teacher";
                        $result = mysqli_query($data, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label>Class</label>
                    <select name="class_id" required>
                        <option value="">Select Class</option>
                        <?php
                        $sql = "SELECT * FROM class";
                        $result = mysqli_query($data, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit" name="add_course" value="Add Course" class="btn btn-primary">
                </div>
            </form>
        </div>
        </center>
    </div>
</body>
</html>