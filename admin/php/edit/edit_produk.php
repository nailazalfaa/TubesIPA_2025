<?php
include '../../koneksi.php';

// cek id
if (!isset($_GET['id'])) {
    header("Location: ../../produk.php");
    exit;
}

$id = $_GET['id'];

// ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: ../../produk.php");
    exit;
}

// proses update
if (isset($_POST['update'])) {

    $nama_produk = $_POST['nama_produk'];
    $deskripsi   = $_POST['deskripsi'];
    $tutorial    = $_POST['tutorial'];
    $is_popular  = isset($_POST['is_popular']) ? 1 : 0;

    // jika ganti gambar
    if (!empty($_FILES['img']['name'])) {
        $img  = $_FILES['img']['name'];
        $tmp  = $_FILES['img']['tmp_name'];
        $path = "upload/";

        move_uploaded_file($tmp, $path . $img);

        mysqli_query($koneksi, "
            UPDATE produk SET
            nama_produk='$nama_produk',
            img='$img',
            deskripsi='$deskripsi',
            tutorial='$tutorial',
            is_popular='$is_popular'
            WHERE id_produk='$id'
        ");
    } else {
        // tanpa ganti gambar
        mysqli_query($koneksi, "
            UPDATE produk SET
            nama_produk='$nama_produk',
            deskripsi='$deskripsi',
            tutorial='$tutorial',
            is_popular='$is_popular'
            WHERE id_produk='$id'
        ");
    }

    header("Location: ../../produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Produk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
:root {
    --merah: #9e182b;
    --coklat: #4a202a;
    --pink: #f9cbd6;
    --rose: #d86487;
}

body {
    background: linear-gradient(135deg, var(--pink), #fff);
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border-radius: 20px;
    border: none;
    box-shadow: 0 18px 40px rgba(0,0,0,.15);
    transition: .3s;
}

.card:hover {
    transform: translateY(-5px);
}

h3 {
    color: var(--merah);
    font-weight: 700;
}

label {
    font-weight: 600;
    color: var(--coklat);
}

.form-control {
    border-radius: 14px;
    padding: 10px 14px;
}

.form-control:focus {
    border-color: var(--rose);
    box-shadow: 0 0 0 .2rem rgba(216,100,135,.25);
}

.form-check-input:checked {
    background-color: var(--merah);
    border-color: var(--merah);
}

.btn-submit {
    background: linear-gradient(135deg, var(--merah), var(--rose));
    color: #fff;
    border: none;
    border-radius: 16px;
    padding: 12px;
    font-weight: 600;
    transition: .3s;
}

.btn-submit:hover {
    transform: scale(1.03);
    background: linear-gradient(135deg, var(--rose), var(--merah));
}

hr {
    border-top: 1px dashed var(--rose);
}

.preview-img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 10px;
}
</style>
</head>

<body class="d-flex align-items-center justify-content-center">

<div class="card p-4" style="width:520px" data-aos="zoom-in">
    <h3 class="text-center mb-4">Edit Menu</h3>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control"
                   value="<?= htmlspecialchars($data['nama_produk']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Gambar Saat Ini</label>
            <img src="upload/<?= htmlspecialchars($data['img']); ?>" class="preview-img">
            <input type="file" name="img" class="form-control mt-2">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Tutorial</label>
            <textarea name="tutorial" class="form-control" rows="4"><?= htmlspecialchars($data['tutorial']); ?></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_popular" class="form-check-input"
                   <?= $data['is_popular'] == 1 ? 'checked' : ''; ?>>
            <label class="form-check-label">Menu Populer</label>
        </div>

        <button type="submit" name="update" class="btn btn-submit w-100">
            Simpan Perubahan
        </button>
    </form>

    <hr>

    <div class="text-center">
        <a href="../../produk.php" style="color:var(--merah); font-weight:600;">
            ← Kembali ke Data Menu
        </a>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
