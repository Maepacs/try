<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM Employees");
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Employees</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <a href="create_employee.php" class="button">Create New Employee</a>
    <h2>Employee List</h2>
    
    <table id="employeeTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
    <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['EmployeeID']; ?></td>
            <td><?php echo $employee['FirstName'] . " " . $employee['LastName']; ?></td>
            <td><?php echo $employee['Position']; ?></td>
            <td><?php echo $employee['BasicSalary']; ?></td>
            <td>
                <button class="payroll-button" 
                        onclick="openPayroll('<?php echo $employee['EmployeeID']; ?>', '2023-10-01', 40, 1000, 800)">
                    Payroll
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
</div>

<script>
   function openPayroll(employeeID, paydate, hoursWorked, grossPay, netPay) {
    // Construct the URL with query parameters
    const url = `payroll.php?employeeID=${employeeID}&paydate=${paydate}&hoursWorked=${hoursWorked}&grossPay=${grossPay}&netPay=${netPay}`;
  
    // Logic to open payroll system or redirect to payroll page
    alert("Redirecting to Payroll System...");
    window.location.href = url; // Redirect to the constructed URL
}
</script>
<!-- Include jQuery and DataTables CSS/JS files -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>

</body>
</html>