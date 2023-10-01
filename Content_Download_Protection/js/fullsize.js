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
