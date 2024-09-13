<?php
$confirmation_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $note_title = trim($_POST['note_title']);
    $note_content = $_POST['note_content'];

    if (!empty($note_title)) {
        $note_title = preg_replace('/[^A-Za-z0-9_\-]/', '', $note_title);
        $file_path = __DIR__ . "/" . $note_title . ".txt";

        file_put_contents($file_path, $note_content);

        $confirmation_message = "Note '$note_title.txt' has been created successfully!";
    } else {
        $error_message = "Please enter a valid note name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="img/notepad-icon.png">
    <title>Notepad 360</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add a New Note</h1>

        <?php if (!empty($confirmation_message)) : ?>
            <p style="color: lightgreen; font-size: 18px;"><?php echo $confirmation_message; ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)) : ?>
            <p style="color: lightred; font-size: 18px;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="add.php" method="POST">
            <label for="note_title">Note Name:</label><br>
            <input type="text" id="note_title" name="note_title" required><br><br>

            <label for="note_content">Note Content:</label><br>
            <textarea id="note_content" name="note_content" rows="10" required></textarea><br><br>

            <input type="submit" value="Add Note">
        </form>

        <a href="index.php">Menu</a>
    </div>
</body>
</html>
