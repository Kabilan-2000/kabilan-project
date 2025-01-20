<?php
include 'db.php';

$lead = $_POST['lead'] ?? '';
$account = $_POST['account'] ?? '';
$date = $_POST['date'] ?? '';
$status = $_POST['status'] ?? '';

$sql = "SELECT * FROM crm_data WHERE 1=1";

if (!empty($lead)) {
    $sql .= " AND lead_name LIKE '%" . $conn->real_escape_string($lead) . "%'";
}
if (!empty($account)) {
    $sql .= " AND account_name LIKE '%" . $conn->real_escape_string($account) . "%'";
}
if (!empty($date)) {
    $sql .= " AND date = '" . $conn->real_escape_string($date) . "'";
}

if (!empty($status)) {
    $sql .= " AND status = '" . $conn->real_escape_string($status) . "'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Filter</title>
</head>
<body>
    <h1>CRM Filter</h1>
    <form method="POST" action="crm_filter.php">
        <label for="lead">Lead Name:</label>
        <input type="text" id="lead" name="lead" value="<?php echo htmlspecialchars($lead); ?>"><br><br>

        <label for="account">Account Name:</label>
        <input type="text" id="account" name="account" value="<?php echo htmlspecialchars($account); ?>"><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>"><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="">--Select Status--</option>
            <option value="Open" <?php if ($status == "Open") echo "selected"; ?>>Open</option>
            <option value="Closed" <?php if ($status == "Closed") echo "selected"; ?>>Closed</option>
            <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option>
        </select><br><br>

        <button type="submit">Filter</button>
    </form>

    <h2>Results</h2>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>Lead Name</th>
            <th>Account Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['lead_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['account_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No results found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
