<?php
session_start();
if ($_SESSION['user']['role'] == 'anggota') {
    echo "<script>alert('Halaman ini tidak bisa diakses oleh anggota!'); window.location.href='index.php?page=transaksi';</script>";
    exit;
}
?>

<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Histori Pinjam dan Kembali Buku
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Nim</th>
                                <th>Nama </th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                
                                $sql = $koneksi->query("SELECT * FROM tb_transaksi WHERE status='Dipinjam' OR status='Kembali'");
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
                                        
                                    </tr>
                                <?php
                                 }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>
