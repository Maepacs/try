<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employee_id'];

    $stmt = $pdo->prepare("DELETE FROM Employees WHERE EmployeeID = ?");
    if ($stmt->execute([$employeeId])) {
        $message = "Employee deleted successfully!";
    } else {
        $message = "Error deleting employee.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Delete Employee</h2>
    <form method="post">
        <input type="number" name="employee_id" placeholder="Employee ID" required>
        <button type="submit">Delete Employee</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
