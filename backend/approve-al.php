<?php
// Start the session
session_start();

// Check if the user is signed in
if (!isset($_SESSION['empCode'])) {
    // If not signed in, redirect to the login page
    header('Location: ../authentication/signin.php');
    exit();
}
if ($_SESSION['Role'] != 'Admin') {
    // If not an admin, redirect to the index page
    header('Location: ../index.php');
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
$approver = $_SESSION['empCode'];

// Update the request status to 'Approved' and set the Approver_Employee_Code
$stmt = $conn->prepare("UPDATE holiday_requests SET Request_Status = 'Approved', Approver_Employee_Code = '$approver' WHERE Request_ID = '$reqID'");

if ($stmt->execute() === TRUE) {
    header('Location: ../approve-al.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>