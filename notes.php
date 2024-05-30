<?php
session_start();
require_once 'db.php';
$cookie_name = "secret";
    $cookie_value = "FLAG{4c2a904bafba06591225113ad17b5cec}";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$search_keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Retrieve user's notes based on search keyword (if provided)
if (!empty($search_keyword)) {
    // Search notes based on title or content containing the search keyword
    $search_pattern = "%$search_keyword%";
    // $temp_sql = "SELECT id, title, content FROM notes WHERE user_id = ? AND (title LIKE $search_pattern OR content LIKE $search_pattern)";
    // $sql = $temp_sql;
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $user_id);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $notes = $result->fetch_all(MYSQLI_ASSOC);
  
    // enable the sql errors
    //mysqli_report(MYSQLI_REPORT_ERROR);
    $sql = "SELECT * FROM notes WHERE title LIKE '%$search_keyword%' AND user_id = $user_id;";
    $result = $conn->query($sql);
    if ($result) {
        $notes = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Handle SQL error
        echo "<div class='alert alert-danger' role='alert'>Error in SQL statment: $sql</div>";
        
        // Set $notes to an empty array if query fails
        $notes = array(); 
    }
} else {
    // Retrieve all notes for the logged-in user
    $sql = "SELECT id, title, content FROM notes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $notes = $result->fetch_all(MYSQLI_ASSOC);
}

$sql = "SELECT coins FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_coins = $row['coins'];
}
if ($user_id == 1){
    echo '<div class="alert alert-success" role="alert">Nice Job, you hacked the admin account flag is: FLAG{e947c33096ce026eaab6a988ca59f701}</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">My Notes App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-success">Coins: <?=$user_coins?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buy_coins.php">Buy Coins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?id=<?=$user_id?>">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">My Notes</h2>

        <!-- Search Form -->
        <form method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search notes..." value="<?= $search_keyword ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Display Notes -->
        <div class="list-group">
            <?php if (!empty($notes)): ?>
                <?php foreach ($notes as $note): ?>
                    <a href="note.php?id=<?= $note['id'] ?>" class="list-group-item list-group-item-action">
                        <h5 class="mb-1"><?= htmlspecialchars($note['title']) ?></h5>
                        <p class="mb-1"><?= htmlspecialchars($note['content']) ?></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No notes found.</p>
            <?php endif; ?>
        </div>

        <hr>
        <form method="post" action="save_note.php" class="mb-5 pb-5">
            <input type="hidden" name="creator_id" value="<?=$user_id?>">

            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" placeholder="Content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Save Note</button>
        </form>    
    </div>
</body>
</html>
