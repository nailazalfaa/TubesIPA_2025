<?php
session_start();
include 'koneksi.php';
$u = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$p = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>data_pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* --merah:#9e182b;
            --coklat:#4a202a;
            --:#f9cbd6;
            #d86487 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
          body {
                background-image: url('img/bgg.jpeg'); /* arahkan ke gambar */
                background-size: cover;      /* bikin full cover */
                background-position: center; /* posisi tengah */
                background-repeat: no-repeat;
                background-attachment: fixed; /* opsional (efek diam) */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); */
            min-height: 100vh;
}

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: #d86487;
            box-shadow: 2px 0 15px rgba(236, 72, 153, 0.2);
            padding: 20px 0;
            z-index: 1000;
        }
        .logo-section {
            font-size: 24px;
            font-weight: bold;
            color: #4a202a;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 2px solid rgba(190, 24, 93, 0.2);
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 15px 25px;
            color: #4a202a;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px 10px;
            border-radius: 10px;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.6);
            padding-left: 35px;
        }
        .sidebar a.active {
            background: #4a202a;
            color: white;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
        }
        .main-content {
            margin-left: 280px;
            padding: 40px;
        }
        h1 {
            color: #be185d;
            margin-bottom: 30px;
            font-size: 32px;
        }
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(236, 72, 153, 0.25);
        }
        .stat-card h2 {
            color: #be185d;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .stat-card p {
            font-size: 48px;
            font-weight: bold;
            background: linear-gradient(135deg, #fcc2d7 0%, #f8bbd0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 15px 0;
            }
            .sidebar a {
                padding: 15px 10px;
                text-align: center;
            }
            .logo-section {
                font-size: 18px;
                padding: 20px 10px;
            }
            .main-content {
                margin-left: 70px;
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header-table {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-tambah {
            background-color: #c71585;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        /* Tabel Pink */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            background-color: #ffe4e1; /* Header Pink Pastel */
            color: #c71585;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        /* Badge Status Populer */
        .badge-popular {
            background-color: #ffd700;
            color: #856404;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
        }

        /* Tombol Aksi */
        .btn-aksi {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
    </style>

</head>
<body>
    <div class="sidebar">
       <div class="logo-section" style="margin-top: -10px; padding-top: 10px;">
            <img src="img/logo ipa.jpeg" alt="Logo" style="width: 80px; height: 80px; border-radius: 50%; display: block; margin: 0 auto 10px; box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);">
            <div>Admin</div>
        </div>
        <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="data_user.php"><i class="fas fa-users"></i> Data User</a>
        <a href="produk.php" class="active"><i class="fas fa-utensils"></i> Data Menu</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>


    <div class="main-content">
            <div style="text-align: center; padding: 20px; border-radius: 10px; margin-bottom: 30px; margin-right: 20px; width: fit-content; margin-left: auto; margin-right: auto;">
            <h1 style="margin: 0; color: #4a202a; font-size: 40px; text-shadow: 4px 2px 6px rgba(255, 255, 255, 0.6);">🍽️ Daftar Menu</h1>
        <style>
            h1 {
                text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.66);
            }
        </style>
        </div>
        <div class="header-table">
            <div style="background: #4a202a; color: white; padding: 15px 20px; border-radius: 10px; display: inline-block; font-size: 14px;">
            <p style="margin: 0; font-weight: 600;">Total Menu: <strong><?= $p; ?></strong></p>
            </div>
            <a href="produk_tambah.php" class="btn-tambah" style="background-color: #4a202a;"><i class="fas fa-plus"></i> Tambah Menu</a>
        </div>

            <table style="border-radius: 10px; overflow: hidden;">
            <thead>
                <tr style="background-color: #4a202a;; color: white;">
                <th style="width: 5%;">ID</th>
                <th style="width: 30%;">Nama Produk</th>
                <th style="width: 20%;">Gambar</th>
                <th style="width: 20%;">Deskripsi</th>
                <th style="width: 25%;">Status</th>
                <th style="width: 25%;">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM produk");
                $no = 1;
                while($row = mysqli_fetch_assoc($query)) : 
                ?>
                <tr style="background: #fff4f8ff; transition: background 0.3s;">
                <td><span style="background: #d86487; color: white; padding: 4px 10px; border-radius: 20px; font-weight: bold;"><?= $no++; ?></span></td>
                <td><strong style="color: #4a202a; 0; font-size: 15px;"><?= htmlspecialchars($row['nama_produk']); ?></strong></td>
                <td><img src="<?= htmlspecialchars($row['img']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>" style="width: 50px; height: auto; border-radius: 5px;"></td>
                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                <td>
                    <?php if($row['is_popular'] == 1): ?>
                    <span class="badge-popular">⭐ POPULER</span>
                    <?php else: ?>
                    <span style="color: #999; font-size: 12px; background: #f0f0f0; padding: 4px 10px; border-radius: 15px;">📋 Reguler</span>
                    <?php endif; ?>
                </td>
                <td style="display: flex; gap: 5px;">
                    <a href="edit_menu.php?id=<?= $row['id_produk']; ?>" class="btn-aksi" style="background: #ff69b4; color: white; padding: 8px 12px; border-radius: 5px;"><i class="fas fa-edit"></i> Edit</a>
                    <a href="php/hapus/hapus_produk.php?id=<?= $row['id_produk']; ?>" class="btn-aksi" style="background: #d86487; color: white; padding: 8px 12px; border-radius: 5px;" onclick="return confirm('Yakin ingin menghapus menu ini?')"> <i class="fas fa-trash"></i> Hapus </a>
                </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
    </div>
</body>
</html>