<?php
include_once('../creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $empCode = $_POST['employee_code'];
    $FName = $_POST['first_name'];
    $LName = $_POST['surname'];
    $jobTitle = $_POST['job_title'];
    $email = $_POST['email'];
    $dateJoined = $_POST['date_joined'];
    $password = $_POST['password'];

    // Hash the users password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO employees (employee_code, first_name, surname, job_title, email_address, date_joined, role, password, TOIL_Balance, HOL_Balance) VALUES ('$empCode', '$FName', '$LName', '$jobTitle', '$email', '$dateJoined', 'Standard', '$hashed_password', '0', '224')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../signin.php?s=success');
      } else {
        header('Location: ../signup.php?s=fail&e=' . urlencode($stmt->error));
    }
}
