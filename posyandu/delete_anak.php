<?php
$id = $_GET['id'];
include 'koneksi.php';

// Make sure to sanitize user input to prevent SQL injection

$delete = mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE id = '$id'");

if ($delete) {
    header("location: anggota.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($koneksi);
}

?>
