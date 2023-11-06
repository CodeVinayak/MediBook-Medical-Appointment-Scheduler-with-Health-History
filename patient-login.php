<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style5.css">
  <link rel="stylesheet" type="text/css" href="style5.css">
  <script>
    function myMenuFunction() {
      var i = document.getElementById("navMenu");

      if (i.className === "nav-menu") {
        i.className += " responsive";
      } else {
        i.className = "nav-menu";
      }
    }

    function showForm(formId) {
      var forms = document.getElementsByClassName("register-container");
      for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = "none";
      }

      var form = document.getElementById(formId);
      form.style.display = "block";
    }
  </script>
</head>

<body>

  <div class="wrapper">
    <nav class="nav">
      <div class="nav-logo">
        <a href="index.php"><img src="logo.png" alt="">
          <span>Hospital Appointment Booking</span>
      </div>
      <div class="nav-menu" id="navMenu">
        <ul>
          <li><a href="index.php" class="link">Home</a></li>
          <li><a href="patient-login.php" class="link">Patient Login</a></li>
          <li class="link" onclick="location.href='index.php/loginDoctor';" style="color:white; cursor: pointer;">Doctor Login</li><br>
          <li class="link" onclick="showForm('loginAdmin')" style="color:white">&nbsp;&nbsp;&nbsp;&nbsp;Admin Login</li>
        </ul>
      </div>
      <div class="nav-button">
        <button class="btn white-btn" id="loginBtn" onclick="showForm('loginPatient')">Patient</button>
        <button class="btn white-btn" id="registerBtn" onclick="showForm('loginDoctor')">Doctor</button>
        <button class="btn white-btn    " id="adminBtn" onclick="showForm('loginAdmin')">Admin</button>
      </div>
      <div class="nav-menu-btn">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
      </div>
    </nav>
    <div class="form-box">
      <div class="register-container" id="loginPatient">
        <div class="top">
          <header>Patient Login</header>
        </div>
        <form method="POST" action="function.php">
          <div class="two-forms">
            <div class="input-box">
              <input type="text" name="email" class="form-control" placeholder="Enter email ID" />
            </div><br>
            <div class="input-box">
              <input type="password" class="form-control" name="password2" placeholder="Enter password" />
            </div>
          </div><br><br>
          <div class="input-box">
            <input type="submit" id="inputbtn" name="patsub" value="Login" class="btnRegister">
          </div><br>
          <div class="input-box">
            <button type="button" class="btnlogin"><a href="index.php">Back</a></button>
          </div>
          <!-- <div class="input-box">
            <button class="btnlogin" onclick="window.location.href='index.php';">Back</button>
          </div> -->
        </form>

      </div>
    </div>


  </div>

</body>

</html>