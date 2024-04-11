<!DOCTYPE html>

<?php
$con = mysqli_connect("localhost", "root", "", "hms");
include('newfunction.php');

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['docsub'])) {
  $doctor = $_POST['doctor'];
  $dpassword = $_POST['dpassword'];
  $demail = $_POST['demail'];
  $spec = $_POST['special'];
  $docFees = $_POST['docFees'];

  // Check if the doctor already exists
  $checkQuery = "SELECT * FROM doctor WHERE username='$doctor' OR email='$demail'";
  $checkResult = mysqli_query($con, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    header("Location: error3.php");
    exit();
  }

  // Insert the new doctor
  $query = "INSERT INTO doctor(username, password, email, spec, docFees) VALUES('$doctor', '$dpassword', '$demail', '$spec', '$docFees')";
  $result = mysqli_query($con, $query);

  if ($result) {
    echo "<script>alert('Doctor added successfully!');</script>";
  }
}
function isAccepted($id)
{
    global $con;
    $query = "SELECT * FROM appointment WHERE AppID = '$id' AND doctorStatus=0";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}

// Function to check if the appointment is cancelled
function isCancelled($id)
{
    global $con;
    $query = "SELECT * FROM appointment WHERE AppID = '$id' AND userStatus = 0";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}

// For reload problem after form submission 19-29
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $_SESSION['form_data'] = $_POST;
//   header("Location: admin-panel.php");
//   exit();
// }
// if (isset($_SESSION['form_data'])) {
//   $form_data = $_SESSION['form_data'];
//   unset($_SESSION['form_data']);
// }
// Till here

// function validateEmail($email)
// {
//   if (empty($email)) {
//     return "Please enter the doctor's email address.";
//   }
//   return "";
// }
// if (isset($_POST['docsub1'])) {
//   $demail = $_POST['demail'];

//   $errors = array();

//   // Validate email
//   $emailError = validateEmail($demail);
//   if (!empty($emailError)) {
//     $errors[] = $emailError;
//   }

//   if (count($errors) === 0) {
//     $query = "select * from doctor where email='$demail';";
//     $result = mysqli_query($con, $query);

//     if ($result && mysqli_num_rows($result) > 0) {
//       $deleteQuery = "delete from doctor where email='$demail';";
//       $deleteResult = mysqli_query($con, $deleteQuery);

//       if ($deleteResult) {
//         echo "<script>alert('Doctor removed successfully!'); window.location.href = 'admin-panel.php#list-settings1';</script>";
//       } else {
//         echo "<script>alert('Unable to delete the doctor.'); window.location.href = 'admin-panel.php#list-settings1';</script>";
//       }
//     } else {
//       echo "<script>alert('Doctor with the provided email does not exist.');window.location.href = 'admin-panel.php#list-settings1';</script>";
//     }
//   } else {
//     $errorString = implode("\\n", $errors);
//     echo "<script>alert('$errorString'); window.location.href = 'admin-panel.php#list-settings1';</script>";
//   }
// }
mysqli_close($con);
?>
<script>
  function validateDoctorForm() {
    var doctor = document.getElementsByName("doctor")[0].value;
    var dpassword = document.getElementsByName("dpassword")[0].value;
    var cdpassword = document.getElementsByName("cdpassword")[0].value;
    var demail = document.getElementsByName("demail")[0].value;
    var spec = document.getElementsByName("special")[0].value;
    var docFees = document.getElementsByName("docFees")[0].value;

    if (doctor === "" || dpassword === "" || cdpassword === "" || demail === "" || spec === "" || docFees === "") {
      alert("All details must be included.");
      return false; // Prevent form submission
    }

    // Check email format using a regular expression
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(demail)) {
      alert("Please enter a valid email address.");
      return false; // Prevent form submission
    }

    if (dpassword !== cdpassword) {
      alert("Passwords do not match.");
      return false; // Prevent form submission
    }
    if (isNaN(docFees)) {
      alert("Consultancy Fees must be a numerical value.");
      return false; // Prevent form submission
    }

    // Check if Consultancy Fees contains only numbers
    if (!/^[0-9]+$/.test(docFees)) {
      alert("Consultancy Fees must contain only numbers.");
      return false; // Prevent form submission
    }
    return true; // Form is valid and can be submitted
  }
  if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
// function validateDeleteDoctorForm() {
//   var email = document.getElementsByName('demail')[0].value;
  
//   if (email.trim() === '') {
//     alert('Please enter the doctor\'s email address.');
//     return false; // Prevent form submission
//   }
  
//   // Rest of your validation logic
//   // ...
// }
</script>
<html lang="en" dir="ltr">

<head>
  <script src="https://kit.fontawesome.com/2323653b3c.js" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- dashboard -->
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-plus-medical'></i>
      <span class="logo_name"><a href="#"> MediBook: Appointment Schedule</a></span>
    </div>
    <ul class="nav-links">
      <li>
        <a class="active" href="#list-dash">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#list-doc" id="list-doc-list">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Doctor list</span>
        </a>
      </li>
      <li>
        <a href="#list-pat" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Patient list</span>
        </a>
      </li>
      <li>
        <a href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>
          <span class="links_name">Appointment Details</span>
        </a>
      </li>
      <li>
        <a href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-table'></i>
          <span class="links_name">Prescription list</span>
        </a>
      </li>
      <li>
        <a href="#list-settings" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bxs-book-add'></i>
          <span class="links_name">Add Doctor</span>
        </a>
      </li>
      <li class="log_out">
        <a href="logout.php" onclick="logout()">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- sections  -->
  <div class="section-container" id="sections">
    <!-- navbar -->
    <nav>
      <div class="welcome">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="admin">Welcome Admin</span>
      </div>
    </nav>
    <!-- Default contents and also dashboard contents -->
    <div class="home-content" id="list-dash">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4> Doctor List</h4>
            <script>
              function clickDiv(id) {
                document.querySelector(id).click();
              }
            </script>
            <p class="links cl-effect-1">
              <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                View Doctors
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Patient List</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                View Patients
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Appointment Details</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                View Appointments
              </a>
            </p>
          </div>
        </div>

      </div>
      <br><br><br>
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Prescription List</h4>

            <p>
              <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                View Prescriptions
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Manage Doctors</h4>

            <p>
              <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Add Doctors</a>
              &nbsp|<a href="#list-doc" onclick="clickDiv('#list-doc-list')">Delete & Edit Doctors</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Doctor List contents-->
    <div class="home-content" id="list-doc">
      <div>
        <form class="form-group" action="doctorsearch.php" method="post">
          <div class="dsearch">
            <div class="email-field">
              <input type="text" name="doctor_contact" placeholder="Enter Email ID" class="form-control">
            </div>
            <div class="submit-btn">
              <input type="submit" name="doctor_search_submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form>
      </div>
      <table class="doctor-table">
        <thead>
          <tr>
            <th scope="col">Doctor Name</th>
            <th scope="col">Specialization</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Fees</th>
            <th scope="col">Manage Doctors</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table rows with dynamic data -->
          <?php
          $con = mysqli_connect("localhost", "root", "", "hms");
          global $con;
          $query = "select * from doctor";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            // $username = $row['username'];
            // $spec = $row['spec'];
            // $email = $row['email'];
            // $password = $row['password'];
            // $docFees = $row['docFees'];
            echo "
          <tr>
          <td>".$row['username']."</td>
          <td>".$row['spec']."</td>
          <td>".$row['email']."</td>
          <td>".$row['password']."</td>
          <td>".$row['docFees']."</td>
          <td><a href='update-doctor.php?un=$row[username]&sp=$row[spec]&em=$row[email]& pw=$row[password]&df=$row[docFees]'><input type='submit' value='update' class='btn btn-primary'>
          <a href='delete-doctor.php? email=$row[email]'><input type='submit' value='DELETE' class='btn btn-primary'></td>
        </tr>";
          }
          // &pw=$row[password]
          ?>
        </tbody>
      </table>
    </div>
    <!-- List patients section  -->
    <div class="home-content" id="list-pat">
      <div>
        <form class="form-group" action="patientsearch.php" method="post">
          <div class="psearch">
            <div class="email-field">
              <input type="text" name="patient_contact" placeholder="Enter Contact" class="form-control">
            </div>
            <div class="submit-btn">
              <input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form>
      </div>
      <table class="patient">
        <thead>
          <tr>
            <th scope="col">Patient ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <!-- <th scope="col">Password</th> -->
          </tr>
        </thead>
        <tbody>
          <!-- Table rows with dynamic data -->
          <?php
          $con = mysqli_connect("localhost", "root", "", "hms");
          global $con;
          $query = "select * from patient";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            $pid = $row['pid'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $gender = $row['gender'];
            $email = $row['email'];
            $contact = $row['contact'];
            $password = $row['password'];

            echo "<tr>
            <td>$pid</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$gender</td>
            <td>$email</td>
            <td>$contact</td>
          </tr>";
          }

          ?>
        </tbody>
      </table>
      <br>
    </div>
    <!-- List Appointments section -->
    <div class="home-content" id="list-app">
      <div>
        <form class="form-group" action="appsearch.php" method="post">
          <div class="appsearch">
            <div class="email-field">
              <input type="text" name="app_contact" placeholder="Enter Contact" class="form-control">
            </div>
            <div class="submit-btn"><input type="submit" name="app_search_submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form>
      </div>
      <table class="app-table">
        <thead>
          <tr>
            <th scope="col">Appointment ID</th>
            <th scope="col">Patient ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Consultancy Fees</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
            <th scope="col">Appointment Status</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $con = mysqli_connect("localhost", "root", "", "hms");
          global $con;

          $query = "select * from appointment;";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['AppID'];
            $accepted = isAccepted($id);
            $cancelled = isCancelled($id);
        ?>
            <tr>
                <td><?php echo $row['AppID']; ?></td>
                <td><?php echo $row['pid']; ?></td>
                      <td><?php echo $row['fname']; ?></td>
                      <td><?php echo $row['lname']; ?></td>
                      <td><?php echo $row['gender']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['contact']; ?></td>
                      <td><?php echo $row['doctor']; ?></td>
                      <td><?php echo $row['docFees']; ?></td>
                      <td><?php echo $row['appdate']; ?></td>
                      <td><?php echo $row['apptime']; ?></td>
                <td>
                    <?php
                    if ($cancelled) {
                        echo "Cancelled";
                    } elseif ($accepted) {
                        echo "Accepted";
                    } else {
                        echo "Active";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
      </table>
      <br>
    </div>
    <!-- prescription list contents-->
    <div class="home-content" id="list-pres">

      <div>

        <table class="pres-table">
          <thead>
            <tr>
              <th scope="col">Doctor</th>
              <th scope="col">Patient ID</th>
              <th scope="col">Appointment ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Appointment Date</th>
              <th scope="col">Appointment Time</th>
              <th scope="col">Disease</th>
              <th scope="col">Allergy</th>
              <th scope="col">Prescription</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $con = mysqli_connect("localhost", "root", "", "hms");
            global $con;
            $query = "select * from prescriptiontable";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
              $doctor = $row['doctor'];
              $pid = $row['pid'];
              $AppID = $row['AppID'];
              $fname = $row['fname'];
              $lname = $row['lname'];
              $appdate = $row['appdate'];
              $apptime = $row['apptime'];
              $disease = $row['disease'];
              $allergy = $row['allergy'];
              $pres = $row['prescription'];


              echo "<tr>
            <td>$doctor</td>
            <td>$pid</td>
            <td>$AppID</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$appdate</td>
            <td>$apptime</td>
            <td>$disease</td>
            <td>$allergy</td>
            <td>$pres</td>
          </tr>";
            }

            ?>
          </tbody>
        </table>
        <br>
      </div>
    </div>
    <!-- Add doctor section -->
    <div class="home-content" id="list-settings">
      <div class="form-container">
        <form class="form-group" method="post" action="admin-panel.php" onsubmit="return validateDoctorForm();">
          <div class="form-row">
            <div class="form-group1">
              <label for="doctor">Doctor Name:</label>
              <input type="text" class="form-control" name="doctor" onkeydown="return alphaOnly(event);">
            </div>
            <div class="form-group1">
              <label for="special">Specialization:</label>
              <select name="special" class="form-control" id="special">
                <option value="" disabled selected>Select Specialization</option>
                <option value="General">General</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Gastroenterologist">Gastroenterologist</option>
                <option value="Ophthalmologist">Ophthalmologist</option>
                <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                <option value="Otolaryngologist">Otolaryngologist</option>
                <option value="Urologist">Urologist</option>
              </select>
            </div>
          </div>
          <div class="form-group1">
            <label for="demail">Email ID:</label>
            <input type="email" class="form-control" name="demail" id="demail">
          </div>
          <div class="form-row">
            <div class="form-group1">
              <label for="dpassword">Password:</label>
              <input type="password" class="form-control" name="dpassword" id="dpassword">
            </div>
            <div class="form-group1">
              <label for="cdpassword">Confirm Password:</label>
              <input type="password" class="form-control" name="cdpassword" id="cdpassword">
            </div>
          </div>
          <div class="form-group1">
            <label for="docFees">Consultancy Fees:</label>
            <input type="text" class="form-control" name="docFees" id="docFees">
          </div>
          <div class="form-group1">
            <button type="submit" name="docsub" class="btn btn-primary">Add Doctor</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- <script>
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
      sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
</script> -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebarBtn = document.querySelector(".sidebarBtn");
      const sidebar = document.querySelector(".sidebar");
      const sections = document.querySelector("#sections");
      const links = document.querySelectorAll(".nav-links li a");
      // Show the dashboard section by default
      document.getElementById("list-dash").style.display = "block";
      document.getElementById("list-doc").style.display = "none";
      document.querySelector(".nav-links li a.active").classList.remove("active");
      document.querySelector(".nav-links li a[href='#list-dash']").classList.add("active");

      // Hide other sections when the page loads
      document.querySelectorAll(".home-content").forEach(function(section) {
        if (section.id !== "list-dash") {
          section.style.display = "none";
        }
      });

      // Toggle sidebar
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      };

      // Handle click events for navigation links
      links.forEach(function(link) {
        link.addEventListener("click", function(event) {
          event.preventDefault();
          const targetSection = document.querySelector(this.getAttribute("href"));
          sections.querySelectorAll(".home-content").forEach(function(section) {
            section.style.display = "none";
          });
          targetSection.style.display = "block";
          document.querySelector(".nav-links li a.active").classList.remove("active");
          this.classList.add("active");
        });
      });
    });
    // logout button code
    function logout() {
      event.preventDefault();
      window.location.href = "logout.php"; // Redirect to logout.php
    }
    // default page contents js
    function clickDiv(id) {
      document.querySelector(id).click();
    }
  </script>



</body>

</html>