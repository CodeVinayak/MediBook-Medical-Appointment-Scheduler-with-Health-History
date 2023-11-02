<!DOCTYPE html>
<html lang="en">
<head>
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
    <?php
    session_start();
    if (isset($_SESSION['validation_errors']) && is_array($_SESSION['validation_errors'])) {
        foreach ($_SESSION['validation_errors'] as $error) {
            if ($error === "A patient with the same email or contact already exists") {
                echo '<h3>A patient with the same email or contact already exists!<br>Please try again.</h3>';
            } else {
                echo '<h3>' . $error . '</h3>';
            }
        }
        unset($_SESSION['validation_errors']);
    } else {
        echo '<h3>An error occurred. Please try again.</h3>';
    }
    ?>
    <br><br>
    <a href="index.php" class="btn btn-outline-light">Try Again</a>
</body>
</html>
