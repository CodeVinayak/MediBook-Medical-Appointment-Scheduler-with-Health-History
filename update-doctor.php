<!DOCTYPE html>
<?php
$con = mysqli_connect("localhost", "root", "", "hms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(0);
$un = $_GET['un'];
$sp = $_GET['sp'];
$em = $_GET['em'];
$df = $_GET['df'];
$pw = $_GET['pw'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="home-content" id="list-settings">
        <div class="form-container">
            <form class="form-group" method="GET" action="update-doctor.php">
                <div class="form-row">
                    <div class="form-group1">
                        <label for="doctor">Doctor Name:</label>
                        <input type="text" value="<?php echo "$un" ?>" class="form-control" name="doctor">
                    </div>
                    <div class="form-group1">
                        <label for="special">Specialization:</label>
                        <select name="special" class="form-control" id="special">
                            <option value="" disabled>Select Specialization</option>
                            <option value="General" <?php if ($sp === "General") echo "selected"; ?>>General</option>
                            <option value="Cardiologist" <?php if ($sp === "Cardiologist") echo "selected"; ?>>Cardiologist</option>
                            <option value="Neurologist" <?php if ($sp === "Neurologist") echo "selected"; ?>>Neurologist</option>
                            <option value="Pediatrician" <?php if ($sp === "Pediatrician") echo "selected"; ?>>Pediatrician</option>
                            <option value="Dermatologist" <?php if ($sp === "Dermatologist") echo "selected"; ?>>Dermatologist</option>
                            <option value="Gastroenterologist" <?php if ($sp === "Gastroenterologist") echo "selected"; ?>>Gastroenterologist</option>
                            <option value="Ophthalmologist" <?php if ($sp === "Ophthalmologist") echo "selected"; ?>>Ophthalmologist</option>
                            <option value="Orthopedic Surgeon" <?php if ($sp === "Orthopedic Surgeon") echo "selected"; ?>>Orthopedic Surgeon</option>
                            <option value="Otolaryngologist" <?php if ($sp === "Otolaryngologist") echo "selected"; ?>>Otolaryngologist</option>
                            <option value="Urologist" <?php if ($sp === "Urologist") echo "selected"; ?>>Urologist</option>
                        </select>
                    </div>
                </div>
                <div class="form-group1">
                    <label for="demail">Email ID:</label>
                    <input type="email" value="<?php echo "$em" ?>" class="form-control" name="demail" id="demail">
                </div>
                <div class="form-row">
                    <div class="form-group1">
                        <label for="dpassword">Password:</label>
                        <input type="text" value="<?php echo "$pw" ?>" class="form-control" name="dpassword" id="dpassword">
                    </div>
                </div>
                <div class="form-group1">
                    <label for="docFees">Consultancy Fees:</label>
                    <input type="text" value="<?php echo "$df" ?>" class="form-control" name="docFees" id="docFees">
                </div>
                <div class="form-group1">
                    <button type="docsub" name="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_GET['submit'])) {
    $doctor = $_GET['doctor'];
    $password = $_GET['dpassword'];
    $demail = $_GET['demail'];
    $special = $_GET['special'];
    $docFees = $_GET['docFees'];

    $query = "UPDATE doctor SET username='$doctor',password='$password',email='$demail',spec='$special', docFees='$docFees' WHERE email='$demail'";
    $data = mysqli_query($con, $query);

    if ($data) {
        echo "<script>alert('Details updated successfully');window.location.href = 'admin-panel.php#list-settings1';</script>";
    } else {
        echo "Failed to update details: " . mysqli_error($con);
    }
}
?>