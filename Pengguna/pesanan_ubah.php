<?php
session_start();
require '../function.php';

$id_pesanan = $_GET['id'];
$pesanan = query("SELECT * FROM pesanan WHERE id_pesanan = $id_pesanan")[0];

if (isset($_POST["submit"])) {
  if (pesanan_ubah($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'pesanan.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'pesanan.php'
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
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_pesanan">id pesanan </label>
                    <input class="form-control form-control-lg" type="text" name="id_pesanan" id="id_pesanan" value="<?= $pesanan["id_pesanan"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="invoice">Kode Pesanan </label>
                    <input class="form-control form-control-lg" type="text" name="invoice" readonly="" value="<?= $pesanan["invoice"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="total_harga">Total Harga </label>
                    <input class="form-control form-control-lg" type="text" name="total_harga" id="total_harga" readonly="" value="<?= $pesanan["total_harga"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="tgl_pending">Tanggal Dipending </label>
                    <input class="form-control form-control-lg" type="date" name="tgl_pending" id="tgl_pending" readonly="" value="<?= $pesanan["tgl_pending"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="tgl_dikemas">Tanggal Dikemas </label>
                    <input class="form-control form-control-lg" type="date" name="tgl_dikemas" id="tgl_dikemas" readonly="" required value="<?= $pesanan["tgl_dikemas"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="tgl_dikirim">Tanggal Dikirim </label>
                    <input class="form-control form-control-lg" type="date" name="tgl_dikirim" id="tgl_dikirim" readonly="" value="<?= $pesanan["tgl_dikirim"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="status">Status </label>
                    <select class="form-control" name="status" id="status" name="status" data-customclass="form-control form-control-lg rounded-0">
                            <option value="diterima">Diterima</option>
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