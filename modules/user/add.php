<?php
require_once __DIR__ . '/../../config/database.php';

$pesanError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $kategori = mysqli_real_escape_string($conn, trim($_POST['kategori'] ?? ''));
    $harga_jual = mysqli_real_escape_string($conn, trim($_POST['harga_jual'] ?? '0'));
    $harga_beli = mysqli_real_escape_string($conn, trim($_POST['harga_beli'] ?? '0'));
    $stok = mysqli_real_escape_string($conn, trim($_POST['stok'] ?? '0'));
    $gambar = '';

    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] === 0) {
        $filename = str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
        $targetDir = __DIR__ . '/../../gambar/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $destination = $targetDir . $filename;
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $gambarEsc = mysqli_real_escape_string($conn, $gambar);
    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar)
            VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambarEsc}')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='index.php?page=user/list';</script>";
        return;
    } else {
        $pesanError = 'Gagal menyimpan data: ' . mysqli_error($conn);
    }
}
?>
<section>
    <h2>Tambah Barang</h2>
    <?php if ($pesanError !== ''): ?>
        <p style="color: red;"><?= e($pesanError); ?></p>
    <?php endif; ?>
    <form method="post" action="index.php?page=user/add" enctype="multipart/form-data">
        <p>
            <label>Nama Barang</label><br>
            <input type="text" name="nama" required>
        </p>
        <p>
            <label>Kategori</label><br>
            <select name="kategori">
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </p>
        <p>
            <label>Harga Jual</label><br>
            <input type="text" name="harga_jual" required>
        </p>
        <p>
            <label>Harga Beli</label><br>
            <input type="text" name="harga_beli" required>
        </p>
        <p>
            <label>Stok</label><br>
            <input type="text" name="stok" required>
        </p>
        <p>
            <label>File Gambar</label><br>
            <input type="file" name="file_gambar">
        </p>
        <p>
            <button type="submit" name="submit" value="1">Simpan</button>
            <a href="index.php?page=user/list">Batal</a>
        </p>
    </form>
</section>