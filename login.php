<?php
require 'connect.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    // Debugging: output form data
    print_r($_POST);

    // Prepared statement for security
    $query = "SELECT * FROM users_table WHERE email = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userid = $user['user_id'];
            $hashedpassword = $user['password'];

            echo $_SESSION['user_id'];
                // $_SESSION['msg']='Email exists already';
        header('location:dashboard.php');

            if (password_verify($password, $hashedpassword)) {
                $_SESSION['id'] = $userid;
                echo $_SESSION['user_id'];
                
            } else {
                echo 'Invalid password';
            }
            print_r($user); // Debugging output
        } else {
            echo '<div class="text-primary text-center">User does not exist</div>';
        }
    } else {
        echo '<div class="text-primary text-center">Query failed</div>';
    }
} else {
    echo 'Form not submitted';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</body>
</html>
