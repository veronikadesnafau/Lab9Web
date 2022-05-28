<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit'])) {
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
      $gambar =  $filename;;
    }
  }
  $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, stok, gambar) ';
  $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
  $result = mysqli_query($conn, $sql);
  header('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  <title>Tambah Barang</title>
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

    .container {
      width: 500px;
      background: #fff;
      margin: 50px auto;
      padding: 50px 30px;
      border-radius: 20px;
      box-shadow: 5px 15px 35px #1b1d1c;
    }

    h1 {
      text-align: center;

      /* text-transform: uppercase; */
    }

    hr {
      margin-top: 10px;
      margin-bottom: 20px;
    }

    .nama {
      box-sizing: border-box;
      width: 100%;
      padding: 10px;
      font-size: 11px;
      margin-bottom: 5px;
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
  </style>
</head>

<body>
<body>
<div class="container">
 <h1>Tambah Barang</h1>
 <br></br>
 <div class="main">
 <form method="post" action="tambah.php"
enctype="multipart/form-data">
 <div class="input">
 <label>Nama Barang</label>
 <input class="nama" type="text" name="nama" />
 </div>
 <div class="input">
 <label>Kategori</label>
 <select class="nama" name="kategori">
 <option value="Komputer">Komputer</option>
 <option value="Elektronik">Elektronik</option>
 <option value="Hand Phone">Hand Phone</option>
 </select>
 </div>
 <div class="input">
 <label>Harga Jual</label>
 <input class="nama" type="text" name="harga_jual" />
 </div>
 <div class="input">
 <label>Harga Beli</label>
 <input class="nama" type="text" name="harga_beli" />
 </div>
 <div class="input">
 <label>Stok</label>
 <input class="nama" type="text" name="stok" />
 </div>
 <div class="input">
 <label>File Gambar</label>
 <input class="nama" type="file" name="file_gambar" />
 </div>
 <!-- <button type="button" class="submit btn btn-primary" input type ="submit" name="submit value= "Simpan" />Simpan</button> -->

 <div class="submit btn btn-primary">
 <input class="kirim" type="submit" name="submit" value="Simpan" />
 </div>
 </form>
 </div>
 </div>
</body>

</html>