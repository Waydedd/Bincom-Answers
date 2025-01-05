<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Polling Unit Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Store Polling Unit Results</h1>
    <form action="store_results.php" method="POST">
        <label for="polling_unit_id">Polling Unit ID:</label>
        <input type="number" id="polling_unit_id" name="polling_unit_id" required><br><br>
        
        <label for="ward_id">Ward ID:</label>
        <input type="number" id="ward_id" name="ward_id" required><br><br>
        
        <label for="lga_id">LGA ID:</label>
        <input type="number" id="lga_id" name="lga_id" required><br><br>
        
        <label for="party_abbreviation">Party Abbreviation:</label>
        <input type="text" id="party_abbreviation" name="party_abbreviation" required><br><br>
        
        <label for="party_score">Party Score:</label>
        <input type="number" id="party_score" name="party_score" required><br><br>
        
        <label for="polling_unit_number">Polling Unit Number:</label>
        <input type="text" id="polling_unit_number" name="polling_unit_number" required><br><br>
        
        <label for="polling_unit_name">Polling Unit Name:</label>
        <input type="text" id="polling_unit_name" name="polling_unit_name" required><br><br>
        
        <label for="polling_unit_description">Polling Unit Description:</label>
        <input type="text" id="polling_unit_description" name="polling_unit_description" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>