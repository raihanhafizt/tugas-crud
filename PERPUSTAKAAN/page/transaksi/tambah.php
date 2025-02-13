<?php

$tgl_pinjam = date("d-m-y");
$tujuh_hari = mktime(0,0,0, date("n"), date("j")+7, date("Y"));
$tgl_kembali = date("d-m-y",$tujuh_hari);

?>

<div class="panel panel-default">
    <div class="panel-heading">Tambah Data</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">

                    <div class="form-group">
                        <label>Nama Buku</label>
                        <select class="form-control" name="buku">
                           <?php
                            $sql = $koneksi->query("SELECT * from perpustakaan order by id");
                             
                            while ($data=$sql->fetch_assoc()){
                                echo "<option value='$data[id].$data[judul]'>$data[judul]</option>";
                            }

                           ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <select class="form-control" name="nama">
                            <?php
                            $sql = $koneksi->query("SELECT * from tb_anggota order by nim");
                             
                            while ($data=$sql->fetch_assoc()){
                                echo "<option value='$data[nim].$data[nama]'>$data[nim].$data[nama]</option>";
                            }
                            
                           ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_input">Tanggal Pinjam</label>
                        <input type="text" class="form-control" name="tgl_pinjam" id="tgl_pinjam" value="<?php echo $tgl_pinjam?>" readonly />
                    </div>

                    <div class="form-group">
                        <label for="tgl_input">Tanggal Kembali</label>
                        <input type="text" class="form-control" name="tgl_kembali" id="tgl_kembali" value="<?php echo $tgl_kembali?>" readonly />
                    </div>


                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>  
        </div>  
    </div> 
</div>

<?php

    if(isset($_POST['simpan'])) {
        
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];

        $buku = $_POST['buku'];
        $pecah_buku = explode(".", $buku);
        $id = $pecah_buku[0];
        $judul = $pecah_buku[1];

        $nama = $_POST['nama'];
        $pecah_nama = explode(".", $nama);
        $nim = $pecah_nama[0];
        $nama = $pecah_nama[1];

        $sql = $koneksi->query("SELECT * from perpustakaan where judul = '$judul'");
        while ($data = $sql->fetch_assoc()){
            $sisa = $data['jumlah_buku'];

            if ($sisa == 0){
                ?>
                    <script type="text/javascript">
                        alert("Stok buku habis silahkan tambah stok buku terlebih dahulu");
                        window.location.href="?page=transaksi&aksi=tambah";
                    </script>
                <?php
            }else{
                $sql = $koneksi->query("INSERT INTO tb_transaksi(judul, nim, nama, tgl_pinjam, tgl_kembali, status)values('$judul', '$nim', '$nama', '$tgl_pinjam', '$tgl_kembali', 'Dipinjam')");

                $sql2 =$koneksi->query("UPDATE perpustakaan set jumlah_buku=(jumlah_buku-1) where id='$id' ");

                ?>
                    <script type="text/javascript">
                        alert("Simpan data berhasil");
                        window.location.href="?page=transaksi";
                    </script>
                <?php
            }
        } 
    }

?>
