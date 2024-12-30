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
if ($_SESSION['Role'] != 'Admin') {
    // If not signed in, redirect to the login page
    header('Location: index.php');
    exit();
}

$empCode = urldecode($_GET['id']);
$first = urldecode($_GET['f']);
$last = urldecode($_GET['l']);
$job = urldecode($_GET['j']);
$email = urldecode($_GET['e']);
$date = urldecode($_GET['dj']);
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <?php include_once('temp/nav.php'); ?>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="main-content mb-5 mb-md-0 me-md-auto"><br>
                <h1>Change an Employees Details</h1><hr>
                <!-- Add your page content here --><br>
                <form action="backend/edit-user.php" method="POST">
                    <div class="mb-3">
                        <label for="employee_code" class="form-label">Employee Code</label>
                        <input type="number" class="form-control" id="employee_code" name="employee_code" value="<?php echo $empCode ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $last ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_title" class="form-label">Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $job ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_joined" class="form-label">Date Joined</label>
                        <input type="date" class="form-control" id="date_joined" name="date_joined" value="<?php echo $date ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="return" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include_once('components/foot.php'); ?>