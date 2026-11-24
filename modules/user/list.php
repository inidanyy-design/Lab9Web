<?php
require_once __DIR__ . '/../../config/database.php';

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<section>
    <h2>Data Barang</h2>
    <p><a href="index.php?page=user/add">Tambah Barang</a></p>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="<?= e($row['gambar']); ?>" alt="<?= e($row['nama']); ?>" width="50">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= e($row['nama']); ?></td>
                        <td><?= e($row['kategori']); ?></td>
                        <td><?= e(formatRupiah((float) $row['harga_jual'])); ?></td>
                        <td><?= e(formatRupiah((float) $row['harga_beli'])); ?></td>
                        <td><?= e((string) $row['stok']); ?></td>
                        <td>
                            <a href="index.php?page=user/edit&id=<?= urlencode((string) $row['id_barang']); ?>">Ubah</a> |
                            <a href="index.php?page=user/delete&id=<?= urlencode((string) $row['id_barang']); ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Belum ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>