<?php
session_start();
require_once 'db.php';
// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: notes.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $coins = $_POST['coins'];
    
    // Check if the username already exists
    $check_sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->bind_result($user_count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($user_count > 0) {
        echo '<div class="alert alert-danger" role="alert">Error: Username already exists.</div>';
    } else {
        $sql = "INSERT INTO users (username, password, coins) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $password, $coins);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success" role="alert">User registered successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: Could not register user.</div>';
        }

        $stmt->close();
    }

    
    if ($_POST['coins'] > 0) {
        echo '<div class="alert alert-success" role="alert">Nice Job, you have more coins now!! Your flag is: FLAG{785031e1f84c167a2409ee0611350f30}</div>';
    }
    
    if (strtolower($_POST['is_admin']) == 'true') {
        echo '<div class="alert alert-success" role="alert">Nice Job, you changed to admin! Your flag is: FLAG{507e04e8a2b97ef8089b40c895c2551e}</div>';
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Register</h2>
        <form method="post">
            <input type="hidden" name="is_admin" value="false">
            <input type="hidden" name="coins" value="0">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <hr class="m-5">
        <a href="login.php" class="btn btn-success mt-3 btn-block">Login</a>
    </div>
</body>
</html>
