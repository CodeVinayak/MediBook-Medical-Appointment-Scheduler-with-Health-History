<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
	<title>User Messages</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("newfunction.php");
if(isset($_POST['mes_search_submit']))
{
	$contact=$_POST['mes_contact'];
	$query = "select * from contact where contact= '$contact'";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['name']=="" & $row['email']=="" & $row['contact']=="" & $row['message']==""){
    echo "<script> alert('No queries found.'); 
          window.location.href = 'admin-panel.php#list-doc';</script>";
  } 
  else {
    echo "<div class='home-content' id='list-mes'>
    <div>
  <table class='qtable'>
    <thead>
      <tr>
        <th scope='col'>User Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>Contact</th>
        <th scope='col'>Message</th>
      </tr>
    </thead>
    <tbody>";
  
    
          $name = $row['name'];
          $email = $row['email'];
          $contact = $row['contact'];
          $message = $row['message'];
          echo "<tr>
            <td>$name</td>
            <td>$email</td>
            <td>$contact</td>
            <td>$message</td>
          </tr>";
    
    echo "</tbody></table><center><a href='admin-panel1.php' class='btn btn-light'>Back to your Dashboard</a></div></center></div></div></div>";
  }
}
?>
</body>
</html>