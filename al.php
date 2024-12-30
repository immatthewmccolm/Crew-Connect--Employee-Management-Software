<?php include_once('components/head.php'); ?>

<title>Annual Leave Requests Log | CrewConnect</title>
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

// Include database credentials
include_once('authentication/creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM holiday_requests WHERE Employee_ID = ?");
$stmt->bind_param("i", $_SESSION['empCode']);
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
                <h1>Annual Leave Log</h1><hr>
                <!-- Add your page content here --><br>
                <table id="toilLog" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sent Date</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Hours Used</th>
                            <th>Comments</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($req as $r) { ?>
                            <tr>
                                <td><?php echo $r['Request_ID']; ?></td>
                                <td><?php echo $r['Request_Date']; ?></td>
                                <td><?php echo $r['Start_Date']; ?></td>
                                <td><?php echo $r['End_Date']; ?></td>
                                <td><?php echo $r['Requested_Hours']; ?></td>
                                <td><?php echo $r['Request_Comments']; ?></td>

                                <td>
                                    <?php if ($r['Request_Status'] == 'Pending') { ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php } elseif ($r['Request_Status'] == 'Approved') { ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php } ?>
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