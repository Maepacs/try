<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentId = $_POST['department_id'];

    $stmt = $pdo->prepare("DELETE FROM Departments WHERE DepartmentID = ?");
    if ($stmt->execute([$departmentId])) {
        $message = "Department deleted successfully!";
    } else {
        $message = "Error deleting department.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Department</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Delete Department</h2>
    <form method="post">
        <input type="number" name="department_id" placeholder="Department ID" required>
        <button type="submit">Delete Department</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
