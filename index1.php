<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="style5.css">
</head>

<body>
  <div class="wrapper">
    <nav class="nav">
    <div class="nav-logo">
            <a href="index.php"><img src="lgo.png" alt="">
            <span>Necromancy Hospital</span>
            </div>
      <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="link">Home</a></li>
                    <!-- <li><a href="services.html" class="link">About US</a></li>
                    <li><a href="contact.html" class="link">Contact</a></li> -->
                </ul>
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
          <input type="text" name="email" class="form-control" placeholder="Enter email ID"/>
        </div>
          <div class="input-box">        
          <input type="password" class="form-control" name="password2" placeholder="Enter password"/>
        </div>
          </div>
          <div class="input-box">
          <input type="submit" id="inputbtn" name="patsub" value="Login" class="btnRegister">
          </div>
          <div class="input-box">
          <button type="button" class="btnRegister"><a href="index.php">Back</a></button>
          </div>
        </form>
        
      </div>
    </div>


</div>

</body>

</html>