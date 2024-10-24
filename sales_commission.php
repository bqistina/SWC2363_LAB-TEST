<?php
include 'db_connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $month = trim($_POST['month']);
    $sales = trim($_POST['sales']);
    $commission = trim($_POST['commission']);

    // Initialize the commission variable
    $commission = 0;

    // Validate and calculate commission based on sales amount
    if (!empty($sales) && is_numeric($sales) && $sales >= 0) {
        $sales = floatval($sales); // Convert sales amount to a floating-point number

        // Apply the commission rate based on the sales amount
        if ($sales >= 1 && $sales <= 2000) {
            $commission = $sales * 0.03; // 3% commission
        } elseif ($sales >= 2001 && $sales <= 5000) {
            $commission = $sales * 0.04; // 4% commission
        } elseif ($sales >= 5001 && $sales <= 7000) {
            $commission = $sales * 0.07; // 7% commission
        } elseif ($sales >= 7001) {
            $commission = $sales * 0.10; // 10% commission
        }

         // Insert the data into the database
         $sql = "INSERT INTO sales_commission_database (ID, Name, Month, Sales Amount, Commission)
         VALUES ('$id, '$name', '$month', $sales, $commission)";

    } else {
        echo "Please enter a valid numeric sales amount.";
        exit;
    }

    // Display the result
    echo "<h2>Sales Commission</h2>";
    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>Month: " . htmlspecialchars($month) . "</p>";
    echo "<p>Sales Amount: RM " . number_format($sales, 2) . "</p>";
    echo "<p>Commission: RM " . number_format($commission, 2) . "</p>";
}
?>
