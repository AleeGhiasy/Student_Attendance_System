<?php
include("db.php");
include("header.php");

$flag = 0;
$update = 0;

if (isset($_POST['submit'])) {
    $date = date("Y-m-d");
    $records = mysqli_query($con, "SELECT * FROM attendance_record WHERE date ='$date'");
    $num = mysqli_num_rows($records);
    if ($num) {
        foreach ($_POST['attendance_status'] as $id => $attendance_status) {
            $student_name = $_POST['student_name'][$id];
            $roll_number = $_POST['roll_number'][$id];
        
            $existing_record = mysqli_query($con, "SELECT * FROM attendance_record WHERE date='$date' AND roll_number='$roll_number'");
            if (mysqli_num_rows($existing_record) > 0) {
                // If record exists, update it
                $result = mysqli_query($con, "UPDATE attendance_record SET attendance_status = '$attendance_status' WHERE date = '$date' AND roll_number = '$roll_number'");
            } else {
                // If record does not exist, insert it
                $result = mysqli_query($con, "INSERT INTO attendance_record(student_name, roll_number, attendance_status, date) VALUES('$student_name','$roll_number','$attendance_status','$date')");
            }
        
            if ($result) {
                $update = 1;
            }
        }
        
    } else {
        foreach ($_POST['attendance_status'] as $id => $attendance_status) {
            $student_name = $_POST['student_name'][$id];
            $roll_number = $_POST['roll_number'][$id];

            $result = mysqli_query($con, "INSERT INTO attendance_record(student_name, roll_number, attendance_status, date) VALUES('$student_name','$roll_number','$attendance_status','$date')");
            if ($result) {
                $flag = 1;
            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>
                <a class="btn btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info float-end" href="viewall.php">View All</a>
            </h2>
            <h3>
                <div class="well text-center">Date: <?php echo date("Y-m-d") ?> </div>
            </h3>
            <?php if ($flag) { ?>
                <div class="alert alert-success">
                    Attendance Date Inserted Successfully!
                </div>
            <?php } ?>
            <?php if ($update) { ?>
                <div class="alert alert-success">
                    Student Attendance updated Successfully!
                </div>
            <?php } ?>
        </div>
        <div class="card-body">
            <form action="attendance.php" method="Post">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Student Name</th>
                            <th>ID Number</th>
                            <th>Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * from attendance");
                        $serialnumber = 0;
                        $counter = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $serialnumber++;
                        ?>
                            <tr>
                                <td><?php echo $serialnumber; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">

                                <td><?php echo $row['roll_number']; ?>
                                    <input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">
                                </td>

                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present" required <?php if (isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'][$counter] == "Present") echo "checked"; ?>>
                                        Present
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" required <?php if (isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'][$counter] == "Absent") echo "checked"; ?>>
                                        Absent
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</div>
