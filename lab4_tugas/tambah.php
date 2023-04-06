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
            <a href="tambah.php">tambah Barang</a>
        </nav>
        <?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['gambar'];
    
    $file = $_FILES['gambar'];
    $filename = $file['name'];
    $filetmp = $file['tmp_name'];
    $filetype = $file['type'];
    $filesize = $file['size'];
    $fileerror = $file['error'];

  $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
  if (in_array($filetype, $allowed_types)) {

    if ($filesize <= 2000000) {
      $new_filename = uniqid('', true) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
      $destination = 'gambar/' . $new_filename;
      // Move uploaded file to destination folder
      if (move_uploaded_file($filetmp, $destination)) {
        // Insert data into database
        $sql = "INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
                VALUES ('{$kategori}', '{$nama}', '{$destination}', '{$harga_beli}', '{$harga_jual}', '{$stok}')";

        if (mysqli_query($conn, $sql)) {
          header('location: home.php');
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      } else {
        echo 'Error uploading file.';
      }
    } else {
      echo 'File size exceeds limit.';
    }
  } else {
    echo 'File type not allowed.';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Tambah Barang</title>
</head>
<body>
<div class="container">
    <h1>Tambah Barang</h1>
    <div class="main">
        <form method="post" action="tambah.php"
enctype="multipart/form-data">
        <div class="input">
            <label>Nama Barang</label>
            <input type="text" name="nama" />
        </div>
        <div class="input">
            <label>Kategori</label>
            <select name="kategori">
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
<           </select>
        </div>
        <div class="input">
            <label>Harga Jual</label>
            <input type="text" name="harga_ jual" />
        </div>
        <div class="input">
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" />
        </div>
        <div class="input">
            <label>Stok</label>
            <input type="text" name="stok" />
        </div>
        <div class="input">
            <label>File Gambar</label>
            <input type="file" name="gambar" />
        </div>
        <div class="submit">
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