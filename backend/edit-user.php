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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $empCode = $_POST['employee_code'];
    $FName = $_POST['first_name'];
    $LName = $_POST['surname'];
    $jobTitle = $_POST['job_title'];
    $email = $_POST['email'];
    $dateJoined = $_POST['date_joined'];

    $sql = "UPDATE employees SET first_name = '$FName', surname = '$LName', job_title = '$jobTitle', email_address = '$email', date_joined = '$dateJoined' WHERE employee_code = '$empCode'";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../user-management.php');
      } else {
        echo "Error updating record: " . $conn->error;
      }
    
      $conn->close();
}

