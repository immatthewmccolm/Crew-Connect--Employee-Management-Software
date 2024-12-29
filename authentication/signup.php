<?php include_once "../components/head.php"; ?>

<title>Sign In | Crew Connect</title>
</head>
<body class="login-page d-flex justify-content-center align-items-center vh-100">

<section class="login-form text-center">
    <img src="../build/logos/Black Stacked.svg" alt="" width="200" class="mb-4">
    <h2 class="mb-5">Account Registration</h2>
    <form class="text-start login-form-inner" action="backend/signin.php">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign In</button>
        <p class="mt-3 account-notice">Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>
</section>

<?php include_once "../components/foot.php"; ?>