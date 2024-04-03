<?php
session_start();
require '../function.php';

$id_pembayaran = $_GET['id'];
$pembayaran = query("SELECT * FROM pembayaran WHERE id_pembayaran = $id_pembayaran")[0];

if (isset($_POST["submit"])) {
  if (pembayaran_ubah($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'pembayaran.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'pembayaran.php'
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
                <h1 class="h2 text-uppercase mb-0">Pembayaran</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Ubah Pembayaran</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post">
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_pembayaran">id pembayaran </label>
                    <input class="form-control form-control-lg" type="text" name="id_pembayaran" id="id_pembayaran" value="<?= $pembayaran["id_pembayaran"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_pembayaran">Nama Pembayaran </label>
                    <input class="form-control form-control-lg" type="text" name="nama_pembayaran" id="nama_pembayaran" value="<?= $pembayaran["nama_pembayaran"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="biaya_pembayaran">Biaya Pembayaran</label>
                    <input class="form-control form-control-lg" type="text" name="biaya_pembayaran" id="biaya_pembayaran" value="<?= $pembayaran["biaya_pembayaran"]; ?>">
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