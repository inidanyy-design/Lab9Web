<?php
require_once __DIR__ . '/../../config/database.php';

$pesanError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = (int) ($_POST['id'] ?? 0);
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $kategori = mysqli_real_escape_string($conn, trim($_POST['kategori'] ?? ''));
    $harga_jual = mysqli_real_escape_string($conn, trim($_POST['harga_jual'] ?? '0'));
    $harga_beli = mysqli_real_escape_string($conn, trim($_POST['harga_beli'] ?? '0'));
    $stok = mysqli_real_escape_string($conn, trim($_POST['stok'] ?? '0'));
    $gambarSql = '';

    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] === 0) {
        $filename = str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
        $targetDir = __DIR__ . '/../../gambar/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $destination = $targetDir . $filename;
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
            $gambarEsc = mysqli_real_escape_string($conn, 'gambar/' . $filename);
            $gambarSql = ", gambar = '{$gambarEsc}'";
        }
    }

    $sql = "UPDATE data_barang SET
            nama = '{$nama}',
            kategori = '{$kategori}',
            harga_jual = '{$harga_jual}',
            harga_beli = '{$harga_beli}',
            stok = '{$stok}'
            {$gambarSql}
            WHERE id_barang = {$id}";

    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='index.php?page=user/list';</script>";
        return;
    } else {
        $pesanError = 'Gagal mengubah data: ' . mysqli_error($conn);
    }
}

$id = (int) ($_GET['id'] ?? 0);
$sql = "SELECT * FROM data_barang WHERE id_barang = {$id}";
$result = mysqli_query($conn, $sql);
$data = $result ? mysqli_fetch_assoc($result) : null;

if (!$data) {
    echo "<section><h2>Data Tidak Ditemukan</h2><p><a href='index.php?page=user/list'>Kembali ke Daftar</a></p></section>";
    return;
}

function is_select($var, $val): string
{
    return ($var === $val) ? 'selected="selected"' : '';
}
?>
<section>
    <h2>Ubah Barang</h2>
    <?php if ($pesanError !== ''): ?>
        <p style="color: red;"><?= e($pesanError); ?></p>
    <?php endif; ?>
    <form method="post" action="index.php?page=user/edit&id=<?= (int) $data['id_barang']; ?>" enctype="multipart/form-data">
        <p>
            <label>Nama Barang</label><br>
            <input type="text" name="nama" value="<?= e($data['nama']); ?>" required>
        </p>
        <p>
            <label>Kategori</label><br>
            <select name="kategori">
                <option <?= is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
                <option <?= is_select('Elektronik', $data['kategori']); ?> value="Elektronik">Elektronik</option>
                <option <?= is_select('Hand Phone', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
            </select>
        </p>
        <p>
            <label>Harga Jual</label><br>
            <input type="text" name="harga_jual" value="<?= e((string) $data['harga_jual']); ?>" required>
        </p>
        <p>
            <label>Harga Beli</label><br>
            <input type="text" name="harga_beli" value="<?= e((string) $data['harga_beli']); ?>" required>
        </p>
        <p>
            <label>Stok</label><br>
            <input type="text" name="stok" value="<?= e((string) $data['stok']); ?>" required>
        </p>
        <p>
            <label>File Gambar</label><br>
            <input type="file" name="file_gambar">
        </p>
        <p>
            <input type="hidden" name="id" value="<?= (int) $data['id_barang']; ?>">
            <button type="submit" name="submit" value="1">Simpan</button>
            <a href="index.php?page=user/list">Batal</a>
        </p>
    </form>
</section>