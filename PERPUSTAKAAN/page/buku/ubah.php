<?php

    $id = $_GET['id'];

    $sql = $koneksi->query("select * from perpustakaan where id='$id'");

    $tampil = $sql -> fetch_assoc();

    $tahun2 = $tampil['tahun_terbit'];

    $lokasi = $tampil['lokasi']

?>

<div class="panel panel-default">
<div class="panel-heading">Ubah Data</div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input class="form-control" maxlength="5" name="kode" value="<?php echo $tampil['kode'];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input class="form-control" maxlength="255" name="judul" value="<?php echo $tampil['judul'];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <input class="form-control" maxlength="255" name="pengarang" value="<?php echo $tampil['pengarang'];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input class="form-control" maxlength="255" name="penerbit" value="<?php echo $tampil['penerbit'];?>"/>
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
                                                if ($i==$tahun2) {
                                                

                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';  

                                                }else{
                                                    
                                                }
                                            }
                                            ?>
                                        </select>
                                </div>

                                        

                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input class="form-control" type="number" name="jumlah_buku" min="0" value="<?php echo $tampil['jumlah_buku'];?>"/ >
                                        </div>

                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control" name="lokasi">
                                                <option value="rak1" <?php if ($lokasi=='rak1') {echo "selected";} ?>>Rak 1 </option>
                                                <option value="rak2" <?php if ($lokasi=='rak2') {echo "selected";} ?>>Rak 2</option>
                                                <option value="rak3" <?php if ($lokasi=='rak3') {echo "selected";} ?>>Rak 3</option>
                                            </select>
                                        </div>


                                        <div>
                                        <button type="submit" name="simpan" value="Update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</button>
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


// Tombol simpan diklik
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';
                                     

    if($simpan){

        $sql = $koneksi->query("UPDATE perpustakaan SET kode='$kode', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', jumlah_buku='$jumlah_buku', lokasi='$lokasi' WHERE id='$id'");
                        


        if ($sql){
            ?>
                <script type="text/javascript">
                    
                    alert("Update Data Berhasil Disimpan");
                    window.location.href="?page=buku";
                
                </script>
            <?php
    }
}                                         

?>                                   
