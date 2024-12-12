<?php
include 'db.php';

if (isset($_GET['id'])) {
    $siswa_id = $_GET['id'];

    // Ambil data siswa berdasarkan ID
    $sql = "SELECT * FROM siswa WHERE id = $siswa_id";
    $result = $conn->query($sql);
    $siswa = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Simpan data absensi
        $status = $_POST['status'];
        $tanggal = date('Y-m-d');

        $insert = "INSERT INTO absensi (siswa_id, tanggal, status) VALUES ($siswa_id, '$tanggal', '$status')";
        if ($conn->query($insert) === TRUE) {
            echo "<script>alert('Absensi berhasil disimpan'); window.location = 'index.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Absensi untuk: <?php echo $siswa['nama']; ?></h1>
        <form method="POST">
            <label for="status">Status Absensi:</label>
            <select name="status" required>
                <option value="Hadir">Hadir</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
            </select>
            <br><br>
            <button type="submit">Simpan Absensi</button>
        </form>
        <br>
        <a href="index.php">Kembali ke Daftar Siswa</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>