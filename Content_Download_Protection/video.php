<?php
// Server-side logic to handle video requests

// Check if the HTTP header indicates a download request
if (isset($_SERVER['HTTP_RANGE']) || isset($_SERVER['HTTP_X_CONTENT_RANGE'])) {
    // Redirect to the homepage if it's a download request
    header("Location: /index.php");
    exit;
}

// Define the directory where your video files are stored
$videoDirectory = './media/video/';

// Use glob to list all video files in the directory
$videoFiles = glob($videoDirectory . '*.mp4');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\background.css">
    <title>Video Player</title>
    <!-- Client-side code to disable right-click menu -->
    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>
</head>
<body class="gradient-bg">
    <center><h1>Video Gallery</h1>

    <?php
    // Dynamically generate video elements for all video files in the directory
    foreach ($videoFiles as $videoFile) {
        $videoFileName = basename($videoFile);
        $data = file_get_contents($videoDirectory . $videoFileName);
        $base64Data = base64_encode($data);

        echo '<div class="gallery">';
        echo '<video controls>';
        echo '<source src="data:video/mp4;base64,' . $base64Data . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
        echo '</div>';
    }
    ?></center><br><br>
      <center><button class="hover-button"><a href="index.php">Go Back</a></button></center>

</body>
</html>
