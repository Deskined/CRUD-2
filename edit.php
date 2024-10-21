<?php
require 'db.php';

$gym_id = '';
$name = '';
$address = '';
$phone = '';
$email = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE gym_id = ?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();

    $gym_id = $restaurant['gym_id'];
    $name = $restaurant['name'];
    $address = $restaurant['address'];
    $phone = $restaurant['phone_number'];
    $email = $restaurant['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($gym_id) {
        // Update existing restaurant
        $stmt = $pdo->prepare("UPDATE restaurants SET name = ?, address = ?, phone_number = ?, email = ? WHERE gym_id = ?");
        $stmt->execute([$name, $address, $phone, $email, $gym_id]);
    } else {
        // Add new restaurant
        $stmt = $pdo->prepare("INSERT INTO restaurants (name, address, phone_number, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $address, $phone, $email]);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $gym_id ? 'Edit' : 'Add'; ?> Gym</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #00b4db, #0083b0); /* Gradient background */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1><?php echo $gym_id ? 'Edit' : 'Add'; ?> Gym</h1>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
</html>