<?php
if (isset($_REQUEST['coins'])) {
    $coins = $_REQUEST['coins'];
    
    if (is_numeric($coins)) {
        $price = $coins * 3;
    } else {
        $price = 0; 
    }

} else {
    // Redirect back to buy_coins.php if accessed via GET request
    header("Location: buy_coins.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <h2 class="mb-4">Payment Details</h2>
        <p><strong>Number of Coins:</strong> <?php echo $coins; ?></p>
        <p><strong>Total Price:</strong> $<?php echo $price; ?></p>
        
        <!-- Payment Form -->
        <form action="payment_gateway.php" method="post">
            <input type="hidden" name="coins" value="<?php echo $coins; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
