<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php
session_start();
$con=mysqli_connect("localhost","root","","hms");
if(isset($_POST['search_submit'])){
  $contact=$_POST['contact'];
  $docname = $_SESSION['dname'];
 $query="select * from appointment where contact='$contact' and doctor='$docname';";
 $result=mysqli_query($con,$query);
 echo '<div class="home-content" id="list-app">
 <div>
  <table class="app-table">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Appointment Date</th>
      <th>Appointment Time</th>
    </tr>
  </thead>
  <tbody>
  ';
  while($row=mysqli_fetch_array($result)){
    $fname=$row['fname'];
    $lname=$row['lname'];
    $email=$row['email'];
    $contact=$row['contact'];
    $appdate=$row['appdate'];
    $apptime=$row['apptime'];
    echo '<tr>
      <td>'.$fname.'</td>
      <td>'.$lname.'</td>
      <td>'.$email.'</td>
      <td>'.$contact.'</td>
      <td>'.$appdate.'</td>
      <td>'.$apptime.'</td>
    </tr>';
  }
echo '</tbody></table></div></div>
<center><div><a href="doctor-panel.php" class="btn btn-light">Go Back</a></div></center>
</html>';
}

?>