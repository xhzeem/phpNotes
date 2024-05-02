<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user = null;
$update_success = false;

// Check if 'id' parameter is provided in the URL and retrieve user details
if (isset($_GET['id'])) {
    $requested_user_id = $_GET['id'];

    // Fetch user details from the database based on the requested user ID
    $sql = "SELECT id, username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requested_user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    // If no 'id' parameter is provided, default to the logged-in user's profile
    $sql = "SELECT id, username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

// Handle form submission to update user profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_user_id = $_POST['userid'];
    $new_password = $_POST['password'];

    // Update user profile in the database
    $update_sql = "UPDATE users SET password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ss", $new_password, $update_user_id);
    
    if ($update_stmt->execute()) {
        // Update successful
        $update_success = true;
    }

    if ($_SESSION['user_id'] != $update_user_id){
        echo '<div class="alert alert-success" role="alert">Nice Job, you updated some else\'s password. your flag is: CyberX{e0b3a8667c7ea10bf9fe6140a6e063f5}</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">User Profile</h2>

        <?php if ($update_success): ?>
            <div class="alert alert-success" role="alert">
                Profile updated successfully!
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="userid" class="form-control" value="<?= htmlspecialchars($user['id']) ?>" required>
            <div class="form-group">
                <input type="text" id="username" name="username" disabled class="form-control" value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div class="form-group">
                <label for="password">Update Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <hr>
        <a href="notes.php" class="btn btn-secondary">Back to Notes</a>
        <a href="logout.php" class="btn btn-danger float-right">Logout</a>
    </div>
</body>
</html>
