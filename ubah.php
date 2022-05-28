<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $harga_jual = $_POST['harga_jual'];
  $harga_beli = $_POST['harga_beli'];
  $stok = $_POST['stok'];
  $file_gambar = $_FILES['file_gambar'];
  $gambar = null;
  if ($file_gambar['error'] == 0) {
    $filename = str_replace(' ', '_', $file_gambar['name']);
    $destination = dirname(__FILE__) . '/gambar/' . $filename;
    if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
      $gambar = 'gambar/' . $filename;;
    }
  }
  $sql = 'UPDATE data_barang SET ';
  $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
  $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
  if (!empty($gambar))
    $sql .= ", gambar = '{$gambar}' ";
  $sql .= "WHERE id_barang = '{$id}'";
  $result = mysqli_query($conn, $sql);
  header('location: index.php');
}

$idd = $_GET['id_barang'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '$idd'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val)
{
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

  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: 'Poppins',sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
      padding : 10px; 
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .ubah {
        font-size:30px;
        font-weight:700;
    }

    .container {
      width: 50%;
      background: #fff;
      margin: 50px auto;
      padding: 40px 40px;
      border-radius: 20px;
      box-shadow: 5px 15px 35px #1b1d1c;
    }

    .nama {
      box-sizing: border-box;
      width: 100%;
      padding: 7px;
      font-size: 11pt;
      margin-bottom: 20px;
      margin-top: 5px;
      border-radius: 10px; 
  
    }
    .kirim {

        background-color: black; 
        border: none;
        width: 100%;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .kirim:hover {
      background: rgb(34, 35, 25);
      cursor: pointer;
    }

    hr {
      margin-top: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="ubah">Ubah Barang</h1>
    <br><br>
    <hr>
    <div class="main">
      <form method="post" action="ubah.php" enctype="multipart/form-data">
        <div class="input">
          <label>Nama Barang</label><br>
          <input class="nama" type="text" name="nama" value="<?php echo $data['nama']; ?>" />
        </div>
        <div class="input"> <label>Kategori</label><br>
          <select class="nama" name="kategori">
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Elektronik">Elektronik</option>
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
          </select>
        </div>
        <div class="input">
          <label>Harga Jual</label><br>
          <input class="nama" type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" />
        </div>
        <div class="input">
          <label>Harga Beli</label><br>
          <input class="nama" type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" />
        </div>
        <div class="input">
          <label>Stok</label><br>
          <input class="nama" type="text" name="stok" value="<?php echo $data['stok']; ?>" />
        </div>
        <div class="input">
          <label>File Gambar</label>
          <input type="file" name="file_gambar" />
        </div>
        <div class="submit">
          <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>" />
          <input class="kirim" type="submit" name="submit" value="Simpan" />
        </div>
      </form>
    </div>
  </div>
</body>

</html>