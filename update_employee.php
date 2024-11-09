<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employee_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $position = $_POST['position'];
    $departmentId = $_POST['department_id'];
    $basicSalary = $_POST['basic_salary'];

    $stmt = $pdo->prepare("UPDATE Employees SET FirstName = ?, LastName = ?, Position = ?, DepartmentID = ?, BasicSalary = ? WHERE EmployeeID = ?");
    if ($stmt->execute([$firstName, $lastName, $position, $departmentId, $basicSalary, $employeeId])) {
        $message = "Employee updated successfully!";
    } else {
        $message = "Error updating employee.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Update Employee</h2>
    <form method="post">
        <input type="number" name="employee_id" placeholder="Employee ID" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="position" placeholder="Position" required>
        <input type="number" name="department_id" placeholder="Department ID" required>
        <input type="number" name="basic_salary" placeholder="Basic Salary" required>
        <button type="submit">Update Employee</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
