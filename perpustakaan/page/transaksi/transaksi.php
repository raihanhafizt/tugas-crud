<?php
// Pastikan hanya satu pemanggilan session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login dan memiliki level 'anggota'
if (!isset($_SESSION['user']) || $_SESSION['level'] != 'anggota') {
    // Jika tidak login atau bukan anggota, redirect ke halaman login
    echo "<script>alert('Anda harus login sebagai anggota!'); window.location.href = 'login-anggota.php';</script>";
    exit; // Hentikan eksekusi jika kondisi tidak terpenuhi
}

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "perpustakaann"); // Pastikan database yang sesuai

// Cek koneksi database
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>

<a href="?page=transaksi&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px;">Tambah Data</a>

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Transaksi Anggota
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil data transaksi yang sedang dipinjam
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM tb_transaksi WHERE status='Dipinjam'");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['judul']; ?></td>
                                    <td><?php echo $data['nim']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['tgl_pinjam']; ?></td>
                                    <td><?php echo $data['tgl_kembali']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td>
                                        <!-- Tampilkan tombol 'Kembalikan' hanya jika status masih 'Dipinjam' -->
                                        <a href="?page=transaksi&aksi=kembali&id=<?php echo $data['id']; ?>&judul=<?php echo $data['judul']; ?>" class="btn btn-info"><i class="fa fa-edit"></i>Kembalikan</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>
