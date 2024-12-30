<?php include_once('components/head.php'); ?>
<?php include_once('authentication/creds.php'); ?>

<title>Annual Leave Approval Portal | CrewConnect</title>
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

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch TOIL requests and employee details
$sql = "SELECT holiday_requests.Request_ID, Employees.First_Name, Employees.Surname, holiday_requests.Start_Date, holiday_requests.End_Date, holiday_requests.Requested_Hours, holiday_requests.Request_Comments, holiday_requests.Request_Status 
        FROM holiday_requests 
        JOIN Employees ON holiday_requests.Employee_ID = Employees.Employee_Code
        WHERE holiday_requests.Request_Status = 'Pending'";
$result = $conn->query($sql);

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
                <h1>Pending Annual Leave Log</h1><hr>
                <!-- Add your page content here --><br>
                <table id="toilLog" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Requested Start Date</th>
                            <th>Requested End Date</th>
                            <th>Requested Amount</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Request_ID'] . "</td>";
                                echo "<td>" . $row['Surname'] . ", " . $row['First_Name'] . "</td>";
                                echo "<td>" . $row['Start_Date'] . "</td>";
                                echo "<td>" . $row['End_Date'] . "</td>";
                                echo "<td>" . $row['Requested_Hours'] . "</td>";
                                echo "<td>" . $row['Request_Comments'] . "</td>";
                                echo "<td>" . $row['Request_Status'] . "</td>"; ?>

                                <td>
                                <a class="icon " href="backend/approve-al.php?id=<?php echo htmlspecialchars($row['Request_ID']);?>"><i class="approve fa-solid fa-check "></i></a>
                                <a class="icon " href="backend/decline-al.php?id=<?php echo htmlspecialchars($row['Request_ID']);?>"><i class="decline fa-solid fa-X "></i></a>
                                </td>

                                <?php
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>



<?php include_once('components/foot.php'); ?>