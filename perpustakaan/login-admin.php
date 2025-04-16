<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "perpustakaann");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['username']); // untuk nama anggota
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); // untuk nim anggota

    // Cek login sebagai admin
    $queryAdmin = "SELECT * FROM admin WHERE username = '$nama' AND password = '$password'";
    $resultAdmin = mysqli_query($koneksi, $queryAdmin);

    if (mysqli_num_rows($resultAdmin) > 0) {
        $data = mysqli_fetch_assoc($resultAdmin);
        $_SESSION['user'] = $data; // session untuk admin
        $_SESSION['level'] = 'admin'; // menentukan level admin

        echo "
        <script>
            alert('Selamat Datang Admin " . $data['username'] . "');
            window.location.replace('index.php');
        </script>
        ";
    } else {
        // Cek login sebagai anggota
        $queryAnggota = "SELECT * FROM tb_anggota WHERE nama = '$nama' AND nim = '$password'";
        $resultAnggota = mysqli_query($koneksi, $queryAnggota);

        if (mysqli_num_rows($resultAnggota) > 0) {
            $data = mysqli_fetch_assoc($resultAnggota);
            // Menyimpan data anggota ke session
            $_SESSION['user'] = [
                'nim' => $data['nim'],
                'nama' => $data['nama'],
                'role' => 'anggota'
            ];
            $_SESSION['level'] = 'anggota'; // menentukan level anggota

            echo "
            <script>
                alert('Selamat Datang " . $data['nama'] . "');
                window.location.replace('index.php');
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Nama atau NIM salah');
                location.href = 'login-anggota.php'; // arahkan ke halaman login anggota
            </script>
            ";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap' rel='stylesheet' />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #6e7e90, #2a3d54);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            background-size: cover;
        }
        .container {
            width: 100%;
            max-width: 800px;
        }
        .panel {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            color: #fff;
        }
        .panel-heading {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        .form-group input {
            background-color: #2a3d54;
            border: none;
            border-radius: 4px;
            padding: 10px;
            color: #fff;
            width: 100%;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            background-color: #4b6579;
            outline: none;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
        }
        .input-group-addon {
            background-color: #4b6579;
            border: none;
            color: #fff;
        }
        .btn-primary {
            background-color: #4b6579;
            border: none;
            color: #fff;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #5a6f89;
        }
        .panel-body {
            padding: 20px;
            width:100%;
        }
        h2 {
            font-weight: 700;
            font-size: 60px;
            font-family: 'Times New Roman', Times, serif;
        }
        h5 {
            font-weight: 400;
            margin-top: -10px;
        }
        .panel-heading strong {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2>Admin & User</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Masukkan Username & Password Anda</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Your Username" required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Your Password" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Login Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
