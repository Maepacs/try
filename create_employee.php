<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $position = $_POST['position'];
    $departmentId = $_POST['department_id'];
    $basicSalary = $_POST['basic_salary'];

    // Check for duplicates
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM Employees WHERE FirstName = ? AND LastName = ? AND Position = ?");
    $checkStmt->execute([$firstName, $lastName, $position]);
    $duplicateCount = $checkStmt->fetchColumn();

    if ($duplicateCount > 0) {
        $message = ' Employee already exists.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO Employees (FirstName, LastName, Position, DepartmentID, BasicSalary) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$firstName, $lastName, $position, $departmentId, $basicSalary])) {
            $message = 'Employee created successfully!';
        } else {
            $message = 'Error creating employee.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function setDepartmentId() {
            const positionSelect = document.querySelector('select[name="position"]');
            const departmentIdInput = document.querySelector('input[name="department_id"]');
            const positionValue = positionSelect.value;

            switch (positionValue) {
                case 'System Administrator':
                    departmentIdInput.value = 1;
                    break;
                case 'Network Engineer':
                    departmentIdInput.value = 2;
                    break;
                case 'Analyst':
                    departmentIdInput.value = 3;
                    break;
                case 'Web Developer':
                    departmentIdInput.value = 4;
                    break;
                case 'IT Support':
                    departmentIdInput.value = 5;
                    break;
                default:
                    departmentIdInput.value = ''; // Clear the input if no valid position is selected
            }
        }
    </script>
</head>
<body>
<div class="container">
     <a href="read_employees.php" class="button">View Employees</a>
    <h2>Create Employee</h2>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <select name="position" onchange="setDepartmentId()">
            <option required disabled value="">Select Position</option>
            <option value="System Administrator">System Administrator</option>
            <option value="Network Engineer">Network Engineer</option>
            <option value="Analyst">Analyst</option>
            <option value="Web Developer">Web Developer</option>
            <option value="IT Support">IT Support</option>
        </select>

        <input type="number" name="department_id" placeholder="Department ID" required readonly>
        <input type="number" name="basic_salary" placeholder="Basic Salary" required>
    
        <button type="submit">Create Employee</button>
    </form>
   
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>

</script>
</body>
</html>