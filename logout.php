<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      h3 {
        text-align: center;
      }

      .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: transparent;
        color: black;
        text-decoration: none;
        border-radius: 4px;
        border: 2px solid #ccc;
        transition: color 0.3s;
      }

      .btn:hover {
        background-color: green;
      }
    </style>
  </head>
  <body>
    <h3>You have logged out.</h3><br><br>
    <a href="index1.php" class="btn btn-outline-light">Back to Login Page</a>
  </body>
</html>