<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $accountNumber = htmlspecialchars($_POST['account_number']);
    $transactionType = $_POST['transaction_type'];
    $amount = (float) $_POST['amount'];

    if (empty($name) || empty($accountNumber) || empty($transactionType) || $amount <= 0) {
        $error = "All fields are required, and the amount must be greater than 0.";
    } else {
        $message = "Transaction successful!\n";
        $message .= "Name: $name\n";
        $message .= "Account Number: $accountNumber\n";
        $message .= "Transaction Type: $transactionType\n";
        $message .= "Amount: $amount\n";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Amount Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<h2>Banking Amount Transaction </h2>

<?php if (!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
<?php elseif (!empty($message)): ?>
    <p class="success" style="white-space: pre-line;"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Account Holder Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="account_number">Account Number:</label>
    <input type="text" id="account_number" name="account_number" required>

    <label for="transaction_type">Transaction Type:</label>
    <select id="transaction_type" name="transaction_type" required>
        <option value="">--Select--</option>
        <option value="Deposit">Deposit</option>
        <option value="Withdrawal">Withdrawal</option>
    </select>

    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" step="0.01" required>

    <button type="submit">Submit</button>
</form>

</body>
</html>
