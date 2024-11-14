<?php
echo 'process';
require 'connect.php';
session_start();


// Debug: Print the POST data to confirm it was received

// Check if required POST variables are set
if (isset($_POST['submit'])) {
    print_r($_POST);

    $fname = $_POST['firstname'] ;
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $add = $_POST['address'];
    $pass = $_POST['password'];

    // Check if email already exists
    $queryone = "SELECT * FROM users_table WHERE email='$email'";
    $databaseconnect = $connect->query($queryone);

    if ($databaseconnect) {
        // echo 'query successful';
        if ($databaseconnect->num_rows > 0) {
            echo 'Email exists already';
        $_SESSION['msg']='Email exists already';
        header('location:signup.php');
        } 
        else {
            // Hash the password
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Insert new user data
            $query = "INSERT INTO `users_table`(`firstname`, `lastname`, `address`, `email`, `password`) 
                      VALUES ('$fname', '$lname', '$add', '$email', '$hash')";
            $databaseconnect = $connect->query($query);

            if ($databaseconnect) {
                // echo 'Data inserted successfully';
                header('location:login.php');
            } else {
                // echo 'Insert query failed';
            }
        }
     }
     else {
        echo 'Email check query failed';
    }
} 

?>
