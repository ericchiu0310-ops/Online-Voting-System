<?php
include("connect.php");

// Enable error reporting (for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get form data
$name = $_POST['name'];
$studentid = $_POST['studentid'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$role = $_POST['role'];

// Check passwords match first
if ($password != $cpassword) {
    echo '<script>
        alert("Password and Confirm password do not match!");
        window.location = "../routes/register.html";
    </script>';
    exit;
}

// Handle file upload
$image = NULL; // default if no file uploaded
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    // Make sure uploads folder exists
    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Move file
    if (!move_uploaded_file($tmp_name, $upload_dir . $image)) {
        echo '<script>
            alert("Failed to upload image.");
            window.location = "../routes/register.html";
        </script>';
        exit;
    }
}

// Insert into database
$insert = mysqli_query($connect, 
    "INSERT INTO user (name, studentid, password, photo, role, status, votes) 
     VALUES ('$name', '$studentid', '$password', '$image', '$role', 0, 0)"
);

if ($insert) {
    echo '<script>
        alert("Registration Successful!");
        window.location = "../";
    </script>';
} else {
    echo '<script>
        alert("Database error: '.mysqli_error($connect).'");
        window.location = "../routes/register.html";
    </script>';
}
?>
