<?php
    session_start();
    require_once 'db.php';

    // Retrieve number of coins and price from URL parameters
    $coins = isset($_REQUEST['coins']) ? intval($_REQUEST['coins']) : 0;
    $price = isset($_REQUEST['price']) ? intval($_REQUEST['price']) : 0;

    if ($price < 1 && $coins > 0) {
        $user_id = $_SESSION['user_id'];
    
        $update_sql = "UPDATE users SET coins = coins + ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ii", $coins, $user_id);
        $stmt->execute();

        echo '<div class="alert alert-success" role="alert">Nice Job, You bypassed the payment system, your flag is: FLAG{8f1f6224ba39be1bf6c0e80938599a98}</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Payment Gateway</h2>
        
        <!-- Payment Details -->
        <div class="alert alert-info">
            <p><strong>Number of Coins:</strong> <?php echo $coins; ?></p>
            <p><strong>Total Price:</strong> $<?php echo $price; ?></p>
        </div>
        
        <!-- Credit Card Form -->
        <div class="card p-4">
            <h4 class="mb-3">Enter Credit Card Details</h4>
            <form method="post">
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form>
        </div>
    </div>
</body>
</html>