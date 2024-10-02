<?php
// Database connection parameters
$servername = "127.0.0.1"; // or "localhost"
$username = "root"; // Default username for Laragon
$password = ""; // Default password for Laragon
$dbname = "checkin_checkout_db"; // Ganti dengan nama database yang benar

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$name = $_POST['name'];
$Kode_Barang = $_POST['barcode'];

// SQL to insert data into the 'checkin' table
$sql = "INSERT INTO checkin (name, barcode) VALUES ('$name', '$Kode_Barang')";

if ($conn->query($sql) === TRUE) {
    // Show alert and redirect to index.html
    echo "<script>
            alert('Check-In Successful!');
            window.location.href = 'index.html';
          </script>";
} else {
    // Show error alert
    echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'index.html';
          </script>";
}

// Close the connection
$conn->close();
