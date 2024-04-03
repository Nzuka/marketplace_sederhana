<?php
session_start();
require('../function.php');

$id = $_SESSION['id_user'];
$where_id = "WHERE id_user = $id";
if($_SESSION['user_type'] == 'admin'){
    $user = mysqli_query($conn, "SELECT * FROM kategori");
} else {
    // Jika bukan admin, kembalikan pesan kesalahan atau lakukan aksi lain sesuai kebutuhan
    echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
    exit; // Menghentikan eksekusi skrip selanjutnya
}

include('../header.php');

$pembayaran = "SELECT * FROM kategori WHERE id_kategori = id_kategori";
?>
      <div class="container">
        <section class="py-5">
          <div class="row">
          <div class="row">
            <div class="col-lg-12 mb-4 mb-lg-0">
              <!-- CART NAV-->
              <div class="bg-light px-3 py-2 mb-4">
              <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="../bisnis/toko.php"><i class="fas fa-long-arrow-alt-left me-2"> </i>Kembali</a></div>
                  <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="../bisnis2/kategori_tambah.php">+ Kategori<i class=" ms-2"></i></a></div>
                </div>
              </div>
            <div class="col-lg-6 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Nama kategori</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                  <?php
                  if ($user) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($user)) {
                  ?>
                    <tr>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small"><?= $row["nama_kategori"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                      <a class="reset-anchor" href="kategori_hapus.php?id=<?= $row['id_kategori']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php
                     }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer.php'
      ?>