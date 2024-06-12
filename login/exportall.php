<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}

include("../partials/_db.php");
// Define the query to select the required columns from the table
$sql = "SELECT country, name, phone, email,designation,dikshit,marital_status,district,tehsil,dob,aniver_date FROM users";
$result = $conn->query($sql);

// Set the default timezone to ensure correct date/time
date_default_timezone_set('UTC');

// Get the current date
$currentDate = date('j F Y');

// Output the current date in the desired format


// File name for the CSV file
$filename = "export_" . date('Ymd') . ".csv";

// Set headers to indicate the type of file and the file name
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="GIEO Gita All Data ' . $currentDate . " " . $filename . '"');

// Open the output stream
$output = fopen('php://output', 'w');

// Output the column headings if needed
fputcsv($output, array('Country', 'Name', 'Phone', 'Email', 'Designation', 'Dikshit', 'Married/Un', 'District', 'Tehsil', 'DOB', 'Aniversary'));

// Fetch and output the data rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
} else {
    echo "No data found";
}

// Close the output stream
fclose($output);

// Close the database connection
$conn->close();
exit();
