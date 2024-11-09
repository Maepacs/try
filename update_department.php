<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentId = $_POST['department_id'];
    $departmentName = $_POST['department_name'];

    $stmt = $pdo->prepare("UPDATE Departments SET DepartmentName = ? WHERE DepartmentID = ?");
    if ($stmt->execute([$departmentName, $departmentId])) {
        $message = "Department updated successfully!";
    } else {
        $message = "Error updating department.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Department</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Update Department</h2>
    <form method="post">
        <input type="number" name="department_id" placeholder="Department ID" required>
        <input type="text" name="department_name" placeholder="Department Name" required>
        <button type="submit">Update Department</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
