<?php
session_start();
if ($_SESSION['user']['role'] == 'anggota') {
    echo "<script>alert('Halaman ini tidak bisa diakses oleh anggota!'); window.location.href='index.php?page=transaksi';</script>";
    exit;
}
?>

<a href="?page=buku&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px;">Tambah Data</a>

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Buku
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Jumlah Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM perpustakaan");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['kode']; ?></td>
                                    <td><?php echo $data['judul']; ?></td>
                                    <td><?php echo $data['pengarang']; ?></td>
                                    <td><?php echo $data['penerbit']; ?></td>
                                    <td><?php echo $data['jumlah_buku']; ?></td>
                                    <td>
                                        <a href="?page=buku&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fa fa-edit "></i>Ubah</a>
                                        <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="?page=buku&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger"><i class="fa fa-pencil"></i>Hapus</a>
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
