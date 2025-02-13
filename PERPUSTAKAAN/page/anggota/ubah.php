<?php

    $id = $_GET['id'];

    $sql = $koneksi->query("select * from tb_anggota where id='$id'");

    $tampil = $sql -> fetch_assoc();

    $jenis_kelamin = $tampil['jenis_kelamin']

?>

<div class="panel panel-default">
<div class="panel-heading">Ubah Data</div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Nim</label>
                                            <input class="form-control" name="nim" maxlength="8" readonly value="<?php echo $tampil['nim'];?> "/>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" name="nama" maxlength="50" value="<?php echo $tampil['nama'];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin">
                                                <option value="Laki-laki" <?php if ($jenis_kelamin=='Laki-laki') {echo "selected";} ?>>Laki-laki </option>
                                                <option value="Perempuan" <?php if ($jenis_kelamin=='Perempuan') {echo "selected";} ?>>Perempuan </option>
                                                
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input class="form-control" name="tempat_lahir" maxlength="100" value="<?php echo $tampil['tempat_lahir'];?>"/>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required value="<?php echo $tampil['tgl_lahir'];?>" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Prodi</label>
                                            <input class="form-control" name="prodi" maxlength="255" value="<?php echo $tampil['prodi'];?>"/>
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
$nim = isset($_POST['nim']) ? $_POST['nim'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$tempat_lahir = isset($_POST['tempat_lahir']) ? $_POST['tempat_lahir'] : '';
$tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
$prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';



// Tombol simpan diklik
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';
                                     

    if($simpan){

        $sql = $koneksi->query("UPDATE tb_anggota SET nim='$nim', nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', prodi='$prodi' WHERE id='$id'");
     
        if ($tgl_lahir === '0000-00-00') {
            echo "<script>alert('Tanggal Lahir tidak valid!');</script>";
            exit;
        }


        if ($sql){
            ?>
                <script type="text/javascript">
                    
                    alert("Update Data Berhasil Disimpan");
                    window.location.href="?page=anggota";
                
        
                </script>
            <?php
    }
}                                         

?>                                   
