<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "Please log in to access the dashboard.";
    exit;
}

// $firstname = $_SESSION['firstname'];
// $email = $_SESSION['email'];


$imagePath = isset($_SESSION['uploaded_image']) ? $_SESSION['uploaded_image'] : null;
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>WELCOME TO DASHBOARD</h1>
    <!-- <p>MY NAME IS <span><?php echo htmlspecialchars($firstname); ?></span> and my email is <span><?php echo htmlspecialchars($email); ?></span></p> -->
    
    <h1>NOTE APP</h1>

    <div>
        <form action="pictureuploads.php" method="post" enctype="multipart/form-data">
            <input type="file" name="picture">
            <input type="submit" name="submit" value="upload">
        </form>
    </div>

    <?php if ($imagePath): ?>
        <h2>Your Uploaded Picture</h2>
        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Uploaded Picture" style="max-width: 300px;">
            <?php else: ?>
        <p>No image uploaded yet.</p>
    <?php endif; ?>
</body>
</html>
