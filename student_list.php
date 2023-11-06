<?php 
include("db.php");
include("header.php");

if(isset($_POST['delete_record'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['delete_record']);

    $query = "DELETE FROM attendance WHERE roll_number = '$student_id'";
    $sec_query= "DELETE FROM attendance_record WHERE roll_number = '$student_id'";
    $result = mysqli_query($con, $query);
    $sec_result = mysqli_query($con,$sec_query);

    if ($result && $sec_result) {
        echo '<div class="alert alert-success">Record deleted successfully!</div>';
    } 
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Student List</h2>
            <a class="btn btn-info float-end" href="attendance.php">Back</a>
        </div>
        <div class="card-body"> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Number</th> 
                        <th>Student Name</th>
                        <th>Delete Student</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = mysqli_query($con, "SELECT roll_number, student_name FROM attendance");
                    if($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['roll_number']; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <td>
                                    <form method="POST" action="student_list.php">
                                        <input type="hidden" name="delete_record" value="<?php echo $row['roll_number']; ?>">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
