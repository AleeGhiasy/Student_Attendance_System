<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the user exists in the database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    // Check if the query executed successfully
    if ($result) {
        // Check if a row was returned (valid credentials)
        if (mysqli_num_rows($result) == 1) {
            // Redirect to attendance.php upon successful login
            header("Location: attendance.php");
            exit();
        } else {
            // Invalid credentials, handle error (e.g., show error message)
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // Query execution failed, handle error
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
