<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard">
    <title>Admin Dashboard</title>
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Nunito', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    }

    /* Navbar */
    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Main Content */
    .dashboard-content {
        padding: 2rem;
    }

    /* Card Styles */
    .card {
        margin-bottom: 2rem;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: #fff;
    }

    /* Footer */
    footer {
        background: #2c3e50;
        color: #bdc3c7;
        text-align: center;
        padding: 1rem;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    /* Table Styles */
    table {
        width: 100%;
        background: #fff;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                Admin Dashboard
            </a>
            <div class="ms-auto">
                <a href="index.html" class="btn btn-outline-primary">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="dashboard-content">
        <div class="container-fluid">
            <h1 class="mb-4 text-center">Welcome, Admin</h1>
            <p class="text-center">Manage your check-in and check-out records with an overview of all items.</p>

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

            // 1. Tabel Sampel Barang
            echo "<div class='card'>
                    <div class='card-header'>
                        <h2 class='mb-0'>Sampel Barang</h2>
                    </div>
                    <div class='card-body'>
                        <div class='table-responsive'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>";

            $sql_sampel_barang = "SELECT id, kodebarang, namabarang FROM sampelbarang";
            $result_sampel_barang = $conn->query($sql_sampel_barang);

            if ($result_sampel_barang->num_rows > 0) {
                while ($row = $result_sampel_barang->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['kodebarang']}</td>
                            <td>{$row['namabarang']}</td>
                            <td>
                                <!-- Delete Button with Form -->
                                <form action='hapus-barang.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            echo "          </tbody>
                            </table>
                        </div>
                        <!-- Button to trigger modal -->
                        <button class='btn btn-primary mt-3' data-bs-toggle='modal' data-bs-target='#addBarangModal'>Tambah Barang</button>
                    </div>
                </div>";

            // 2. Barang Checkout
            echo "<div class='card'>
                    <div class='card-header'>
                        <h2 class='mb-0'>Barang Checkout</h2>
                    </div>
                    <div class='card-body'>
                        <div class='table-responsive'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Checkout By</th>
                                        <th>Checkout Time</th>
                                    </tr>
                                </thead>
                                <tbody>";

            $sql_checkout = "SELECT sb.Kodebarang, sb.namabarang, co.name AS CheckoutBy, co.checkout_time AS CheckoutTime 
                             FROM sampelbarang sb
                             JOIN checkout co ON sb.Kodebarang = co.barcode
                             ORDER BY co.checkout_time DESC";
            $result_checkout = $conn->query($sql_checkout);

            if ($result_checkout->num_rows > 0) {
                while ($row = $result_checkout->fetch_assoc()) {
                    echo "<tr><td>{$row['Kodebarang']}</td><td>{$row['namabarang']}</td><td>{$row['CheckoutBy']}</td><td>{$row['CheckoutTime']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            echo "          </tbody>
                        </table>
                    </div>
                </div>";

            // 3. Barang Checkin
            echo "<div class='card'>
                    <div class='card-header'>
                        <h2 class='mb-0'>Barang Checkin</h2>
                    </div>
                    <div class='card-body'>
                        <div class='table-responsive'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Checkin By</th>
                                        <th>Checkin Time</th>
                                    </tr>
                                </thead>
                                <tbody>";

            $sql_checkin = "SELECT sb.Kodebarang, sb.namabarang, ci.name AS CheckinBy, ci.checkin_time AS CheckinTime 
                            FROM sampelbarang sb
                            JOIN checkin ci ON sb.Kodebarang = ci.barcode
                            ORDER BY ci.checkin_time DESC";
            $result_checkin = $conn->query($sql_checkin);

            if ($result_checkin->num_rows > 0) {
                while ($row = $result_checkin->fetch_assoc()) {
                    echo "<tr><td>{$row['Kodebarang']}</td><td>{$row['namabarang']}</td><td>{$row['CheckinBy']}</td><td>{$row['CheckinTime']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            echo "          </tbody>
                        </table>
                    </div>
                </div>";

            // 4. Barang Belum Diambil
            echo "<div class='card'>
                    <div class='card-header'>
                        <h2 class='mb-0'>Barang Belum Diambil</h2>
                    </div>
                    <div class='card-body'>
                        <div class='table-responsive'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody>";

            $sql_belum_ambil = "SELECT sb.Kodebarang, sb.namabarang
                                FROM sampelbarang sb
                                LEFT JOIN checkin ci ON sb.Kodebarang = ci.barcode
                                LEFT JOIN checkout co ON sb.Kodebarang = co.barcode
                                WHERE ci.barcode IS NULL AND co.barcode IS NULL";
            $result_belum_ambil = $conn->query($sql_belum_ambil);

            if ($result_belum_ambil->num_rows > 0) {
                while ($row = $result_belum_ambil->fetch_assoc()) {
                    echo "<tr><td>{$row['Kodebarang']}</td><td>{$row['namabarang']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data found</td></tr>";
            }

            echo "          </tbody>
                        </table>
                    </div>
                </div>";

            // 5. Laporan Barang Checkout dan Checkin
            echo "<div class='card'>
            <div class='card-header'>
                <h2 class='mb-0'>Laporan Barang Checkout dan Checkin</h2>
                <!-- Print Button -->
                <button class='btn btn-secondary mt-2' onclick='printLaporan()'>Print</button>
            </div>
            <div class='card-body' id='printArea'>
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Checkin By</th>
                                <th>Checkin Time</th>
                                <th>Checkout By</th>
                                <th>Checkout Time</th>
                            </tr>
                        </thead>
                        <tbody>";

    $sql_laporan = "SELECT sb.Kodebarang, sb.namabarang, ci.name AS CheckinBy, ci.checkin_time AS CheckinTime, co.name AS CheckoutBy, co.checkout_time AS CheckoutTime
                    FROM sampelbarang sb
                    LEFT JOIN checkin ci ON sb.Kodebarang = ci.barcode
                    LEFT JOIN checkout co ON sb.Kodebarang = co.barcode
                    WHERE ci.checkin_time IS NOT NULL AND co.checkout_time IS NOT NULL
                    ORDER BY co.checkout_time DESC";
    $result_laporan = $conn->query($sql_laporan);

    if ($result_laporan->num_rows > 0) {
        while ($row = $result_laporan->fetch_assoc()) {
            echo "<tr><td>{$row['Kodebarang']}</td><td>{$row['namabarang']}</td><td>{$row['CheckinBy']}</td><td>{$row['CheckinTime']}</td><td>{$row['CheckoutBy']}</td><td>{$row['CheckoutTime']}</td></tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }

    echo "          </tbody>
                </table>
            </div>
        </div>
    </div>";

    // Close connection
    $conn->close();
    ?>
        </div>
    </section>


    <!-- Modal for adding new barang -->
    <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="tambah-barang.php" method="post">
                        <div class="mb-3">
                            <label for="Kodebarang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="Kodebarang" name="Kodebarang"
                                placeholder="Enter kode barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="namabarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="namabarang" name="namabarang"
                                placeholder="Enter nama barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; Your Website 2023</p>
    </footer>

    <!-- Bootstrap core JS (required for modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Print Function -->
    <script>
    function printLaporan() {
        var printContents = document.getElementById('printArea').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>
</body>

</html>

</body>

</html>