<?php
session_start();
include('../header.php');
include('../function.php');

$produk = query("SELECT * FROM produk");

$keranjang1 = query("SELECT * FROM keranjang");
$keranjang = query("SELECT * FROM keranjang ORDER BY id_keranjang DESC LIMIT 200");
?>
 
      <div class="container">
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Keranjang Belanja</h2>
          <div class="row">
            <div class="col-lg-12s mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
              <?php $i=1 ?>
              <?php foreach ($keranjang as $row) : ?>
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Produk</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Harga</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Kuantitas</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total Harga</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                  </thead>
                  <tbody class="border-0">
                    <tr>
                      <th class="ps-0 py-3 border-light" scope="row">
                        <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.php"><img src="../img/<?= $row["foto_produk"]; ?>" alt="..." width="70" heigth="70"/></a>
                          <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.php"><?= $row["nama_produk"]; ?></a></strong></div>
                        </div>
                      </th>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small"><?= $row["harga_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small"><?= $row["jumlah_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small"><?= $row["total_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light"><a class="reset-anchor" href="#!"><a href="keranjang_hapus.php?id_keranjang=<?= $row["id_keranjang"]; ?>"onclick="return confirm('Benar ada dihapus'); "><i class="fas fa-trash-alt"></i></a>
                      <a class="reset-anchor"><a href="pesanan_tambah.php?id=<?= $row["id_keranjang"]; ?>"><i class="fas fa-check-double"></i></a></td>
                    </tr>
                  </tbody>
                </table>
                <?php $i++; ?>
                <?php endforeach; ?>
              </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer.php'
      ?>