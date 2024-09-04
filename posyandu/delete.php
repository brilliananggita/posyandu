<?php
$id = $_GET['id'];
include 'koneksi.php';

// Sanitasi input untuk mencegah SQL Injection
$id = mysqli_real_escape_string($koneksi, $id);

// Fetch the data that will be deleted
$query = mysqli_query($koneksi, "SELECT * FROM tb_jadwal WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    // Insert the data into the 'riwayat' table
    $pelayanan = $data['pelayanan'];
    $tempat = $data['tempat'];
    $tgl = $data['tgl'];
    $waktu = $data['waktu'];
    $deleted_at = date('Y-m-d H:i:s'); // current timestamp

    // Insert data into tb_riwayat
    $insert = mysqli_query($koneksi, "INSERT INTO tb_riwayat (id, pelayanan, tempat, tgl, waktu, deleted_at) VALUES ('$id', '$pelayanan', '$tempat', '$tgl', '$waktu', '$deleted_at')");

    if ($insert) {
        // After inserting into 'riwayat', delete from 'tb_jadwal'
        $delete = mysqli_query($koneksi, "UPDATE tb_jadwal  SET status = 'selesai' WHERE id = '$id'");

        if ($delete) {
            header("location: jadwal.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error inserting into riwayat: " . mysqli_error($koneksi);
    }
} else {
    echo "No record found with ID: " . $id;
}
?>

