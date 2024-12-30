<?php

// Start the session
session_start();

// Check if the user is signed in
if (!isset($_SESSION['empCode'])) {
    // If not signed in, redirect to the login page
    header('Location: authentication/signin.php');
    exit();
}

include_once('../authentication/creds.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reqID = uniqid();
    $empID = $_SESSION['empCode'];
    $reqSDate = $_POST['reqSDate'];
    $reqEDate = $_POST['reqEDate'];
    $sentDate = date('Y-m-d');
    $reqAmount = $_POST['hoursReq'];
    $reqComments = $_POST['comments'];

    $conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO holiday_requests (Request_ID, Employee_ID, Request_Date, Start_Date, End_Date, Requested_Hours, Request_Comments, Request_Status) VALUES ('$reqID', '$empID', '$sentDate', '$reqSDate', '$reqEDate', '$reqAmount', '$reqComments', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        $sql2 = "UPDATE employees SET HOL_Balance = HOL_Balance - '$reqAmount' WHERE Employee_Code = '$empID'";
        if ($conn->query($sql2) === TRUE) {
            header('Location: ../al.php');
          } else {
            echo "Error updating employee record, note that the toil request has been inputted into the system: " . $conn->error;
          }
      } else {
        echo "Error updating record: " . $conn->error;
      }
      
      $conn->close();
}