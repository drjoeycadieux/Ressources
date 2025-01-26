<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "transportation_requests"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form data
    $schedule_date = $_POST['schedule-date'];
    $type = $_POST['type'];
    $arrival_time = $_POST['arrival-time'];
    $departure_time = $_POST['departure-time'];
    $departure_address = $_POST['departure-address'];
    $destination_address = $_POST['destination-address'];
    $mobility_aid = isset($_POST['mobility-aid']) ? 1 : 0; // 1 if checked, 0 if not
    $travel_companion = $_POST['travel-companion'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO requests (schedule_date, type, arrival_time, departure_time, departure_address, destination_address, mobility_aid, travel_companion)
            VALUES ('$schedule_date', '$type', '$arrival_time', '$departure_time', '$departure_address', '$destination_address', '$mobility_aid', '$travel_companion')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New transportation request submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
