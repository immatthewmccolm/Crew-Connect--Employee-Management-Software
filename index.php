<?php include_once('components/head.php'); ?>

<title>Dashboard | CrewConnect</title>
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
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <?php include_once('temp/nav.php'); ?>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="main-content mb-5 mb-md-0 me-md-auto">
                <!-- <h1>Hey &#128075;, <?php echo $_SESSION['FName'] ?></h1><hr> -->
                <!-- Add your page content here -->
                <?php include_once('temp/dash.php'); ?>

            </div>
        </main>
    </div>
</div>

<?php include_once('components/foot.php'); ?>