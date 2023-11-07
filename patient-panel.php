<!DOCTYPE html>
<?php
include('function.php');
include('newfunction.php');
$con = mysqli_connect("localhost", "root", "", "hms");
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$pid = $_SESSION['pid'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$gender = $_SESSION['gender'];
$lname = $_SESSION['lname'];
$contact = $_SESSION['contact'];

if (isset($_POST['app-submit'])) {
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $contact = $_SESSION['contact'];
  $doctor = $_POST['doctor'];
  $email = $_SESSION['email'];
  $docFees = $_POST['docFees'];

  $appdate = $_POST['appdate'];
  $apptime = $_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kathmandu');
  $cur_time = date("H:i:s");
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);


  // Calculate the date one month from now
  $oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));

  if ($appdate1 < strtotime($oneMonthFromNow)) {
    if (date("Y-m-d", $appdate1) >= $cur_date) {
      if ((date("Y-m-d", $appdate1) == $cur_date and date("H:i:s", $apptime1) > $cur_time) or date("Y-m-d", $appdate1) > $cur_date) {
        $check_query = mysqli_query($con, "SELECT apptime FROM appointment WHERE doctor='$doctor' AND appdate='$appdate' AND apptime='$apptime' AND (userStatus='1' AND doctorStatus='1')");

        if (mysqli_num_rows($check_query) == 0) {
          $query = mysqli_query($con, "insert into appointment(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus) values($pid,'$fname','$lname','$gender','$email','$contact','$doctor','$docFees','$appdate','$apptime','1','1')");

          if ($query) {
            echo "<script>alert('Your appointment successfully booked');</script>";
          } else {
            echo "<script>alert('Unable to process your request. Please try again!');</script>";
          }
        } else {
          echo "<script>alert('We are sorry to inform that the doctor is not available at this time or date. Please choose a different time or date!');</script>";
        }
      } else {
        echo "<script>alert('Select a time or date in the future!');</script>";
      }
    } else {
      echo "<script>alert('Select a time or date in the future!');</script>";
    }
  } else {
    echo "<script>alert('Select a date within one month from now!');</script>";
  }
}


if (isset($_GET['cancel'])) {
  $query = mysqli_query($con, "update appointment set userStatus='0' where AppID = '" . $_GET['AppID'] . "'");
  if ($query) {
    echo "<script>alert('Your appointment successfully cancelled');</script>";
  }
}
function get_specs()
{
  $con = mysqli_connect("localhost", "root", "", "hms");
  $query = mysqli_query($con, "select username, spec from doctor");
  $docarray = array();
  while ($row = mysqli_fetch_assoc($query)) {
    $docarray[] = $row;
  }

  $options = '';
  foreach ($docarray as $doc) {
    $options .= '<option value="' . $doc['username'] . '">' . $doc['spec'] . '</option>';
  }

  return $options;
}
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pwd = $_POST['password'];

  $query = "UPDATE patient SET password='$pwd' WHERE email='$email'";
  $data = mysqli_query($con, $query);
  if ($data) {
    echo " <script> alert('password changed')</script>";
  } else {
    echo "Failed to change password";
  }
}

// Function to check if the appointment is prescribed
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
?>
<script>
  function validateAppointmentForm() {
    var spec = document.getElementById('spec').value;
    var doctor = document.getElementById('doctor').value;
    var docFees = document.getElementById('docFees').value;
    var appdate = document.querySelector('[name=appdate]').value;
    var apptime = document.getElementById('apptime').value;

    if (spec === "" || doctor === "" || docFees === "" || appdate === "" || apptime === "") {
      alert("Please select all required fields.");
      return false;
    }

    return true;
  }
</script>
<html lang="en">

<head>
  <script src="https://kit.fontawesome.com/2323653b3c.js" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style4.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .status-prescribed {
      color: green;
      font-weight: bold;
    }

    .status-canceled {
      color: red;
      font-weight: bold;
    }
  </style>


<body>
  <!-- dashboard -->
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-plus-medical'></i>
      <span class="logo_name"><a href="#"> Hospital Appointment Booking</a></span>
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
          <span class="links_name">Book Appointment</span>
        </a>
      </li>
      <li>
        <a href="#list-app" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Appointment History</span>
        </a>
      </li>
      <li>
        <a href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>
          <span class="links_name">Prescriptions</span>
        </a>
      </li>
      <li>
        <a href="#list-change-password" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
          <i class='bx bx-detail'></i>

          <span class="links_name">Change Password</span>
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
        <span class="admin">
          <?php
          $greeting = "Welcome, " . $username;
          echo $greeting;
          ?>
        </span>
      </div>
    </nav>
    <!-- Default contents and dashboard contents -->
    <div class="home-content" id="list-dash">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Book My Appointment</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-doc-list')">
                Book Appointment
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
            <h4>My Appointments</h4>

            <p class="cl-effect-1">
              <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                View Appointment History
              </a>
            </p>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Prescriptions</h4>

            <p>
              <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                View Prescriptions List
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Book Appointment section -->
    <div class="home-content" id="list-doc">
      <div class="hcontent">
        <h4>Create an appointment</h4>
        <form class="form-group" method="post" action="patient-panel.php" onsubmit="return validateAppointmentForm();">
          <div>
            <label for="spec">Specialization:</label>
          </div>
          <div class="selspec">
            <select name="spec" class="form-control" id="spec">
              <option value="" disabled selected>Select Specialization</option>
              <?php
              display_specs();
              ?>
            </select>
          </div>
          <script>
            document.getElementById('spec').onchange = function () {
              let spec = this.value;
              let docs = [...document.getElementById('doctor').options];

              docs.forEach((el, ind, arr) => {
                arr[ind].setAttribute("style", "");
                if (el.getAttribute("data-spec") != spec) {
                  arr[ind].setAttribute("style", "display: none");
                }
              });

              // Reset doctor selection and fees when specialization changes
              document.getElementById('doctor').selectedIndex = 0;
              document.getElementById('docFees').value = '';
            };

            document.getElementById('doctor').onchange = function () {
              var selection = document.querySelector(`[value="${this.value}"]`).getAttribute('data-value');
              document.getElementById('docFees').value = selection;
            };
          </script>

          <div>
            <label for="doctor">Doctors:</label>
          </div>
          <div class="sdoc">
            <select name="doctor" class="form-control" id="doctor">
              <option value="" disabled selected>Select Doctor</option>

              <?php display_docs(); ?>
            </select>
          </div>
          <script>
            document.getElementById('doctor').onchange = function updateFees(e) {
              var selection = document.querySelector(`[value="${this.value}"]`).getAttribute('data-value');
              document.getElementById('docFees').value = selection;
            };
          </script>
          <div>
            <label for="consultancyfees">
              Consultancy Fees
            </label>
          </div>
          <div class="Fees">
            <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly" />
          </div>
          <div>
            <label>Appointment Date</label>
          </div>
          <div class="apdate">
            <input type="date" class="form-control datepicker" name="appdate">
          </div>
          <div>
            <label>Appointment Time</label>
          </div>
          <div class="Stime">
            <select name="apptime" class="form-control" id="apptime">
              <option value="" disabled selected>Select Time</option>
              <option value="08:00:00">8:00 AM</option>
              <option value="10:00:00">10:00 AM</option>
              <option value="12:00:00">12:00 PM</option>
              <option value="14:00:00">2:00 PM</option>
              <option value="16:00:00">4:00 PM</option>
            </select>
          </div><br>
          <center>
            <div class="btn">
              <input type="submit" name="app-submit" value="Create new entry" class="btn btn-primary" id="inputbtn">
            </div>
          </center>
        </form>
      </div>
    </div>
    <!-- Appointment history section -->
    <div class="home-content" id="list-app">
      <div>
        <table class="app-table">
          <thead>
            <tr>
              <th scope="col">Doctor Name</th>
              <th scope="col">Consultancy Fees</th>
              <th scope="col">Appointment Date</th>
              <th scope="col">Appointment Time</th>
              <th scope="col">Current Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $con = mysqli_connect("localhost", "root", "", "hms");
            global $con;

            $query = "SELECT AppID, doctor, docFees, appdate, apptime, userStatus, doctorStatus FROM appointment WHERE fname ='$fname' AND lname='$lname';";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
              $doctor = $row['doctor'];
              $docFees = $row['docFees'];
              $appdate = $row['appdate'];
              $apptime = $row['apptime'];
              $userStatus = $row['userStatus'];
              $doctorStatus = $row['doctorStatus'];
              $AppID = $row['AppID'];

              // Check if appointment is prescribed or cancelled
              $accepted = isAccepted($AppID);
              $cancelled = isCancelled($AppID);
              ?>
              <tr>
                <th scope="row">
                  <?php echo $doctor; ?>
                </th>
                <td>
                  <?php echo $docFees; ?>
                </td>
                <td>
                  <?php echo $appdate; ?>
                </td>
                <td>
                  <?php echo $apptime; ?>
                </td>
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
                <td>
                  <?php if (!$cancelled && !$accepted) { ?>
                    <a href="doctor-panel.php?AppID=<?php echo $row['AppID'] ?>&cancel=update"
                      onClick="return confirm('Are you sure you want to cancel this appointment?')"
                      title="Cancel Appointment">
                      <button class="btn btn-primary">Cancel</button>
                    </a>
                  <?php } ?>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>


    <!-- Prescription section -->
    <div class="home-content" id="list-pres">
      <div>

        <table class="pres-table">
          <thead>
            <tr>

              <th scope="col">Doctor Name</th>
              <th scope="col">Appointment ID</th>
              <th scope="col">Appointment Date</th>
              <th scope="col">Appointment Time</th>
              <th scope="col">Diseases</th>
              <th scope="col">Allergies</th>
              <th scope="col">Prescriptions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $con = mysqli_connect("localhost", "root", "", "hms");
            global $con;

            $query = "select doctor,AppID,appdate,apptime,disease,allergy,prescription from prescriptiontable where pid='$pid';";

            $result = mysqli_query($con, $query);
            if (!$result) {
              echo mysqli_error($con);
            }


            while ($row = mysqli_fetch_array($result)) {
              ?>
              <tr>
                <td>
                  <?php echo $row['doctor']; ?>
                </td>
                <td>
                  <?php echo $row['AppID']; ?>
                </td>
                <td>
                  <?php echo $row['appdate']; ?>
                </td>
                <td>
                  <?php echo $row['apptime']; ?>
                </td>
                <td>
                  <?php echo $row['disease']; ?>
                </td>
                <td>
                  <?php echo $row['allergy']; ?>
                </td>
                <td>
                  <?php echo $row['prescription']; ?>
                </td>
                </form>


              </tr>
            <?php }
            ?>
          </tbody>
        </table>
        <br>
      </div>
    </div>
    <!-- Change Password section -->
    <div class="home-content" id="list-change-password">
      <div class="change-password-form">

        <center>
          <h4>Change Password</h4>
        </center>
        <form class="form-group" method="post" action="patient-panel.php">
          <div>
            <label for="email">Email:</label>
          </div>
          <div>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div>
            <label for="new-password">New Password:</label>
          </div>
          <div>
            <input type="password" name="password" class="form-control" required>
          </div><br>
          <div class="btn">
            <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
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
      document.querySelectorAll(".home-content").forEach(function (section) {
        if (section.id !== "list-dash") {
          section.style.display = "none";
        }
      });

      // Toggle sidebar
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      };

      // Handle click events for navigation links
      links.forEach(function (link) {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          const targetSection = document.querySelector(this.getAttribute("href"));
          sections.querySelectorAll(".home-content").forEach(function (section) {
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