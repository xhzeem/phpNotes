<?php
session_start();
require_once 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    // Get user ID from session
    $user_id = $_SESSION['user_id'];
    
    // Get note details from POST data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $creator_id = $_POST['creator_id'];
    if($creator_id != $user_id)
    {
        echo '<div class="alert alert-success" role="alert">You are a new creator? So creative, here is your flag: FLAG{baa7e6902efcbccb886ba80c70d6d148}</div>';
    }else{
        // Retrieve user's current coin balance from the database
    $sql = "SELECT coins FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_coins = $row['coins'];

        // Check if user has enough coins to create a note
        if ($user_coins > 0) {
            // Insert new note into the database
            $insert_sql = "INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("iss", $user_id, $title, $content);
            $insert_stmt->execute();

            // Decrement user's coin balance after creating the note
            $updated_coins = $user_coins - 1;
            $update_coins_sql = "UPDATE users SET coins = ? WHERE id = ?";
            $update_coins_stmt = $conn->prepare($update_coins_sql);
            $update_coins_stmt->bind_param("ii", $updated_coins, $user_id);
            $update_coins_stmt->execute();

            // Redirect to notes.php after successful note creation
            header('Location: notes.php');
            exit;
        } else {
            // User does not have enough coins to create a note
            echo "You do not have enough coins to create a note.";
            exit;
        }
    } else {
        // User not found (should not happen if user is logged in)
        echo "User not found.";
        exit;
    }
    }

    
} else {
    // Redirect to the notes.php page if accessed via GET request
    header('Location: notes.php');
    exit;
}
?>
