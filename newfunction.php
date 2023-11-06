<?php
// session_start();
$con=mysqli_connect("localhost","root","","hms");
// if(isset($_POST['submit'])){
//  $username=$_POST['username'];
//  $password=$_POST['password'];
//  $query="select * from logintb where username='$username' and password='$password';";
//  $result=mysqli_query($con,$query);
//  if(mysqli_num_rows($result)==1)
//  {
//   $_SESSION['username']=$username;
//   $_SESSION['pid']=
//   header("Location:patient-panel.php");
//  }
//  else
//   header("Location:error.php");
// }
// if(isset($_POST['update_data']))
// {
//  $contact=$_POST['contact'];
//  $status=$_POST['status'];
//  $query="update appointment set payment='$status' where contact='$contact';";
//  $result=mysqli_query($con,$query);
//  if($result)
//   header("Location:updated.php");
// }

// function display_docs()
// {
//  global $con;
//  $query="select * from doctor";
//  $result=mysqli_query($con,$query);
//  while($row=mysqli_fetch_array($result))
//  {
//   $username=$row['username'];
//   $price=$row['docFees'];
//   echo '<option value="' .$username. '" data-value="'.$price.'">'.$username.'</option>';
//  }
// }


function display_specs() {
  global $con;
  $query="select distinct(spec) from doctor";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $spec=$row['spec'];
    echo '<option data-value="'.$spec.'">'.$spec.'</option>';
  }
}

function display_docs()
{
 global $con;
 $query = "select * from doctor";
 $result = mysqli_query($con,$query);
 while( $row = mysqli_fetch_array($result) )
 {
  $username = $row['username'];
  $price = $row['docFees'];
  $spec = $row['spec'];
  // Sanitize the username for use as an attribute value
  $sanitizedUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
  echo '<option value="' .$sanitizedUsername. '" data-value="'.$price.'" data-spec="'.$spec.'">'.$sanitizedUsername.'</option>';
 }
}



if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into doctor(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>