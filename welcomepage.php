<?php
$error_message = "";

if(isset($_POST['submit'])){
    // Check if a file was selected for upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['profile_picture']['name'];
        $tmp_name = $_FILES['profile_picture']['tmp_name'];
        $folder = "uploads/" . $image_name;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($tmp_name, $folder)) {
            // File successfully uploaded
            // You can now do any further processing with the image, such as saving its path to the database
            echo "Image uploaded successfully.";
        } else {
            // Error uploading image
            $error_message = "Error uploading image.";
        }
    } else {
        // No file selected for upload
        $error_message = "Please select an image to upload.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet"  href="css/stylewp.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

<body>

<section class="copy"> 
<h4>dribbble</h4>
<h1><b> Welcome! Let's create your profile </b></h1>
<p> Let others get to know you better! You can do these later </p>

<form action="explorepage.php" method="post" enctype="multipart/form-data">
    <h5><b> Add an Avatar</b></h5>
    <div class="align">
    <div id="imageContainer">
    <span id="uploadIcon">&#x1F4F7;</span>
    </div><br>
    <div class="align">
    <input type="file" accept="image/*" id="uploadInput" style="display: none;" name="profile_picture" required onchange="previewImage(event)">
    <button type="button" onclick="document.getElementById('uploadInput').click()" class="btn">Choose image</button>
    
    <div id="defaultOption" onclick="showDefaultImages()"><p>Or choose from our default images</p></div>
    <div id="defaultImages" style="display: none;left-margin:27rem;">
        <img src="avatar1.jpeg" height="150" width="150" alt="Default Image 1" onclick="setDefaultImage(this.src)">
        <img src="avatar2.jpeg" height="150" width="150" alt="Default Image 2" onclick="setDefaultImage(this.src)">
        <img src="avatar3.jpeg" height="150" width="150" alt="Default Image 3" onclick="setDefaultImage(this.src)">
    </div>
    </div>  
    <script src="script.js"></script>
    <label for="location"><h5 style="margin-left: 27rem;"><b>Add your location</b></h5></label><br>
    <input type="text" id="location" name="location"  style="border:none; outline: none;margin-left: 27rem;" placeholder="Enter a location" required>
    <button type="submit" name="submit" value="upload_image" 
    style="margin-top: 1rem;
    margin-bottom: 1rem;
    display: block;
    margin-left: 27rem;
    width:18%;
    background-color: deeppink;
    color: white;
    font-weight: 400;
    border: none;
    border-radius: 0.5rem;
    padding: 0.45rem;">Next</button>
</form>
</section>  
</body>
</html>