<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM Departments");
$departments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Departments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Department List</h2>
    <?php foreach ($departments as $department): ?>
        <p>ID: <?php echo $department['DepartmentID']; ?> - Name: <?php echo $department['DepartmentName']; ?></p>
    <?php endforeach; ?>
</div>
</body>
</html>
