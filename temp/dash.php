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

    <section class="layout">
        <div class="Toil">
        <div class="card text-center" style="height: 200px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total TOIL Hours</h5>
                    <p class="card-text display-4" id="total-toil-hours"><?php echo $totalToilHours; ?></p>
                </div>
            </div>
        </div>
        <div class="Holiday">
        <div class="card text-center" style="height: 200px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Holiday Hours</h5>
                    <p class="card-text display-4" id="total-holiday-hours"><?php echo $totalHolidayHours; ?></p>
                </div>
            </div>
        </div>
        <div class="Calendar">
        <div class="card" style="height: 450px;">
                <div class="card-body" style="overflow-y: auto;">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="About">
            <div class="card" style="height: 100%;">
                <div class="card-body">
                <h5 class="card-title">Welcome to <b>CrewConnect!</b></h5>
        <p class="card-text">CrewConnect is your all-in-one employee management solution designed to streamline your work experience. Here, you can manage your time off, track your hours, and stay updated with company announcements.</p>
        <p class="card-text">To get started, explore the navigation menu on the left. If you have any questions, feel free to reach out to our support team.</p>
        <p class="card-text">We hope you enjoy using CrewConnect!</p>
                </div>
            </div>
        </div>
        <div class="other">
        <div class="card" style="height: 200px;">
                <div class="card-body">
                <h5 class="card-title">Important Notice</h5>
                    <p class="card-text">We are excited to announce that our company will be implementing a new employee benefits program starting next month. This program will include additional paid time off, enhanced health insurance options, and more flexible working hours.</p>
                    <p class="card-text">Please make sure to attend the upcoming town hall meeting where we will provide more details about these changes and answer any questions you may have. Your feedback is important to us, and we look forward to discussing these improvements with you.</p>
                </div>
            </div>
        </div>
    </section>
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
        { title: 'Holiday Booking', start: '2024-12-08', color: '#0DCAF0' }, // Blue: Approved Holiday
        { title: 'Holiday Booking', start: '2024-12-09', color: '#6f42c1' }, // Purple: Pending Holiday
        { title: 'Holiday Booking', start: '2024-12-10', end: '2024-12-12', color: '#dc3545' }, // Red: Declined Holiday
        { title: 'TOIL Booking', start: '2024-12-15', color: '#198754' }, // Green: Approved TOIL
        { title: 'TOIL Booking', start: '2024-12-16', color: '#ffc107' }, // Yellow: Pending TOIL
        { title: 'TOIL Booking', start: '2024-12-17', color: '#DC3545' }, // Red: Declined TOIL
        // Add more events
    ];

    // Update total hours
    document.getElementById('total-toil-hours').textContent = totalToilHours;
    document.getElementById('total-holiday-hours').textContent = totalHolidayHours;

    // Render calendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: holidays // Pass the events to the calendar
    });
    calendar.render();
});
</script>