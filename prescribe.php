<!DOCTYPE html>
<?php
include('function1.php');
$con = mysqli_connect("localhost", "root", "", "hms");
$pid='';
$AppID='';
$appdate='';
$apptime='';
$fname = '';
$lname= '';
$doctor = $_SESSION['dname'];
if(isset($_GET['pid']) && isset($_GET['AppID']) && ($_GET['appdate']) && isset($_GET['apptime']) && isset($_GET['fname']) && isset($_GET['lname'])) {
$pid = $_GET['pid'];
  $AppID = $_GET['AppID'];
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  $appdate = $_GET['appdate'];
  $apptime = $_GET['apptime'];
}



if(isset($_POST['prescribe']) && isset($_POST['pid']) && isset($_POST['AppID']) && isset($_POST['appdate']) && isset($_POST['apptime']) && isset($_POST['lname']) && isset($_POST['fname'])){
  $appdate = $_POST['appdate'];
  $apptime = $_POST['apptime'];
  $disease = $_POST['disease'];
  $allergy = $_POST['allergy'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pid = $_POST['pid'];
  $AppID = $_POST['AppID'];
  $prescription = $_POST['prescription'];
  
  $query=mysqli_query($con,"insert into prescriptiontable(doctor,pid,AppID,fname,lname,appdate,apptime,disease,allergy,prescription) values ('$doctor','$pid','$AppID','$fname','$lname','$appdate','$apptime','$disease','$allergy','$prescription')");
    if($query)
    {
      echo "<script>alert('Prescribed successfully!');window.location.href = 'doctor-panel.php';</script>";
    }
    else{
      echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
  // else{
  //   echo "<script>alert('GET is not working!');</script>";
  // }initial
  // enga error?
}

?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">    
  <style type="text/css">
    body {
      padding-top: 50px;
      font-family: 'IBM Plex Sans', sans-serif;
      background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
    }
    
    .home-cont {
      margin-top: 50px;
    }
    
    .navbar-brand {
      font-size: 20px;
      font-weight: bold;
      text-decoration: none;
    }
    
    .navbar-nav .nav-item {
      margin-right: 10px;
    }
    
    .nav-link {
      font-size: 16px;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      color: #fff;
    }
    
    .nav-link:hover {
      background-color: #007bff;
    }
    
    .nav-link.logout {
      background-color: #dc3545;
    }
    
    .nav-link.logout:hover {
      background-color: #c82333;
    }
    
    h3 {
      margin-left: 40%;
      padding-bottom: 20px;
    }
    
    .form-box {
      max-width: 500px;
      margin: 0 auto;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      background-color: #f8f9fa;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      font-weight: bold;
    }
    
    textarea {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }
    
    .prescribe-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: black;
    background-color: transparent;
    border: 2px solid black;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.5s ease;
    text-align: center;
  }

  .prescribe-button:hover {
    background-color: #28a745;
  }
  </style>
  <script>
    function confirmPrescription() {
      var disease = document.getElementById("disease").value.trim();
      var allergy = document.getElementById("allergy").value.trim();
      var prescription = document.getElementById("prescription").value.trim();
      
      if (disease === "" || allergy === "" || prescription === "") {
        alert("Please fill in all fields before prescribing.");
      } else {
        var confirmed = confirm("Are you sure you want to prescribe?");
        if (confirmed) {
          window.location.href = "doctor-panel.php";
        }
      }
    }
  </script>
</head>

<body>
  <div class="home-cont">
    <h3>Welcome <?php echo $doctor ?></h3>

    <div class="form-box">
      <form class="form-group" name="prescribeform" method="post" action="prescribe.php">
        <div class="row">
          <div class="cont">
            <label>Disease:</label>
          </div>
          <div class="cont">
            <textarea id="disease" cols="86" rows="3" name="disease" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="cont">
            <label>Allergies:</label>
          </div>
          <div class="cont">
            <textarea id="allergy" cols="86" rows="3" name="allergy" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="cont">
            <label>Prescription:</label>
          </div>
          <div class="cont">
            <textarea id="prescription" cols="86" rows="6" name="prescription" required></textarea>
          </div>
        </div>
        <br>
        <input type="hidden" name="fname" value="<?php echo $fname ?>" />
        <input type="hidden" name="lname" value="<?php echo $lname ?>" />
        <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />
        <input type="hidden" name="apptime" value="<?php echo $apptime ?>" />
        <input type="hidden" name="pid" value="<?php echo $pid ?>" />
        <input type="hidden" name="AppID" value="<?php echo $AppID ?>" />
        <br>
        <div class="submit-btn">
        <input type="submit" name="prescribe" value="Prescribe" class="btn btn-primary" style="margin-left: 12pc;">
        </div>
      </form>
      <div class="submit-btn">
        <a href="doctor-panel.php" style="text-decoration: none;margin-left: 12pc;">
        <button class="btn btn-primary" style="width:90px;">Back</button></a>
        </div>
    </div>
  </div>
</body>

</html>
