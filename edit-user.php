<?php include_once('components/head.php'); ?>

<title>New TOIL Gain Request | Crew Connect</title>
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

$reqID = uniqid();
$date = date('Y-m-d');
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <?php include_once('temp/nav.php'); ?>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="main-content mb-5 mb-md-0 me-md-auto"><br>
                <h1>Create a New TOIL Gain Request</h1><hr>
                <!-- Add your page content here --><br>
                <form action="backend/new-toil.php" method="POST">
                    <div class="mb-3">
                        <label for="toil-date" class="form-label">Employee ID</label>
                        <input type="number" class="form-control" id="empID" name="empID" value="<?php echo $_SESSION['empCode'] ?>" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="reqDate" class="form-label">Requested Date</label>
                        <input type="date" class="form-control" id="reqDate" name="reqDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="hoursReq" class="form-label">Hours Requested</label>
                        <input type="decimal" class="form-control" id="hoursReq" name="hoursReq" required>
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label> 
                        <textarea class="form-control" id="comments" name="comments" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include_once('components/foot.php'); ?>