<html>
<head>
    <title>Edit Car</title>
</head>
<body> <!-- Added body tag here -->
<?php include 'menu.php'; ?> <!-- Menu goes right after body -->

<?php
include 'db.php';
$vin = $_GET['VIN'];
$query = "SELECT * FROM inventory WHERE VIN='$vin'";

/* Try to query the database */
if ($result = $mysqli->query($query)) {
    // echo "<p>Got the info</p>"; // Don't do anything if successful.
} else {
    echo "Sorry, a vehicle with VIN of $vin cannot be found " .  $mysqli->error."<br>";
}

// Loop through all the rows returned by the query
while ($result_ar = mysqli_fetch_assoc($result)) {
    $VIN = $result_ar['VIN'];
    $make = $result_ar['Make'];
    $model = $result_ar['Model'];
    $price = $result_ar['ASKING_PRICE'];
}

echo "$VIN </p>";

$mysqli->close();
?>

<form action="EditCar.php" method="post">
    <input name="VIN" type="hidden" value="<?php echo "$VIN" ?>" /><br /><br />
    Make: <input name="Make" type="text" value="<?php echo "$make" ?>" /><br /><br />
    Model: <input name="Model" type="text" value="<?php echo "$model" ?>" /><br /><br />
    Price: <input name="Asking_Price" type="text" value="<?php echo "$price" ?>" /><br /><br />
    <input name="Submit1" type="submit" value="submit" /><br />
&nbsp;</form>

</body> <!-- Closing body tag -->
</html>