<?php 
include("header.php");
include("db.php");

$flag = 0;
if(isset($_POST["submit"])){
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $roll = mysqli_real_escape_string($con, $_POST['roll']);

    
    $result = mysqli_query($con, "INSERT INTO attendance (student_name, roll_number) VALUES ('$name', '$roll')");

    if ($result){
        $flag = 1;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>

<div class="container mt-5">
<?php if ($flag) { ?>
    <div class="alert alert-success">
        <strong>Successfully Inserted!</strong>
    </div>
<?php } ?>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <a class="btn btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info float-end" href="attendance.php">Back</a>
            </h2>
        </div>
        <div class="card-body">
            <form action="add.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Student Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="roll" class="form-label">ID Number</label>
                    <input type="text" class="form-control" id="roll" name="roll" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
