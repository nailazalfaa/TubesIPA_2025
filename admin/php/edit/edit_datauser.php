<?php
include '../../koneksi.php';

// cek id
if (!isset($_GET['id'])) {
    header("Location: ../../data_user.php");
    exit;
}

$id = $_GET['id'];

// ambil data user
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: ../../data_user.php");
    exit;
}

// proses update
if (isset($_POST['update'])) {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $role     = $_POST['role'];

    mysqli_query($koneksi, "
        UPDATE users SET
            fullname='$fullname',
            username='$username',
            email='$email',
            role='$role'
        WHERE id_user='$id'
    ");

    header("Location: ../../data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Data User</title>
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

.form-control, .form-select {
    border-radius: 14px;
    padding: 10px 14px;
}

.form-control:focus, .form-select:focus {
    border-color: var(--rose);
    box-shadow: 0 0 0 .2rem rgba(216,100,135,.25);
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
</style>
</head>

<body class="d-flex align-items-center justify-content-center">

<div class="card p-4" style="width:520px" data-aos="zoom-in">
    <h3 class="text-center mb-4">✏️ Edit Data User</h3>

    <form method="POST" action="?id=<?= $id ?>">

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control"
                   value="<?= htmlspecialchars($data['fullname']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                   value="<?= htmlspecialchars($data['username']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($data['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="admin" <?= $data['role']=='admin'?'selected':''; ?>>Admin</option>
                <option value="user" <?= $data['role']=='user'?'selected':''; ?>>User</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-submit w-100">
            💾 Simpan Perubahan
        </button>
    </form>

    <hr>

    <div class="text-center">
        <a href="../../data_user.php" style="color:var(--merah); font-weight:600;">
            ← Kembali ke Data User
        </a>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>

</body>
</html>
