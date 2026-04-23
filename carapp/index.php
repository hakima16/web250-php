<?php
require 'config_db.php';

$message = '';

/* CREATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insert') {
    $vin = $_POST['VIN'];
    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $price = $_POST['ASKING_PRICE'];

    $stmt = $mysqli->prepare("INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $vin, $make, $model, $price);
    $stmt->execute();

    $message = "Car added!";
}

/* DELETE */
if (isset($_GET['delete'])) {
    $vin = $mysqli->real_escape_string($_GET['delete']);
    $mysqli->query("DELETE FROM inventory WHERE VIN='$vin'");
    $message = "Car deleted!";
}

/* LOAD CAR FOR EDIT */
$editMode = false;
if (isset($_GET['edit'])) {
    $editMode = true;
    $vin = $mysqli->real_escape_string($_GET['edit']);
    $car = $mysqli->query("SELECT * FROM inventory WHERE VIN='$vin'")->fetch_assoc();
}

/* UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
    $vin = $_POST['VIN'];
    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $price = $_POST['ASKING_PRICE'];

    $stmt = $mysqli->prepare("UPDATE inventory SET Make=?, Model=?, ASKING_PRICE=? WHERE VIN=?");
    $stmt->bind_param("ssds", $make, $model, $price, $vin);
    $stmt->execute();

    $message = "Car updated!";
}

/* READ */
$cars = $mysqli->query("SELECT * FROM inventory ORDER BY Make, Model");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Helpful Crane's Used Cars</title>
    <link rel="stylesheet" href="styles/default.css">
</head>
<body>

<h1>Helpful Crane's Used Cars</h1>

<?php if ($message): ?>
    <p style="color:green;"><?php echo $message; ?></p>
<?php endif; ?>

<!-- SMART FORM: ADD + EDIT -->
<h2><?php echo $editMode ? "Edit Car" : "Add Car"; ?></h2>

<form method="post">
    <input type="hidden" name="action" value="<?php echo $editMode ? 'update' : 'insert'; ?>">

    <?php if ($editMode): ?>
        <input type="hidden" name="VIN" value="<?php echo $car['VIN']; ?>">
    <?php endif; ?>

    VIN:
    <input type="text" name="VIN"
           value="<?php echo $editMode ? $car['VIN'] : ''; ?>"
           <?php echo $editMode ? 'readonly' : 'required'; ?>>
    <br><br>

    Make:
    <input type="text" name="Make"
           value="<?php echo $editMode ? $car['Make'] : ''; ?>"
           required>
    <br><br>

    Model:
    <input type="text" name="Model"
           value="<?php echo $editMode ? $car['Model'] : ''; ?>"
           required>
    <br><br>

    Price:
    <input type="number" step="0.01" name="ASKING_PRICE"
           value="<?php echo $editMode ? $car['ASKING_PRICE'] : ''; ?>"
           required>
    <br><br>

    <button type="submit">
        <?php echo $editMode ? "Update" : "Add"; ?>
    </button>

    <?php if ($editMode): ?>
        <a href="index.php" style="margin-left:20px;">Cancel</a>
    <?php endif; ?>
</form>

<hr>

<h2>Inventory</h2>
<table border="1" cellpadding="8">
<tr>
    <th>Make</th>
    <th>Model</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php while ($car = $cars->fetch_assoc()): ?>
<tr>
    <td><?php echo htmlspecialchars($car['Make']); ?></td>
    <td><?php echo htmlspecialchars($car['Model']); ?></td>
    <td><?php echo htmlspecialchars($car['ASKING_PRICE']); ?></td>
    <td>
        <a href="?edit=<?php echo urlencode($car['VIN']); ?>">Edit</a> |
        <a href="?delete=<?php echo urlencode($car['VIN']); ?>" onclick="return confirm('Delete?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<footer>
    <p>Designed by Hakima Chabane.</p>
    <p>Don’t sue us if the cars are held together with gum.</p>
</footer>

</body>
</html>
