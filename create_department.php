<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentName = $_POST['department_name'];

    // Check if the department already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Departments WHERE DepartmentName = ?");
    $stmt->execute([$departmentName]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<script>alert('Department already exists.');</script>";
    } else {
        // Insert the selected department name into the database
        $stmt = $pdo->prepare("INSERT INTO Departments (DepartmentName) VALUES (?)");
        if ($stmt->execute([$departmentName])) {
            echo "<script>alert('Department created successfully!');</script>";
            // Redirect to the same page to reset the form
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Error creating department.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Create Department</h2>
    <form method="post">
        <!-- Dropdown for selecting a department -->
        <select name="department_name" required>
            <option disabled select value="">Select Department</option>
            <option value="Infrastructure">Infrastructure</option>
            <option value="Network">Network</option>
            <option value="Security">Security</option>
            <option value="Development">Development</option>
            <option value="Support">Support</option>
        </select>
        <button type="submit">Create Department</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>