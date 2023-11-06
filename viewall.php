<?php 
include("db.php");
include("header.php");
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <a class="btn btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info" href="student_list.php">Student List</a>
                <a class="btn btn-info float-end" href="attendance.php">Back</a>
            </h2>
        </div>
        <div class="card-body"> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Serial Number</th> 
                        <th>Dates</th>
                        <th>Show Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = mysqli_query($con, "SELECT DISTINCT date FROM attendance_record");
                    $serialnumber = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $serialnumber++;
                        ?>
                        <tr>
                            <td><?php echo $serialnumber; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                                <form action="show_attendance.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['date']; ?>" name="date">
                                    <input type="submit" value="Show Attendance" class="btn btn-primary">
                                </form>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
