<?php include_once('components/head.php'); ?>

<title>User Management | CrewConnect</title>
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

// Include database credentials
include_once('authentication/creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM employees");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the requests
$req = [];
while ($row = $result->fetch_assoc()) {
    $req[] = $row;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<script type="text/javascript">
    new DataTable('#toilLog');

    let table = new DataTable('#toilLog');

    $(document).ready( function () {
    $('#toilLog').DataTable();
} );
</script>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <?php include_once('temp/nav.php'); ?>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="main-content mb-5 mb-md-0 me-md-auto"><br>
                <h1>User Management</h1><hr>
                <!-- Add your page content here --><br>
                <table id="toilLog" class="display">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Job Title</th>
                            <th>Email Address</th>
                            <th>Date Joined</th>
                            <th>Access Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($req as $r) { ?>
                            <tr>
                                <td><?php echo $r['Employee_Code']; ?></td>
                                <td><?php echo $r['First_Name']; ?></td>
                                <td><?php echo $r['Surname']; ?></td>
                                <td><?php echo $r['Job_Title']; ?></td>
                                <td><?php echo $r['Email_Address']; ?></td>
                                <td><?php echo $r['Date_Joined']; ?></td>
                                <td><?php echo $r['Role']; ?></td>
                                <td>
                                <a class="icon " href="backend/delete-user.php?id=<?php echo htmlspecialchars($row['Request_ID']);?>"><i class="decline fa-solid fa-trash "></i></a>
                                <a class="icon " href="edit-user.php?id=<?php echo htmlspecialchars($row['Request_ID']);?>"><i class="fa-solid fa-pencil "></i></a>
                                <a class="icon " href="backend/upgrade-user.php?id=<?php echo htmlspecialchars($row['Request_ID']);?>"><i class="approve fa-solid fa-star "></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>



<?php include_once('components/foot.php'); ?>