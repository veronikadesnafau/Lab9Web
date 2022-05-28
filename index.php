<?php
include("koneksi.php");
require("header.php");
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>


    <div class="main">
      <table border="1" cellpadding="10" cellspacing="0">
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Harga Jual</th>
          <th>Harga Beli</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>

        <?php
        if ($result) :
        ?>
          <?php
          $nomor = 1;
          while ($row = mysqli_fetch_array($result)) :
          ?>
            <tr>
              <td style="text-align: center;"><?php echo $nomor++; ?></td>
              <!-- <td><?= $row['id_barang']; ?></td> -->
              <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" width="100">
              <td><?= $row['nama']; ?></td>
              <td><?= $row['kategori']; ?></td>
              <td><?= "Rp. " . $row['harga_jual']; ?></td>
              <td><?= "Rp. " . $row['harga_beli']; ?>
              </td>
              <td><?= $row['stok']; ?></td>
              <td>
                <a class="ubah" href="ubah.php?id_barang=<?php echo $row['id_barang']; ?>">Edit</a>
                <a class="hapus" href="hapus.php?id_barang=<?php echo $row['id_barang']; ?>">Hapus</a>
              </td>

            </tr>
          <?php endwhile;
        else : ?>
          <tr>
            <td colspan="7">Belum ada data</td>
          </tr>
        <?php endif; ?>

      </table>
    </div>
  </div>
  <?php
  require("footer.php") ;
  ?>
</body>

</html>