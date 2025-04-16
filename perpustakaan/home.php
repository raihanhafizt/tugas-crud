<?php

if(!isset($_SESSION['user'])){
    header('location: login-admin.php');
}

 $koneksi = new mysqli(hostname: "localhost",username: "root",password: "",database: "perpustakaann");

// Menghitung jumlah buku yang tersedia
$sql_buku = "SELECT SUM(jumlah_buku) AS total_buku FROM perpustakaan";
$result_buku = $koneksi->query($sql_buku);
$row_buku = $result_buku->fetch_assoc();
$total_buku = $row_buku['total_buku'];

// Menghitung jumlah buku yang dipinjam
$sql_buku_dipinjam = "SELECT COUNT(*) AS jumlah_buku_dipinjam FROM tb_transaksi WHERE status = 'Dipinjam'";
$result_buku_dipinjam = $koneksi->query($sql_buku_dipinjam);
$row_buku_dipinjam = $result_buku_dipinjam->fetch_assoc();
$total_buku_dipinjam = $row_buku_dipinjam['jumlah_buku_dipinjam'];

// Menghitung jumlah amnggota yang tersedia
$sql_anggota = "SELECT COUNT(*) AS jumlah_anggota FROM tb_anggota";
$result_anggota = $koneksi->query($sql_anggota);
$row_anggota = $result_anggota->fetch_assoc();
$total_anggota = $row_anggota['jumlah_anggota'];

?>

<marquee style="font-size: 40px; font-family:'Times New Roman', Times, serif"><b>Selamat datang Di Perpustakaan berbasis WEB</b></marquee>
           <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 style="font-size: 40px; font-family:'Times New Roman', Times, serif">DASBOARD</h2>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 <hr />
<div class="row">
    <!-- Panel 1 - Data Buku -->
    <div class="col-md-3 col-sm-6 col-xs-12">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-red set-icon">
                <i class="fa fa-book"></i>
            </span>
            <div class="text-box">
                <p class="main-text">Dataa Bukuu</p>
                <p class="text-muted">Jumlah Buku: <?php echo $total_buku; ?></p>
            </div>
        </div>
    </div>

    <!-- Panel 2 - Jumlah Anggota -->
    <div class="col-md-3 col-sm-6 col-xs-12">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-users"></i>
            </span>
            <div class="text-box">
                <p class="main-text">Jumlah Anggota</p>
                <p class="text-muted"><?php echo $total_anggota; ?> Anggota</p>
            </div>
        </div>
    </div>

    <!-- Panel 3 - Buku Dipinjam -->
    <div class="col-md-3 col-sm-6 col-xs-12">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-exchange"></i>
            </span>
            <div class="text-box">
                <p class="main-text">Buku Dipinjam</p>
                <p class="text-muted"><?php echo $total_buku_dipinjam; ?> Buku Dipinjam</p>
            </div>
        </div>
    </div>
</div>

</div>