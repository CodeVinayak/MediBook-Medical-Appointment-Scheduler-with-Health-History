<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
	<title>Patient Details</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("newfunction.php");
if(isset($_POST['patient_search_submit']))
{
	$contact=$_POST['patient_contact'];
	$query = "select * from patient where contact= '$contact'";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['lname']=="" & $row['email']=="" & $row['contact']=="" & $row['password']==""){
    echo "<script> alert('Patient not found'); 
          window.location.href = 'admin-panel1.php#list-doc';</script>";
  }
  else {
    echo "<div class='home-content' id='list-pat'>
	<div>
<table class='patient'>
  <thead>
    <tr>
      <th scope='col'>First Name</th>
      <th scope='col'>Last Name</th>
      <th scope='col'>Email</th>
      <th scope='col'>Contact</th>
      <th scope='col'>Password</th>
    </tr>
  </thead>
  <tbody>";

	
		    $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $contact = $row['contact'];
        $password = $row['password'];
        echo "<tr>
          <td>$fname</td>
          <td>$lname</td>
          <td>$email</td>
          <td>$contact</td>
          <td>$password</td>
        </tr>";
    
	echo "</tbody></table><center><a href='admin-panel.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
}
  }
	
?>
</body>
</html>