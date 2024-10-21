<?php
require 'db.php';

// Fetch all restaurants from the database
$stmt = $pdo->query("SELECT * FROM restaurants");
$gym_id = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym List</title>
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
<div class="container">
    <h1 class="mt-4">Gym</h1>
    <a href="edit.php" class="btn btn-primary mb-4">Add New Gym</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gym_id as $restaurant): ?>
                <tr>
                    <td><?php echo $restaurant['gym_id']; ?></td>
                    <td><?php echo $restaurant['name']; ?></td>
                    <td><?php echo $restaurant['address']; ?></td>
                    <td><?php echo $restaurant['phone_number']; ?></td>
                    <td><?php echo $restaurant['email']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $restaurant['gym_id']; ?>" class="btn btn-info">View</a>
                        <a href="edit.php?id=<?php echo $restaurant['gym_id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $restaurant['gym_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this restaurant?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
