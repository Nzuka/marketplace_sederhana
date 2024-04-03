<?php
require 'function.php';
session_start();

$id_produk = $_GET['id'];
$produk1 = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];

$id_user = query("SELECT * FROM user");
$produk = query("SELECT * FROM produk");
$pengiriman = query("SELECT * FROM pengiriman");
$pembayaran = query("SELECT * FROM pembayaran");
$tanggal_pemesanan = date('Y-m-d');
if(isset($_POST["submit"])){
        if(pesanan_tambah($_POST) > 0){
                echo "
                <script>
                alert('data berhasil ditambahkan!');
                document.location.href= 'index.php';
                </script>
                ";
        }else {
            echo "Query failed: " . mysqli_error($conn);
        }
}

// Fungsi untuk menghasilkan nomor invoice
function generateInvoiceNumber() {
  return 'SEN' . date('YmdHis');
}
$invoice = generateInvoiceNumber();

// Tanggal pesanan
$orderDate = date('Y-m-d');


include('../header.php');
?>
    
      <div class="container">
      <form action="" method="post">
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">DETAIL INFORMASI</h2>
          <div class="row">
            <div class="col-lg-12">
                <div class="row gy-3">
                <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_toko">id toko </label>
                    <input class="form-control form-control-lg" type="text" id="id_toko" name="id_toko" value="<?= $produk1["id_toko"];?>" readonly>
                  </div>
                <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_produk">id produk</label>
                    <input class="form-control form-control-lg" type="text" id="id_produk" name="id_produk" value="<?= $produk1["id_produk"];?>" readonly>
                  </div>
                <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="invoice">No.Pemesanan </label>
                    <input class="form-control form-control-lg" type="text" id="invoice" name="invoice" value="<?php echo $invoice ?>" readonly>
                  </div>
                  <div class="col-lg-6">
                  <label class="form-label text-sm text-uppercase" for="tgl_pending">Tanggal Pemesanan</label>
                  <input class="form-control form-control-lg" type="text" id="tgl_pending" name="tgl_pending" value="<?php echo $tanggal_pemesanan; ?>" readonly>
                  </div>
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_user">ID USER </label>
                    <?php
                            $id_user = $_SESSION['id_user'];
                            $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
                            ?>
                            <?php
                                while ($row = mysqli_fetch_array($query)) {
                                  echo '<input type="text" name="id_user" id="id_user" class="form-control"  readonly="" value="' . $row['id_user'] . '">';
                                }
                                ?>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama">Nama </label>
                    <?php
                            $id_user = $_SESSION['id_user'];
                            $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
                            ?>
                            <?php
                                while ($row = mysqli_fetch_array($query)) {
                                  echo '<input type="text" name="nama" id="nama" class="form-control"  readonly="" value="' . $row['nama'] . '">';
                                }
                                ?>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="no_hp">NO.HP </label>
                    <?php
                            $id_user = $_SESSION['id_user'];
                            $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
                            ?>
                            <?php
                                while ($row = mysqli_fetch_array($query)) {
                                  echo '<input type="text" name="no_hp" id="no_hp" class="form-control"  readonly="" value="' . $row['no_hp'] . '">';
                                }
                                ?>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="alamat">Alamat </label>
                    <?php
                            $id_user = $_SESSION['id_user'];
                            $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
                            ?>
                            <?php
                                while ($row = mysqli_fetch_array($query)) {
                                  echo '<input type="text" name="alamat" id="alamat" class="form-control"  readonly="" value="' . $row['alamat'] . '">';
                                }
                                ?>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_produk">Nama Produk </label>
                    <input class="form-control form-control-lg" type="text" id="nama_produk" name="nama_produk" value="<?= $produk1["nama_produk"];?>" readonly>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="harga_produk">Harga Produk </label>
                    <input class="form-control form-control-lg" type="text" id="harga_produk" name="harga_produk" value="<?= $produk1["harga_produk"];?>" readonly>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="form-label text-sm text-uppercase" for="id_pengiriman">Pengiriman (Pilihan)</label>
                    <select class="form-control" name="id_pengiriman" id="id_pengiriman" name="id_pengiriman" data-customclass="form-control form-control-lg rounded-0">
                    <?php foreach ($pengiriman as $row) : ?>
                                <option value="<?= $row['id_pengiriman']; ?>" readonly="">
                                    <?= $row['nama_pengiriman']; ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="jumlah_produk">Jumlah Produk </label>
                    <input class="form-control form-control-lg" type="text" id="jumlah_produk" name="jumlah_produk" value="<?= $produk1["jumlah_produk"];?>" placeholder="Masukkan jumlah produk Anda!">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="pesan">Pesan (Opsional)</label>
                    <input class="form-control form-control-lg" type="text" id="pesan" name="pesan" placeholder="Beri pesan kepada penjual...">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="form-label text-sm text-uppercase" for="id_pembayaran">Pembayaran (Pilihan)</label>
                    <select class="form-control" name="id_pembayaran" id="id_pembayaran" name="id_pembayaran" data-customclass="form-control form-control-lg rounded-0">
                    <?php foreach ($pembayaran as $row) : ?>
                                <option value="<?= $row['id_pembayaran']; ?>" readonly="">
                                    <?= $row['nama_pembayaran']; ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="status">Status</label>
                    <select class="form-control" name="status" id="status" name="status" data-customclass="form-control form-control-lg rounded-0">
                            <option value="pending">Pending</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <button class="btn btn-link text-dark p-0 shadow-0" type="button" data-bs-toggle="collapse" data-bs-target="#alternateAddress">
                  </button>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" name="submit">Pesan Sekarang</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
      <?php
include('../footer.php');
?>