<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the restaurant details
    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE gym_id = ?");
    $stmt->execute([$id]);
    $gym_id = $stmt->fetch();

    if (!$gym_id) {
        echo "Restaurant not found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Restaurant</title>
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
    <h1>Gym Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>Name:</th>
            <td><?php echo $gym_id['name']; ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?php echo $gym_id['address']; ?></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td><?php echo $gym_id['phone_number']; ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php echo $gym_id['email']; ?></td>
        </tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
