<?php
// Server-side logic to handle audio requests
// Check if the HTTP header indicates a download request
if (isset($_SERVER['HTTP_RANGE']) || isset($_SERVER['HTTP_X_CONTENT_RANGE'])) {
    // Redirect to the homepage if it's a download request
    header("Location: /index.php");
    exit;
}

// Define the directory where your audio files are stored
$audioDirectory = './media/audio/';

// Use glob to list all audio files in the directory
$audioFiles = glob($audioDirectory . '*.dat');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Gallery</title>
    <link rel="stylesheet" type="text/css" href="css\background.css">
    <!-- Client-side code to disable right-click menu -->
    <script>
        // Disable right-click menu for the entire page
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>

</head>
<body class="gradient-bg">
    <center><h1>Audio Gallery</h1>

    <?php
    // Dynamically generate audio elements for all audio files in the directory
    foreach ($audioFiles as $audioFile) {
        $audioFileName = basename($audioFile);
        $data = file_get_contents($audioDirectory . $audioFileName);
        $base64Data = base64_encode($data);

        echo '<div class="audio">';
        echo '<audio controls controlsList="nodownload">';
        echo '<source src="data:audio/mpeg;base64,' . $base64Data . '" type="audio/mpeg">';
        echo 'Your browser does not support the audio tag.';
        echo '</audio>';
        echo '</div>';
    }
    ?>
  </center><br><center><button class="hover-button"><a href="index.php">Go Back</a></button></center>
</body>
</html>
