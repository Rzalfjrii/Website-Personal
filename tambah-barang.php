<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "checkin_checkout_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and log
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error, 0);
    die("Connection failed: " . $conn->connect_error);
} else {
    error_log("Database connection successful!", 0);
}

// Get data from the form
$Kodebarang = $_POST['Kodebarang'];
$namabarang = $_POST['namabarang'];

// Log the data received
error_log("Received data - Kodebarang: $Kodebarang, Nama Barang: $namabarang", 0);

// Prepare and bind the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO sampelbarang (Kodebarang, namabarang) VALUES (?, ?)");
$stmt->bind_param("ss", $Kodebarang, $namabarang);

// Execute the statement and log the result
if ($stmt->execute() === TRUE) {
    error_log("Data successfully inserted into sampelbarang table.", 0);
    echo "<script>
            alert('Barang berhasil ditambahkan!');
            window.location.href = 'dashboard.php';
          </script>";
} else {
    error_log("Error inserting data: " . $stmt->error, 0);
    echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = 'dashboard.php';
          </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
