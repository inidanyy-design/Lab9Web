<?php
$hargaBarang = 250000;
$diskon = hitungDiskon($hargaBarang, 20);
$hargaAkhir = $hargaBarang - $diskon;
$contohEmail = 'mahasiswa@kampus.ac.id';
$teksPanjang = 'Modularisasi membuat kode PHP lebih terstruktur, mudah dirawat, dan dapat digunakan kembali di banyak halaman.';
?>
<section>
    <h2>Dashboard</h2>
    <p>Selamat datang di aplikasi PHP Modular.</p>
    <ul>
        <li>Harga Awal: <?= e(formatRupiah($hargaBarang)) ?></li>
        <li>Diskon 20%: <?= e(formatRupiah($diskon)) ?></li>
        <li>Harga Akhir: <?= e(formatRupiah($hargaAkhir)) ?></li>
        <li>Validasi Email (<?= e($contohEmail) ?>): <?= validasiEmail($contohEmail) ? 'Valid' : 'Tidak Valid' ?></li>
        <li>Ringkasan Teks: <?= e(ringkasTeks($teksPanjang, 55)) ?></li>
    </ul>
</section>