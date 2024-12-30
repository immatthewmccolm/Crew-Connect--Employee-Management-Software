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

$reqID = urldecode($_GET['id']);

$stmt = $conn->prepare("UPDATE toil_requests SET Request_Status = 'Approved' WHERE Request_ID = ?");
$stmt->bind_param("i", $reqID);


if ($stmt->execute() === TRUE) {
    header('Location: ../approve-toil.php');
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();

  ?>

