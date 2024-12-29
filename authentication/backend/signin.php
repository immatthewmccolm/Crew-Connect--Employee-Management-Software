<?php
include_once('../creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection failed: " . $conn->connect_error;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE Email_Address = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $empCode = $row["Employee_Code"];
          $FName = $row["First_Name"];
          $surname = $row["Surname"];
          $title = $row["Job_Title"];
          $email = $row["Email_Address"];
          $Date_Joined = $row["Date_Joined"];
          $Role = $row["Role"];
          $hashword = $row["Password"];
          $TOILBalance = $row["TOIL_Balance"];
          $HOLBalance = $row["HOL_Balance"];
        }
    } else {
        header('Location: ../signin.php?s=none');
    }

    if (password_verify($password, $hashword)) {
        session_start();
        $_SESSION['empCode'] = $empCode;
        $_SESSION['FName'] = $FName;
        $_SESSION['surname'] = $surname;
        $_SESSION['title'] = $title;
        $_SESSION['email'] = $email;
        $_SESSION['Date_Joined'] = $Date_Joined;
        $_SESSION['Role'] = $Role;
        $_SESSION['TOILBalance'] = $TOILBalance;
        $_SESSION['HOLBalance'] = $HOLBalance;
    
        header('Location: ../../index.php');
    } else {
        header('Location: ../signin.php?s=none');
    }
} else {
    echo "Error";
}