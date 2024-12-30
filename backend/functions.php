<?php

function getProfilePic() {
    // // Start the session
    // session_start();
    
    // Check if the user is signed in
    if (!isset($_SESSION['empCode'])) {
        // If not signed in, redirect to the login page
        header('Location: authentication/signin.php');
        exit();
    }
    
    // Include database credentials
    include_once('authentication/creds.php');
    
    // Create connection
    $conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $empCode = $_SESSION['empCode'];
    
    // Get the profile picture of the user
    $stmt = $conn->prepare("SELECT pic_url FROM employees WHERE Employee_Code = '$empCode'");
    $stmt->execute();
    $stmt->bind_result($profilePic);
    $stmt->fetch();
    
    echo $profilePic;
    
    $stmt->close();
    $conn->close();
}

function checkIfHasProfilePic() {

    // Include database credentials
    include_once('authentication/creds.php');
    
    // Create connection
    $conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $empCode = $_SESSION['empCode'];
    
    // Get the profile picture of the user
    $stmt = $conn->prepare("SELECT pic_url FROM employees WHERE Employee_Code = '$empCode'");
    $stmt->execute();
    $stmt->bind_result($profilePic);
    $stmt->fetch();
    
    if ($profilePic == NULL) {
        return true;
    } else {
        return false;
    }
    
    $stmt->close();
    $conn->close();
}


function comments_rand_avatar_color($name,$zoom=1,$classes=''){

    mt_srand(round(crc32($name)/1000)); // Seed the random number generator with the hash of the name
    $randomNumber = mt_rand(1, 20); // Generate a random number between 1 and 20
    
    $words = explode(' ', $name);
    $letters = '';
    if (count($words) >= 2) {
        $letters .= strtoupper(substr($words[0], 0, 1));
        $letters .= strtoupper(substr($words[1], 0, 1));
    } elseif (count($words) == 1) {
        $letters .= strtoupper(substr($words[0], 0, 2));
    }
    
    $zoom = ($zoom) ? $zoom : 1;

    $str = "<i class='avatarLetters avatarLetters-color-{$randomNumber} {$classes}' style='zoom:{$zoom}'>{$letters}</i>";
    
    return $str;
}