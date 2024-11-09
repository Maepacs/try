<?php
// Database configuration
$host = 'localhost';
$dbname = 'payroll_db';
$username = 'root';
$password = '';

// Retrieve employeeID from the URL parameter
$employeeID = $_GET['employeeID'] ?? null;

// If the form is submitted, retrieve POST data
$paydate = $_POST['paydate'] ?? null;
$hoursWorked = $_POST['hoursWorked'] ?? null;
$grossPay = $_POST['grossPay'] ?? null;
$netPay = $_POST['netPay'] ?? null;

// Check if all required parameters are present and valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $employeeID && $paydate && $hoursWorked && $grossPay && $netPay) {
    try {
        // Establish a database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert payroll data into the database
        $stmt = $pdo->prepare("INSERT INTO payroll (employee_id, paydate, hours_worked, gross_pay, net_pay)
                               VALUES (:employee_id, :paydate, :hours_worked, :gross_pay, :net_pay)");

        $stmt->execute([
            ':employee_id' => htmlspecialchars($employeeID),
            ':paydate' => htmlspecialchars($paydate),
            ':hours_worked' => htmlspecialchars($hoursWorked),
            ':gross_pay' => htmlspecialchars($grossPay),
            ':net_pay' => htmlspecialchars($netPay),
        ]);

        echo "Payroll record successfully added for Employee ID: " . htmlspecialchars($employeeID);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payroll Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Payroll Information for Employee ID: <?php echo htmlspecialchars($employeeID); ?></h2>
    
    <form action="" method="post">
        <input type="hidden" name="employeeID" value="<?php echo htmlspecialchars($employeeID); ?>">
        
        <label for="paydate">Pay Date:</label>
        <input type="date" id="paydate" name="paydate" value="<?php echo htmlspecialchars($paydate); ?>" required>
        
        <label for="hoursWorked">Hours Worked:</label>
        <input type="number" id="hoursWorked" name="hoursWorked" step="0.01" value="<?php echo htmlspecialchars($hoursWorked); ?>" required>
        
        <label for="grossPay">Gross Pay:</label>
        <input type="number" id="grossPay" name="grossPay" step="0.01" value="<?php echo htmlspecialchars($grossPay); ?>" required>
        
        <label for="netPay">Net Pay:</label>
        <input type="number" id="netPay" name="netPay" step="0.01" value="<?php echo htmlspecialchars($netPay); ?>" required>
        
        <button type="submit">Submit Payroll</button>
    </form>
</div>
</body>
</html>
