<?php
include '../../koneksi.php';

$id = $_GET['id'];

// ambil data gambar
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT img FROM produk WHERE id_produk='$id'")
);

// hapus file gambar
if ($data && file_exists("../../../upload/" . $data['img'])) {
    unlink("../../../upload/" . $data['img']);
}

// hapus data produk
mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");

// kembali ke halaman produk
header("Location: ../../produk.php");
exit;
?>
