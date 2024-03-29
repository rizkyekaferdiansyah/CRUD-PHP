<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama        = "";
$notelp       = "";
$asalkota     = "";
$jeniskelamin   = "";
$posisi   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama        = $r1['nama'];
    $notelp       = $r1['notelp'];
    $asalkota    = $r1['asalkota'];
    $jeniskelamin   = $r1['jeniskelamin'];
    $posisi   = $r1['posisi'];

    if ($nama == '') {
        $error = "Data Tidak Ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama        = $_POST['nama'];
    $notelp       = $_POST['notelp'];
    $asalkota     = $_POST['asalkota'];
    $jeniskelamin   = $_POST['jeniskelamin'];
    $posisi   = $_POST['posisi'];


    if ($nama && $notelp && $asalkota && $jeniskelamin && $posisi) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nama = '$nama', notelp='$notelp', asalkota='$asalkota',jeniskelamin = '$jeniskelamin',posisi='$posisi' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Di Update";
            } else {
                $error  = "Data Gagal Di Update";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nama,notelp,asalkota,jeniskelamin,posisi) values ('$nama','$notelp','$asalkota','$jeniskelamin','$posisi')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil Memasukkan Data";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan Lengkapi Semua Data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="notelp" class="col-sm-2 col-form-label">No Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $notelp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="asalkota" class="col-sm-2 col-form-label">Asal Kota</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="asalkota" name="asalkota" value="<?php echo $asalkota ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <!--
                            <input type="text" class="form-control" id="jeniskelamin" name="jeniskelamin" value="<?php echo $jeniskelamin ?>">
                            -->
                            <select name="jeniskelamin" id="jeniskelamin" class="form-control">
                                <option>--Pilih Jenis Kelamin--</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="posisi" class="col-sm-2 col-form-label">Posisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="posisi" name="posisi" value="<?php echo $posisi ?>">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header text-white bg-secondary">
                Data Pegawai
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Asal Kota</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id           = $r2['id'];
                            $nama         = $r2['nama'];
                            $notelp       = $r2['notelp'];
                            $asalkota     = $r2['asalkota'];
                            $jeniskelamin = $r2['jeniskelamin'];
                            $posisi       = $r2['posisi'];
                            
    
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $notelp ?></td>
                                <td scope="row"><?php echo $asalkota ?></td>
                                <td scope="row"><?php echo $jeniskelamin ?></td>
                                <td scope="row"><?php echo $posisi ?></td>
    
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin Mau Hapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    <!-- untuk mengeluarkan data -->
</body>

</html>
