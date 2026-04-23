<html>
<head>
<title>Sam's Used Cars</title>
</head>

<body>

<h1>Sam's Used Cars</h1>

<?php 
include 'db.php';

$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    echo "No VIN was provided.";
    exit;
}

$query = "DELETE FROM INVENTORY WHERE VIN='$vin'";

/* Try to query the database */
if ($mysqli->query($query)) {
    echo "<p>The vehicle with VIN <strong>$vin</strong> has been deleted.</p>";
} else {
    echo "<p>Error deleting vehicle: " . $mysqli->error . "</p>";
}

$mysqli->close();

echo "<p><a href='viewcars.php'>Return to Inventory</a></p>";
?>

</body>
</html>

