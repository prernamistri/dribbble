<?php
$error_message = "";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname ='web_application';

    $conn = mysqli_connect($host,$user,$pass,$dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $check_query = "SELECT * FROM userinfo WHERE username=?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query execution was successful
    if($result === false) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Check if the email already exists
    if(mysqli_num_rows($result) > 0) {
        // Email already exists, set error message
        $error_message = "Username already exists";
    } else {
        // Insert user data into the database
        $insert_query = "INSERT INTO userinfo (name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $password);
        mysqli_stmt_execute($stmt);
        // Redirect to welcome.php
        header("Location: welcomepage.php");
        exit;
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"  href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

    <title>Web Application</title>

  </head>
  <body>
    <div class="split-screen">
        <div class="left">
            <section class="copy">
            <h4>dribbble</h4>
            <h2><b> Discover the world's top Designers and Creatives.</b></h2> 
            <p>Art by <u>Peter Tarka</u></p>
            </section>
        </div>
        <div class="right">
            <section class="copy">
            <h3 class="already" style="text-align:end;margin-top:3rem; font-size:1rem; margin-left:40rem;">Already a member? <a href="#"><strong>Sign In</strong></a></h3>
            <div class="form-container">
            <h2>Sign up to Dribbble</h2>
            <form name="sign_up_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-row">
            <div class="col">
            <label for="name">Name</label>
            <input type="text" class="form-control" name = "name" required>
            </div>
            <div class="col">
            <label for="username">Username</label>
            <input type="text" class="form-control" name = "username"required>
            <?php if(!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            </div></div>   
            <label for="inputforemail">Email </label>
            <input type="email" class="form-control" id="inputforemail" placeholder="name@gmail.com" name = "email" required>
            <label for="inputforpassword">Password</label>
            <input type="password" class="form-control" id="inputforpassword" placeholder="6+ characters" name = "password" required>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
            <label class="form-check-label" for="defaultCheck1"></label><p class="left-align">Creating an account means you're okay with our <a href="#">Terms of Service, Privacy Policy,</a> and our deafult <a href="#">Notification Settings.</a></p>
            <button type="submit" name="submit" value="Send data" class="btn">Create Account</button></div></form>
            <p class="left-align">This site is protected by reCAPTCHA  and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service </a>apply.</p>
            </div></section>
        </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>