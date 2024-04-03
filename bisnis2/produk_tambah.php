<?php
require '../function.php';
include '../header2.php';

$id_toko = $_GET['id'];
$toko = query("SELECT * FROM toko WHERE id_toko = $id_toko")[0];

$kategori = query("SELECT * FROM kategori");
if(isset($_POST["submit"])){
        if(produk_tambah($_POST) > 0){
                echo "
                <script>
                alert('data berhasil ditambahkan!');
                document.location.href='toko.php';
                </script>
                ";
        }else {
                echo "
                <script>
                alert('data gagal ditambahkan!');
                document.location.href='toko.php';
                </script>";
        }
}
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Checkout</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="cart.html">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">+ Produk</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_toko">id toko </label>
                    <input type="text" name="id_toko" value="<?= $toko["id_toko"];?>">
                  </div>
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_user">id toko </label>
                    <input type="text" name="id_user" value="<?= $toko["id_user"];?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="foto_produk">Foto Produk </label>
                    <input class="form-control form-control-lg" type="file" name="foto_produk" id="foto_produk">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_produk">Nama Produk </label>
                    <input class="form-control form-control-lg" type="text" id="nama_poduk" name="nama_produk">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="harga_produk">Harga Produk </label>
                    <input class="form-control form-control-lg" type="text" id="harga_produk" name="harga_produk">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="berat_produk">Berat Produk </label>
                    <input class="form-control form-control-lg" type="text" id="berat_produk" name="berat_produk">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="stok_produk">Stok Produk </label>
                    <input class="form-control form-control-lg" type="text" id="stok_produk" name="stok_produk">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="stok_produk">Kategori (pilihan) </label>
                    <select name="id_kategori" id="id_kategori" class="form-control">
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id_kategori']; ?>" readonly="">
                                    <?= $row['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer2.php';
      ?>