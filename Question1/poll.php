<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bincomphptest";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // This gets the polling_unit_uniqueid from the form
    $polling_unit_uniqueid = $_POST['polling_unit_uniqueid'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT party_score, party_abbreviation FROM announced_pu_results WHERE polling_unit_uniqueid = ?");
    $stmt->bind_param("s", $polling_unit_uniqueid);

    // This executes the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // This is to output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Party: " . $row["party_abbreviation"]. " - Score: " . $row["party_score"]. "<br>";
        }
    } else {
        echo "0 results for the unique ID inputed";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>