
<?php
include("db.php");
include("header.php");
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>
                <a class="btn btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info float-end" href="viewall.php">Back</a>
            </h2>
        </div>
        <div class="card-body">
            <form action="show_attendance.php" method ="POST">
                <input type="date" name="date" />
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
                        if(isset($_POST['date'])){
                            $date = $_POST['date'];
                            $query = "SELECT * FROM attendance_record WHERE date = ?";
                            $stmt = mysqli_prepare($con, $query);
                            mysqli_stmt_bind_param($stmt, 's', $date);

                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                                $serialnumber = 0;
                                $counter = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $serialnumber++;
                                ?>
                                    <tr>
                                        <td><?php echo $serialnumber; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>

                                        <td><?php echo $row['roll_number']; ?></td>

                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present"
                                                <?php if ($row['attendance_status']=="Present")
                                                echo "checked = checked";
                                                ?>
                                                >Present
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="attendance_status[<?php echo $counter; ?>]"
                                                <?php if ($row['attendance_status']=="Absent")
                                                echo "checked = checked";
                                                ?>
                                                value="Absent">Absent
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                    $counter ++;
                                }
                            } else {
                                echo "Error: ".mysqli_error($con);
                            }
                        } else {
                            echo "Date is not set in the POST request";
                        }
                        ?>
                    </tbody>
                </table>
                <input class= "btn btn-primary" type = "submit" name ="submit" value="Submit">
            </form>
        </div>
    </div>
</div>