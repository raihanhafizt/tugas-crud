<div class="panel panel-default">
<div class="panel-heading">Tambah Data</div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input class="form-control" maxlength="5" name="kode"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input class="form-control" maxlength="255" name="judul"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <input class="form-control" maxlength="255" name="pengarang"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input class="form-control" maxlength="255" name="penerbit"/>
                                        </div>

                                

                                <div class="form-group">
                                        <label for="tahun">Tahun Terbit</label>
                                        <select class="form-control" name="tahun_terbit" id="tahun_terbit">
                                            <?php
                                            // Mendapatkan tahun saat ini
                                            $tahun = date("Y");

                                            // Looping dari tahun saat ini - 29 tahun hingga tahun saat ini
                                            for ($i = $tahun - 29; $i <= $tahun; $i++) {
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>
                                        </select>
                                </div>


                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input class="form-control" type="number" min="0" name="jumlah_buku"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control" name="lokasi">
                                                <option value="rak1">Rak 1</option>
                                                <option value="rak2">Rak 2</option>
                                                <option value="rak3">Rak 3</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_input">Tanggal Input</label>
                                            <input type="date" class="form-control" name="tgl_input" id="tgl_input" />
                                        </div>


                                        <div>
                                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        </div>
                                    </div>
                                    </form>
                                </div>  
                            </div>  
</div> 
<?php
$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$judul = isset($_POST['judul']) ? $_POST['judul'] : '';
$pengarang = isset($_POST['pengarang']) ? $_POST['pengarang'] : '';
$penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
$tahun_terbit = isset($_POST['tahun_terbit']) ? $_POST['tahun_terbit'] : '';
$jumlah_buku = isset($_POST['jumlah_buku']) ? $_POST['jumlah_buku'] : '';
$lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
$tgl_input = isset($_POST['tgl_input']) ? $_POST['tgl_input'] : '';


// Tombol simpan diklik
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';

if ($simpan) {
    // Validasi input untuk memastikan tidak kosong
    if (empty($kode) || empty($judul) || empty($pengarang) || empty($penerbit) || empty($tahun_terbit) || empty($jumlah_buku) || empty($lokasi) || empty($tgl_input)) {
        echo "<script>alert('Semua data harus diisi!');</script>";
        exit;
    }
}                                     

    if($simpan){

        $sql = $koneksi->query("INSERT INTO perpustakaan (kode, judul, pengarang, penerbit, tahun_terbit,  jumlah_buku, lokasi, tgl_input)
                        VALUES ('$kode', '$judul', '$pengarang', '$penerbit', '$tahun_terbit',  '$jumlah_buku', '$lokasi', '$tgl_input')");


        if ($sql){
            ?>
                <script type="text/javascript">
                    
                    alert("Data Berhasil Disimpan");
                    window.location.href="?page=buku";
                
                </script>
            <?php
                }
    }                                         

?>                                   
