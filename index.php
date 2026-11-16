<?php

$units = "";
$bill = 0;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $units = $_POST["units"];

    if ($units === "" || !is_numeric($units) || $units < 0) {
        $error = "Please enter a valid number of units.";
    } else {

        $units = (float)$units;

        // Electricity bill calculation

        if ($units <= 50) {
            $bill = $units * 3.50;
        }

        else if ($units <= 150) {
            $bill = (50 * 3.50) +
                    (($units - 50) * 4.00);
        }

        else if ($units <= 250) {
            $bill = (50 * 3.50) +
                    (100 * 4.00) +
                    (($units - 150) * 5.20);
        }

        else {
            $bill = (50 * 3.50) +
                    (100 * 4.00) +
                    (100 * 5.20) +
                    (($units - 250) * 6.50);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Electricity Bill Calculator</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            background: linear-gradient(135deg, #e0f2fe, #f0f9ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .calculator {
            background: white;
            border-radius: 18px;
            padding: 35px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .title {
            color: #075985;
            font-weight: bold;
        }

        .btn-calculate {
            background: #0284c7;
            color: white;
            border: none;
        }

        .btn-calculate:hover {
            background: #0369a1;
            color: white;
        }

        .result {
            background: #ecfdf5;
            border-left: 5px solid #10b981;
            border-radius: 8px;
            padding: 18px;
        }

        .amount {
            color: #047857;
            font-size: 30px;
            font-weight: bold;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="calculator mx-auto">

        <h2 class="text-center title mb-2">
            Electricity Bill Calculator
        </h2>

        <p class="text-center text-muted mb-4">
            Calculate your electricity consumption charges
        </p>

        <form method="POST" action="">

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Enter Units Consumed
                </label>

                <input
                    type="number"
                    name="units"
                    class="form-control form-control-lg"
                    placeholder="Enter units"
                    min="0"
                    step="any"
                    value="<?php echo htmlspecialchars((string)$units); ?>"
                    required
                >

            </div>

            <button type="submit"
                    class="btn btn-calculate btn-lg w-100">
                Calculate Bill
            </button>

            <a href="index.php"
               class="btn btn-outline-secondary w-100 mt-2">
                Reset
            </a>

        </form>

        <?php if ($error != "") { ?>

            <div class="alert alert-danger mt-4">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $error == "") { ?>

            <div class="result mt-4">

                <h5 class="text-success">
                    Electricity Bill Details
                </h5>

                <p class="mb-1">
                    Units Consumed:
                    <strong><?php echo $units; ?> units</strong>
                </p>

                <p class="mb-2">
                    Rate: As per applicable electricity slabs
                </p>

                <hr>

                <p class="mb-1">Total Amount Payable:</p>

                <div class="amount">
                    ₹ <?php echo number_format($bill, 2); ?>
                </div>

            </div>

        <?php } ?>

        <hr class="mt-4">

        <h6 class="fw-bold text-secondary">
            Electricity Tariff
        </h6>

        <table class="table table-bordered table-sm text-center mt-3">

            <thead class="table-primary">
                <tr>
                    <th>Units</th>
                    <th>Rate</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>0 - 50</td>
                    <td>₹3.50</td>
                </tr>

                <tr>
                    <td>51 - 150</td>
                    <td>₹4.00</td>
                </tr>

                <tr>
                    <td>151 - 250</td>
                    <td>₹5.20</td>
                </tr>

                <tr>
                    <td>Above 250</td>
                    <td>₹6.50</td>
                </tr>
            </tbody>

        </table>

        <p class="text-center text-muted small mb-0">
            Electricity Bill Management System | PHP
        </p>

    </div>

</div>

</body>
</html>
<!--http://localhost/electricity_bill/ ctrl f12 to check responsiveness>