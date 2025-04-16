<?php
$id = $_GET['id'];
$judul = $_GET['judul'];

$sql = $koneksi->query("UPDATE tb_transaksi SET status='kembali' WHERE id='$id'");

$sql = $koneksi->query("UPDATE perpustakaan SET jumlah_buku = (jumlah_buku + 1) WHERE judul='$judul'");

if ($sql) {
    ?>
    <script type="text/javascript">
        alert("Proses pengembalian buku berhasil");
        window.location.href="?page=transaksi";
    </script>
    <?php
} else {
    
    echo "Terjadi kesalahan, proses pengembalian gagal.";
}
?>
