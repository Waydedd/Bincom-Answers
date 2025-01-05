<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bincomphptest";
    
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$polling_unit_id = $_POST['polling_unit_id'];
$ward_id = $_POST['ward_id'];
$lga_id = $_POST['lga_id'];
$party_abbreviation = $_POST['party_abbreviation'];
$party_score = $_POST['party_score'];
$polling_unit_number = $_POST['polling_unit_number'];
$polling_unit_name = $_POST['polling_unit_name'];
$polling_unit_description = $_POST['polling_unit_description'];

// Escape string values to prevent SQL injection
$polling_unit_number = $conn->real_escape_string($polling_unit_number);
$polling_unit_name = $conn->real_escape_string($polling_unit_name);
$polling_unit_description = $conn->real_escape_string($polling_unit_description);

// Insert into polling_unit table
$sql_polling_unit = "INSERT INTO polling_unit (polling_unit_id, ward_id, lga_id, polling_unit_number, polling_unit_name, polling_unit_description) VALUES ($polling_unit_id, $ward_id, $lga_id, '$polling_unit_number', '$polling_unit_name', '$polling_unit_description')";
if ($conn->query($sql_polling_unit) === TRUE) {
    $polling_unit_uniqueid = $conn->insert_id;

    // Insert into announced_pu_results table
    $sql_results = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score) VALUES ($polling_unit_uniqueid, '$party_abbreviation', $party_score)";
    if ($conn->query($sql_results) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_results . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_polling_unit . "<br>" . $conn->error;
}

$conn->close();
}
?>