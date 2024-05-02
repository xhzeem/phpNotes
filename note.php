<?php
require_once 'db.php';

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $note_id = $_GET['id'];

    // Retrieve the note from the database based on the provided ID
    $sql = "SELECT title, content FROM notes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display the note if found
    if ($result->num_rows > 0) {
        $note = $result->fetch_assoc();
    } else {
        // Note not found, handle error (e.g., redirect back to notes.php)
        header('Location: notes.php');
        exit;
    }
} else {
    // 'id' parameter not provided, handle error (e.g., redirect back to notes.php)
    header('Location: notes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Note Details</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $note['title'] ?></h4>
                <p class="card-text"><?= htmlspecialchars($note['content']) ?></p>
                <a href="notes.php" class="btn btn-primary">Back to Notes</a>
            </div>
        </div>
    </div>
</body>
</html>
