<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/background.css">
    <!-- Client-side code to disable right-click menu -->
    <script>
        // Disable right-click menu for the entire page
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>
</head>
<body class="gradient-bg">
    <center><h1>Image Gallery</h1>

    <?php
    // Server-side logic to handle image requests

    // Check if the HTTP header indicates a download request
    if (isset($_SERVER['HTTP_RANGE']) || isset($_SERVER['HTTP_X_CONTENT_RANGE'])) {
        // Redirect to the homepage if it's a download request
        header("Location: /index.php");
        exit;
    }

    // Define the directory where your image files are stored
    $imageDirectory = './media/images/';

    // Use glob to list all image files in the directory
    $imageFiles = glob($imageDirectory . '*.png');

    // Dynamically generate image elements for all image files in the directory
    foreach ($imageFiles as $imageFile) {
        $imageFileName = basename($imageFile);
        echo '<div class="gallery" onclick="showFullSize(\'' . $imageFileName . '\')" oncontextmenu="return false;">';
        echo '<img class="thumbnail" src="' . $imageDirectory . $imageFileName . '" alt="' . $imageFileName . '">';
        echo '</div>';
    }
    ?>
 </center><br><br>
  <center><button class="hover-button"><a href="index.php">Go Back</a></button></center>

  <!-- Hidden modal for full-size images -->
  <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img id="fullSizeImage" class="modal-content">
  </div>

  <!-- JavaScript to show full-size image on click -->
  <script>
      function showFullSize(imageName) {
          var modal = document.getElementById('imageModal');
          var fullSizeImage = document.getElementById('fullSizeImage');

          // Set the source of the full-size image
          fullSizeImage.src = '<?php echo $imageDirectory; ?>' + imageName;

          // Disable right-click context menu for the full-size image
          fullSizeImage.oncontextmenu = function (e) {
              e.preventDefault();
          };

          // Display the modal
          modal.style.display = 'block';
      }

      function closeModal() {
          var modal = document.getElementById('imageModal');
          modal.style.display = 'none';
      }

      // Close the modal when the user clicks anywhere outside of the image
      window.onclick = function (event) {
          var modal = document.getElementById('imageModal');
          if (event.target === modal) {
              modal.style.display = 'none';
          }
      }
  </script>

</body>
</html>
