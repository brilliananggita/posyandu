<?php
include 'koneksi.php';

// Assuming you have a valid database connection in $koneksi
session_start();

// Check for POST data
if(isset($_POST['username']) && isset($_POST['password'])) 
    // Use mysqli_real_escape_string to prevent SQL injection
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // No need to escape for hashing

    $query = "SELECT * FROM user WHERE username = '$username'";
    $login = mysqli_query($koneksi, $query);

    if ($login) {
        $row = mysqli_fetch_assoc($login);

        // Use password_verify to check the password
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("location: index.php");
            exit();
        }
    }


header('location: gagal.php');

mysqli_close($koneksi); // Close the database connection after use
?>