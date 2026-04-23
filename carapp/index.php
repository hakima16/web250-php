
<?php
require 'config_db.php';

$message = '';

/* CREATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insert') {
    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $price = $_POST['ASKING_PRICE'];

    $stmt = $mysqli->prepare("INSERT INTO inventory (Make, Model, ASKING_PRICE) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $make, $model, $price);
    $stmt->execute();

    $message = "Car added!";
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $mysqli->query("DELETE FROM inventory WHERE id=$id");
    $message = "Car deleted!";
}

/* UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $price = $_POST['ASKING_PRICE'];

    $stmt = $mysqli->prepare("UPDATE inventory SET Make=?, Model=?, ASKING_PRICE=? WHERE id=?");
    $stmt->bind_param("ssdi", $make, $model, $price, $id);
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

<h2>Add Car</h2>
<form method="post">
    <input type="hidden" name="action" value="insert">

    Make: <input type="text" name="Make" required><br><br>
    Model: <input type="text" name="Model" required><br><br>
    Price: <input type="number" step="0.01" name="ASKING_PRICE" required><br><br>

    <button type="submit">Add</button>
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
        <a href="?edit=<?php echo $car['id']; ?>">Edit</a> |
        <a href="?delete=<?php echo $car['id']; ?>" onclick="return confirm('Delete?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php if (isset($_GET['edit'])):
    $id = intval($_GET['edit']);
    $car = $mysqli->query("SELECT * FROM inventory WHERE id=$id")->fetch_assoc();
?>
<hr>
<h2>Edit Car</h2>
<form method="post">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?php echo $car['id']; ?>">

    Make: <input type="text" name="Make" value="<?php echo $car['Make']; ?>"><br><br>
    Model: <input type="text" name="Model" value="<?php echo $car['Model']; ?>"><br><br>
    Price: <input type="number" step="0.01" name="ASKING_PRICE" value="<?php echo $car['ASKING_PRICE']; ?>"><br><br>

    <button type="submit">Update</button>
</form>
<?php endif; ?>

<footer>
    <p>Designed by Hakima Chabane.</p>
    <p>Don’t sue us if the cars are held together with gum.</p>
</footer>

</body>
</html>
