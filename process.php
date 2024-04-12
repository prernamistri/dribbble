<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
        
    // Redirect to the next page
    header("Location: welcomepage.php");
    exit();
}
?>