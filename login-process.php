<?php
// Set credentials for admin
$adminUsername = 'admin';
$adminPassword = 'admin'; // Ideally, use a hashed password for security in a real application

// Get username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Check credentials
if ($username === $adminUsername && $password === $adminPassword) {
    // Redirect to the admin dashboard if credentials are correct
    echo "<script>
            alert('Login Successful!');
            window.location.href = 'dashboard.php'; // Replace with the actual dashboard page
          </script>";
} else {
    // If credentials are incorrect, redirect back to login page
    echo "<script>
            alert('Invalid username or password!');
            window.location.href = 'login.html';
          </script>";
}