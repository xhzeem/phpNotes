<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Coins</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Buy Coins</h2>
        <form action="pay.php" method="post">
            <div class="form-group">
                <label for="coins">Number of Coins to Buy, please note that each coin is <b>$3</b>:</label>
                <input type="number" class="form-control" id="coins" name="coins" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Buy Coins</button>
        </form>
    </div>
</body>
</html>
