<?php
session_start();
include 'koneksi.php';
$u = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$p = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
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
            background: #d86487 ;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-section" style="margin-top: -10px; padding-top: 10px;">
            <img src="img/logo ipa.jpeg" alt="Logo" style="width: 80px; height: 80px; border-radius: 50%; display: block; margin: 0 auto 10px; box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);">
            <div>Admin</div>
        </div>
        <a href="dashboard.php" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="data_user.php"><i class="fas fa-users"></i> Data User</a>
        <a href="produk.php"><i class="fas fa-utensils"></i> Data Menu</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="main-content" >
        <div style="text-align: center; padding: 20px; border-radius: 10px; margin-bottom: 30px; margin-right: 20px; width: fit-content; margin-left: auto; margin-right: auto;">
            <h1 style="margin: 0; color: #4a202a; font-size: 48px; text-shadow: 4px 2px 6px rgba(255, 255, 255, 0.6);">📊 DASHBOARD</h1>
        <style>
            h1 {
                text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.66);
            }
        </style>
        </div>
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <h2>Total User</h2>
                <p><?= $u; ?></p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🍽️</div>
                <h2>Total Menu</h2>
                <p><?= $p; ?></p>
            </div>
        </div>
    </div>
</body>
</html>