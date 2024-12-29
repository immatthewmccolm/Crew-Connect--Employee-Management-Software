<?php include_once "../components/head.php"; ?>

<title>Sign Up | Crew Connect</title>
</head>
<body class="login-page d-flex justify-content-center align-items-center vh-100">

<section class="login-form text-center">
    <img src="../build/logos/Black Stacked.svg" alt="" width="200" class="mb-4">
    <h2 class="mb-5">Account Registration</h2>


    <?php if (isset($_GET['s']) && $_GET['s'] == 'fail'): ?>
        <?php
            $error = urldecode($_GET['e']);
        ?>
        <div class="alert alert-danger text-center">
            Signup unsuccessful! Error: <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>


    <form class="text-start login-form-inner" action="backend/signup.php" method="POST">
        <div class="mb-3">
            <label for="employee_code" class="form-label">Employee Code</label>
            <input type="number" class="form-control" id="employee_code" name="employee_code" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="job_title" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="job_title" name="job_title" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="date_joined" class="form-label">Date Joined</label>
            <input type="date" class="form-control" id="date_joined" name="date_joined" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        <p class="mt-3 account-notice">Already have an account? <a href="signin.php">Sign In</a></p>
    </form>
</section>

<?php include_once "../components/foot.php"; ?>