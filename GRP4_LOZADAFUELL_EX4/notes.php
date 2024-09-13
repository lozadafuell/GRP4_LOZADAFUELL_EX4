<?php
$files = glob("*.txt");
$content = '';
$fileToDelete = '';

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
        $content = file_get_contents($file);
        $fileToDelete = $file;
    } else {
        $content = "File does not exist or is not a valid text file.";
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
        <h1>View Notes</h1>

        <div class="note-list">
            
            <?php if (!empty($files)) : ?>
                <ul>
                    <?php foreach ($files as $file) : ?>
                        <li><a href="notes.php?file=<?php echo urlencode($file); ?>"><?php echo htmlspecialchars($file); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No notes found.</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($content)) : ?>
            <div class="note-content-container">
                <h2>Note Content</h2>
                <div class="note-content">
                    <?php echo htmlspecialchars($content); ?>
                </div>
            </div>

            <div class="action-buttons">
                <a href="index.php" class="btn">Menu</a>
                <a href="delete.php?file=<?php echo urlencode($fileToDelete); ?>" class="btn delete">Delete Note</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
