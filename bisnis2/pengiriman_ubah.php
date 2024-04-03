<?php
session_start();
require '../function.php';

$id_pengiriman = $_GET['id'];
$pengiriman = query("SELECT * FROM pengiriman WHERE id_pengiriman = $id_pengiriman")[0];

if (isset($_POST["submit"])) {
  if (pengiriman_ubah($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'pengiriman.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'pengiriman.php'
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
                <h1 class="h2 text-uppercase mb-0">Pengiriman</h1>
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
          <h2 class="h5 text-uppercase mb-4">Ubah Pengiriman</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post">
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_pengiriman">id pengiriman </label>
                    <input class="form-control form-control-lg" type="text" name="id_pengiriman" id="id_pengiriman" value="<?= $pengiriman["id_pengiriman"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_pengiriman">Nama Pengiriman </label>
                    <input class="form-control form-control-lg" type="text" name="nama_pengiriman" id="nama_pengiriman" value="<?= $pengiriman["nama_pengiriman"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="harga_pengiriman">Harga Pengiriman </label>
                    <input class="form-control form-control-lg" type="text" name="harga_pengiriman" id="harga_pengiriman" value="<?= $pengiriman["harga_pengiriman"]; ?>">
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