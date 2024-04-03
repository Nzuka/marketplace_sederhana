<?php
session_start();
require '../function.php';

$id_produk = $_GET['id'];
$produk = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];
$kategori = query("SELECT * FROM kategori");

if (isset($_POST["submit"])) {
  if (produk_ubah($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'toko.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'toko.php'
      </script>
      ";
  }
}
include '../header2.php';
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
          <h2 class="h5 text-uppercase mb-4">Billing details</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="fotoLama" value="<?= $produk["foto_produk"]; ?>">
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_produk">id produk </label>
                    <input class="form-control form-control-lg" type="text" name="id_produk" id="id_produk" value="<?= $produk["id_produk"]; ?>">
                  </div>
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="foto_produk">Foto </label>
                    <input class="form-control form-control-lg" type="file" name="foto_lama" value="<?= $produk["foto_produk"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="foto_produk">Foto </label>
                    <input class="form-control form-control-lg" type="file" name="foto_produk" id="foto_produk" value="<?= $produk["foto_produk"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_produk">Nama Produk </label>
                    <input class="form-control form-control-lg" type="text" name="nama_produk" id="nama_produk" value="<?= $produk["nama_produk"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="stok_produk">Harga </label>
                    <input class="form-control form-control-lg" type="text" name="harga_produk" id="harga_produk" value="<?= $produk["harga_produk"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="berat_produk">Berat </label>
                    <input class="form-control form-control-lg" type="text" name="berat_produk" id="berat_produk" value="<?= $produk["stok_produk"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="stok_produk">Stok </label>
                    <input class="form-control form-control-lg" type="text" name="stok_produk" id="stok_produk" value="<?= $produk["stok_produk"]; ?>">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="form-label text-sm text-uppercase" for="kategori">Kategori (pilihan)</label>
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
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Red digital smartwatch</strong><span class="text-muted small">$250</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Gray Nike running shoes</strong><span class="text-muted small">$351</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span>$601</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php
include '../footer2.php';
?>