<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "bincomphptest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all lga_name values
$lgaQuery = "SELECT lga_id, lga_name FROM lga";
$lgaResult = $conn->query($lgaQuery);

if (!$lgaResult) {
    die("Error fetching LGAs: " . $conn->error);
}
?>
<link rel="stylesheet" href="style.css">
<div>
<form method="post" action="">
    <?php
    if ($lgaResult->num_rows > 0) {
        // Output data of each row
        while($row = $lgaResult->fetch_assoc()) {
            echo '<input type="checkbox" name="lgaIds[]" value="' . htmlspecialchars($row["lga_id"]) . '"> ' . htmlspecialchars($row["lga_name"]) . '<br>';
        }
    } else {
        echo "0 results";
    }
    ?>
    <input type="submit" name="submit" value="Submit">
</form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['lgaIds'])) {
        $selectedLgaIds = $_POST['lgaIds'];

        $stmt = $conn->prepare("
            SELECT lga.lga_name, IFNULL(SUM(announced_pu_results.party_score), 0) as total_score
            FROM lga
            LEFT JOIN polling_unit ON lga.lga_id = polling_unit.lga_id
            LEFT JOIN announced_pu_results ON polling_unit.uniqueid = announced_pu_results.polling_unit_uniqueid
            WHERE lga.lga_id = ?
            GROUP BY lga.lga_id
        ");

        foreach ($selectedLgaIds as $lgaId) {
            $stmt->bind_param("i", $lgaId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "LGA Name: " . htmlspecialchars($row["lga_name"]) . " - Total Score: " . htmlspecialchars($row["total_score"]) . "<br>";
            } else {
                echo "LGA Name: Unknown - Total Score: 0<br>";
            }
        }
        $stmt->close();
    } else {
        echo "No LGA selected.";
    }
}

$conn->close();
?>