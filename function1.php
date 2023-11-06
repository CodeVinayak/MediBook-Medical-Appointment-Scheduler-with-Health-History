<?php
session_start();

// Check if the form was submitted
if (isset($_POST['docsub1'])) {
    $dname = $_POST['username3'];
    $dpass = $_POST['password3'];

    // Validate input
    if (empty($dname) || empty($dpass)) {
        echo("<script>alert('Username and password are required. Please try again.');
              window.location.href = 'index.php';</script>");
        exit();
    }

    // Establish database connection
    $con = mysqli_connect("localhost", "root", "", "hms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the query using prepared statements
    $query = "SELECT * FROM doctor WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $dname, $dpass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if exactly one row is returned
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['dname'] = $row['username'];
        header("Location: doctor-panel.php");
        exit();
    } else {
        header("Location: Doctor-Not-Found.php");
        exit();
    }

    // Close the statement and database connection
    mysqlite_stmt_close($stmt);
    mysqlite_close($con);
    
}
?>
