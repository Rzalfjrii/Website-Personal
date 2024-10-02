<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "checkin_checkout_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from POST request
$id = $_POST['id'];

// SQL query to delete the record
$sql = "DELETE FROM sampelbarang WHERE id = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>
            alert('Barang berhasil dihapus!');
            window.location.href = 'dashboard.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus barang!');
            window.location.href = 'dashboard.php';
          </script>";
}

// Close connection
$stmt->close();
$conn->close();
