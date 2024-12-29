<?php
// Include database credentials
include_once('authentication/creds.php');

// Create connection
$conn = new mysqli($DB_Host, $DB_User, $DB_Pass, $DB_Name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the employee code from the session
$empCode = $_SESSION['empCode'];

// Fetch total TOIL and holiday hours from the database
$sql = "SELECT TOIL_Balance, HOL_Balance FROM employees WHERE Employee_Code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $empCode);
$stmt->execute();
$stmt->bind_result($totalToilHours, $totalHolidayHours);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<div class="main-content mb-5 mb-md-0 me-md-auto"><br>
    <h1>Hey &#128075;, <?php echo $_SESSION['FName'] ?></h1><hr>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 text-center" style="height: 200px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total TOIL Hours</h5>
                    <p class="card-text display-4" id="total-toil-hours"><?php echo $totalToilHours; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 text-center" style="height: 200px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Holiday Hours</h5>
                    <p class="card-text display-4" id="total-holiday-hours"><?php echo $totalHolidayHours; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Calendar</h5>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary libraries -->
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch data from the server (replace with actual data fetching)
    const totalToilHours = <?php echo $totalToilHours; ?>; // Data from PHP
    const totalHolidayHours = <?php echo $totalHolidayHours; ?>; // Data from PHP
    const holidays = [ // Example data, replace with actual data
        { title: 'Holiday Booking', start: '2024-12-29' },
        // Add more events
    ];

    // Update total hours
    document.getElementById('total-toil-hours').textContent = totalToilHours;
    document.getElementById('total-holiday-hours').textContent = totalHolidayHours;

    // Render calendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: holidays
    });
    calendar.render();
});
</script>