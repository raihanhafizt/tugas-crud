<div class="panel panel-default">
    <div class="panel-heading">Tambah Data</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                    <div class="form-group">
                        <label>Nim</label>
                        <input type="number" class="form-control" name="nim" oninput="limitInputLength(this)"/>
                    </div>

                    <script>
                        function limitInputLength(input) {
                            // Batasi hanya 8 digit yang bisa dimasukkan
                            if (input.value.length > 8) {
                                input.value = input.value.slice(0, 8);
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" maxlength="50" name="nama" />
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input class="form-control" maxlength="100" name="tempat_lahir" />
                    </div>

                    <div class="form-group">
                        <label for="tgl_input">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required />
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <input class="form-control" maxlength="255" name="prodi" />
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
// Ambil data input dari form
$nim = isset($_POST['nim']) ? $_POST['nim'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$tempat_lahir = isset($_POST['tempat_lahir']) ? $_POST['tempat_lahir'] : '';
$tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
$prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';

// Tombol simpan diklik
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';

if ($simpan) {
    // Validasi input untuk memastikan tidak kosong
    if (empty($nim) || empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tgl_lahir) || empty($prodi)) {
        echo "<script>alert('Semua data harus diisi!');</script>";
        exit;
    }

    if ($tgl_lahir === '0000-00-00') {
        echo "<script>alert('Tanggal Lahir tidak valid!');</script>";
        exit;
    }
    
    // Lakukan query jika tombol simpan diklik dan data valid
    $sql = $koneksi->query("INSERT INTO tb_anggota (nim, nama, jenis_kelamin, tempat_lahir, tgl_lahir, prodi) 
                            VALUES ('$nim', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tgl_lahir', '$prodi')");

    if ($sql) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location.href='?page=anggota';
              </script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan!');</script>";
    }

    
}
?>
