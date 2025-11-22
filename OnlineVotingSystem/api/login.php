<?php
session_start();
include("connect.php");

// Get POST data and sanitize
$studentid = mysqli_real_escape_string($connect, $_POST['studentid']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$role = (int)$_POST['role']; // cast to integer

// Check database connection
if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query user
$check = mysqli_query($connect, "SELECT * FROM user WHERE studentid='$studentid' AND password='$password' AND role=$role");

if (!$check) {
    die("Query failed: " . mysqli_error($connect));
}

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_assoc($check);
    $groups = mysqli_query($connect,"SELECT * FROM user WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    header("Location: ../routes/dashboard.php");
    exit;
} else {
    echo '<script>alert("Invalid Credentials or User not found"); window.location = "../";</script>';
}
?>
