<?php include_once('components/head.php'); ?>

<title>Document</title>
</head>
<body>

<?php
// Start the session
session_start();

// Check if the user is signed in
if (!isset($_SESSION['empCode'])) {
    // If not signed in, redirect to the login page
    header('Location: authentication/signin.php');
    exit();
}
?>

<p>
    <ul>
        <li>code: <?php echo $_SESSION['empCode'] ?></li>
        <li>First Name: <?php echo $_SESSION['FName'] ?></li>
        <li>Surname: <?php echo $_SESSION['surname'] ?></li>
        <li>Job Title: <?php echo $_SESSION['title'] ?></li>
        <li>Email: <?php echo $_SESSION['email'] ?></li>
        <li>Date Joined: <?php echo $_SESSION['Date_Joined'] ?></li>
        <li>Role: <?php echo $_SESSION['Role'] ?></li>
    </ul>
</p>

<?php include_once('components/foot.php'); ?>