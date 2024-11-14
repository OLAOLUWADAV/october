<?php
session_start();

if (isset($_POST['submit']) && isset($_FILES['picture'])) {
    $name = $_FILES['picture']['name'];
    $temp = $_FILES['picture']['tmp_name'];
    $type = $_FILES['picture']['type'];

    $newname = time() . '_' . $name;
    $uploadDir = 'pictureuploads/';
    $uploadPath = $uploadDir . $newname;

    
    if (move_uploaded_file($temp, $uploadPath, )) {
        
        $_SESSION['uploaded_image'] = $uploadPath;
        $_SESSION['type'] = $type;

        
        header("Location: dashboard.php");
        exit;
    } else {
        echo 'File upload failed. Please check file permissions and directory existence.';
    }
} else {
    echo 'No file uploaded or form not submitted.';
}
?>
