<?php
include '../header2.php';
require '../function.php';
$toko = query("SELECT * FROM toko");
session_start();

?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-2 px-lg-3 py-lg-2 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 mb-0">Daftar Toko</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="row">
            <div class="col-lg-12 mb-4 mb-lg-0">
              <!-- CART NAV-->
              <div class="bg-light px-3 py-2 mb-4">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start">
                  <a class="btn btn-outline-dark btn-sm" href="../Pengguna/toko_tambah.php">+ Toko<i class=" ms-2"></i></a>
                  <a class="btn btn-outline-dark btn-sm" href="../bisnis2/pesanan.php">Pesanan<i class=" ms-2"></i></a></div>
                  <div class="col-md-6 text-md-end">
                  <a class="btn btn-outline-dark btn-sm" href="../bisnis2/pengguna.php">+ Pengguna<i class=" ms-2"></i></a>
                  <a class="btn btn-outline-dark btn-sm" href="../bisnis2/kategori_tabel.php">+ Kategori<i class=" ms-2"></i></a>
                  <a class="btn btn-outline-dark btn-sm" href="../bisnis2/pengiriman.php">+ Pengiriman<i class=" ms-2"></i></a>
                  <a class="btn btn-outline-dark btn-sm" href="../bisnis2/pembayaran.php">+ Pembayaran<i class=" ms-2"></i></a>
                  </div>
                  
                </div>
              </div>
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Nama Toko</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">No.HP</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Alamat</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                  <?php
                    $id = $_SESSION['id_user'];
                    $where_id = "WHERE id_user = $id";
                    if($_SESSION['user_type'] == 'admin'){
                        $user = mysqli_query($conn, "SELECT * FROM toko");
                    } else {
                        $user = mysqli_query($conn, "SELECT * FROM toko $where_id");
                    }
                    if ($user) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($user)) {
                    ?>
                    <tr>
                    <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["nama_toko"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["hp_toko"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["alamat_toko"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light"><a class="reset-anchor" href="toko_ubah.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-edit"></i></a>
                      <a class="reset-anchor" href="toko_hapus.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-trash-alt"></i></a>
                      <a class="reset-anchor" href="produk_tambah.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-plus-square"></i></a>
                      <a class="reset-anchor" href="produk.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-eye"></i></a></td>
                      <td class="p-3 align-middle border-light"></td>
                    </tr>
                    <?php
                         }
                          } else {
                            echo "Query failed: " . mysqli_error($conn);
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
include '../footer2.php';
?>