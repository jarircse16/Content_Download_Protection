<?php
// Server-side logic to handle GIF requests
// Check if the HTTP header indicates a download request
if (isset($_SERVER['HTTP_RANGE']) || isset($_SERVER['HTTP_X_CONTENT_RANGE'])) {
    // Redirect to the homepage if it's a download request
    header("Location: /index.php");
    exit;
}

// Define the directory where your GIF files are stored
$gifDirectory = './media/gif/';

// Use glob to list all GIF files in the directory
$gifFiles = glob($gifDirectory . '*.gif');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIF Gallery</title>
    <!-- Client-side code to disable right-click menu -->
    <script>
        // Disable right-click menu for the entire page
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>
    <link rel="stylesheet" type="text/css" href="css\background.css">
</head>
<body class="gradient-bg">
    <center><h1>GIF Gallery</h1>

    <?php
    // Dynamically generate img elements for all GIF files in the directory
    foreach ($gifFiles as $gifFile) {
        $gifFileName = basename($gifFile);
        $data = file_get_contents($gifDirectory . $gifFileName);
        $base64Data = base64_encode($data);

        echo '<div class="gif">';
        echo '<img src="data:image/gif;base64,' . $base64Data . '" alt="' . $gifFileName . '">';
        echo '</div>';
    }
    ?>
  </center><br><center><button class="hover-button"><a href="index.php">Go Back</a></button></center>
</body>
</html>
