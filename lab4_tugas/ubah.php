<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Modularisasi</title>
    <link href="style.css" rel="stylesheet" type="text/stylesheet"
media="screen" />
</head>
<body>
    <div class="container">
        <header>
            <h1>Database</h1>
        </header>
        <nav>
            <a href="home.php">Home</a>
            <a href="tambah.php">Tambah Barang</a>
        </nav>
        <?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $id_barang= $_POST['id_barang'];
    $Nama = $_POST['Nama'];
    $Kategori = $_POST['Kategori'];
    $Harga_Jual = $_POST['Harga_Jual'];
    $Harga_Beli = $_POST['Harga_Beli'];
    $Stok = $_POST['Stok'];
    $file_gambar = $_FILES['file_gambar'];
    $Gambar = null;

    if ($file_gambar['error'] == 0)
    {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) 
        {
            $gambar = 'gambar/' . $filename;;
        }
    }
    
    $sql = 'UPDATE data_barang SET ';
    $sql .= "Nama = '{$Nama}', Kategori = '{$Kategori}', ";
    $sql .= "Harga_Jual = '{$Harga_Jual}', Harga_Beli = '{$Harga_Beli}', Stok
= '{$Stok}' ";
    if (!empty($gambar))
        $sql .= ", Gambar = '{$Gambar}' ";
    $sql .= "WHERE id_barang = '{$id_barang}'";
    $result = mysqli_query($conn, $sql);

    header('location: home.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);

function is_select($var, $val) {
    if ($var == $val) return 'selected="selected"';
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />  
    <title>Ubah Barang</title>
</head>
<body>
<div class="container">
    <h1>Ubah Barang</h1>
    <div class="main">
        <form method="post" action="ubah.php"enctype="multipart/form-data">
            <div class="input">
                <label>Nama Barang</label>
                <input type="text" name="Nama" value="<?php echo $data['Nama'];?>" />
            </div>
            <div class="input">
                <label>Kategori</label>
                <select name="Kategori">
                <option <?php echo is_select('Komputer', $data['Kategori']);?> value="Komputer">Komputer</option>
                <option <?php echo is_select('Komputer', $data['Kategori']);?> value="Elektronik">Elektronik</option>
                <option <?php echo is_select('Komputer', $data['Kategori']);?> value="Hand Phone">Hand Phone</option>
            </select>
            </div>
            <div class="input">
                <label>Harga Jual</label>
                <input type="text" name="Harga_Jual" value="<?php echo $data['Harga_Jual'];?>" />
            </div>
            <div class="input">
                <label>Harga Beli</label>
                <input type="text" name="Harga_Beli" value="<?php echo $data['Harga_Beli'];?>" />
            </div>
            <div class="input">
                <label>Stok</label>
                <input type="text" name="Stok" value="<?php echo $data['Stok'];?>" />
            </div>
            <div class="input">
                <label>File Gambar</label>
                <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
                <input type="hidden" name="id" value="<?php echo $data['id_barang'];?>" />
                <input type="submit" name="submit" value="Simpan" />
            </div>
        </form>
    </div>
</div>
</body>
</html>
        <footer>
            <p>&copy; 2022 Informatika Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>