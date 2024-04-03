<?php
require '../function.php';
$id_toko= $_GET['id'];
$produk = query("SELECT * FROM produk WHERE id_toko = $id_toko");
$toko = query("SELECT * FROM toko WHERE id_toko = $id_toko");
session_start();
include '../header2.php';
?>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Produk</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Produk</h2>
          <div class="row">
            <div class="col-lg-10 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Nama Produk</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Harga</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Berat</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Stok</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                  <?php foreach ($produk as $row) : ?>
                    <tr>
                      <th class="ps-0 py-3 border-light" scope="row">
                        <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="../img/<?= $row["foto_produk"]; ?>" alt="..." width="70"></a>
                          <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"><?= $row["nama_produk"]; ?></a></strong></div>
                        </div>
                      </th>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["harga_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["berat_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["stok_produk"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light"><a class="reset-anchor" href="produk_ubah.php?id=<?= $row['id_produk']; ?>"><i class="fas fa-edit"></i></a>
                      <a class="reset-anchor" href="produk_hapus.php?id=<?= $row['id_produk']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-2">
            </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer.php';
      ?>