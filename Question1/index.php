<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Result Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Search Polling Unit Results</h1>
    <form action="poll.php" method="POST">
        <label for="result_id">Polling Unit Unique ID:</label>
        <input type="number" id="polling_unit_uniqueid" name="polling_unit_uniqueid" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>