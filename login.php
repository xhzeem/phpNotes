<?php
session_start();
    // Check if user is already logged in
    if (isset($_SESSION['user_id'])) {
        header('Location: notes.php');
        exit;
    }
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // $sql = "SELECT id, username, password FROM users WHERE username = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("s", $username);
    // $stmt->execute();
    // $result = $stmt->get_result();

    
    // if ($result->num_rows == 1) {
    //     $user = $result->fetch_assoc();
    //     if (password_verify($password, $user['password'])) {
    //         $_SESSION['user_id'] = $user['id'];
    //         header('Location: notes.php');
    //         exit;
    //     } else {
    //         echo 'Invalid username or password.';
    //     }
    // } else {
    //     echo 'Invalid username or password.';
    // }
    // Introduce SQL injection vulnerability by concatenating $password into the SQL query
    $sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        header('Location: notes.php');
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Invalid username or password.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
        <hr class="m-5">
        <a href="register.php" class="btn btn-primary mt-3 btn-block">Register</a>
    </div>
</body>
</html>

</html>
