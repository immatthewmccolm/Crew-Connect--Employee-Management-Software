<?php
// Start the session
session_start();

// Check if the user is signed in
if (!isset($_SESSION['empCode'])) {
    // If not signed in, redirect to the login page
    header('Location: authentication/signin.php');
    exit();
}
if ($_SESSION['Role'] != 'Admin') {
    // If not signed in, redirect to the login page
    header('Location: index.php');
    exit();
}
// Include database credentials
include_once('../authentication/creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$empCode = urldecode($_GET['id']);
$access = urldecode($_GET['a']);

if ($access == 'Admin') {
    $sql = "UPDATE employees SET Role = 'Standard' WHERE Employee_Code = '$empCode'";
} else {
    $sql = "UPDATE employees SET Role = 'Admin' WHERE Employee_Code = '$empCode'";
}

if ($conn->query($sql) === TRUE) {
    header('Location: ../user-management.php');
  } else {
    echo "Error updating record: " . $conn->error;
  }

  $conn->close();