<?php
session_start();
echo 'picture page<br>';

if (isset($_POST['submit']) && isset($_FILES['picture'])) {
    $name = $_FILES['picture']['name'];
    $temp = $_FILES['picture']['tmp_name'];

    // Create a unique filename
    $newname = time() . '_' . $name;
    $uploadDir = 'pictureuploads/';
    $uploadPath = $uploadDir . $newname;

    // Move the file to the uploads directory
    if (move_uploaded_file($temp, $uploadPath)) {
        echo 'File successfully moved to "' . htmlspecialchars($uploadPath) . '"';

        // Store the image path in the session
        $_SESSION['uploaded_image'] = $uploadPath;

        // Redirect to the dashboard after upload
        header("Location: dashboard.php");
        exit;
    } else {
        echo 'File upload failed. Please check file permissions and directory existence.';
    }
} else {
    echo 'No file uploaded or form not submitted.';
}
?>
