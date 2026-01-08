<?php
include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id'");

header("Location: ../../data_user.php");
exit;
?>
