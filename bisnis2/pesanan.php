<?php
session_start();
require('../function.php');
include('../header2.php');


$pesanan = "SELECT * FROM pesanan WHERE id_pesanan = id_pesanan";
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Pesanan</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Pesanan Anda</h2>
          <div class="row">
            <div class="col-lg-12 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Kode Pesanan</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total Harga</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Pending</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Dikemas</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Dikirim</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Status</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                  <?php
                    if (isset($_SESSION['id_user'])) {
                        $id = $_SESSION['id_user'];
                        $query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_user = '$id'");
                        $result = mysqli_num_rows($query);

                        if ($_SESSION['user_type'] == 'admin') {
                            $pesanan_query = "SELECT
                                user.nama AS nama_user,
                                produk.nama_produk,
                                pengiriman.nama_pengiriman,
                                pesanan.invoice,
                                pesanan.total_harga,
                                pesanan.tgl_pending,
                                pesanan.tgl_dikemas,
                                pesanan.tgl_dikirim,
                                pesanan.tgl_diterima,
                                pesanan.produk_id,
                                pesanan.status
                            FROM
                                pesanan
                            INNER JOIN
                                user ON user.id_user = pesanan.id_user
                            INNER JOIN
                                produk ON produk.id_produk = pesanan.id_produk
                            INNER JOIN
                                pengiriman ON pengiriman.id_pengiriman = pesanan.d_pengiriman
                            WHERE
                                user.id_user = '$id'";
                        } else {
                            $pesanan_query = "SELECT
                                user.nama AS nama_user,
                                produk.nama_produk,
                                pengiriman.nama_pengiriman,
                                pesanan.invoice,
                                pesanan.total_harga,
                                pesanan.tgl_pending,
                                pesanan.tgl_dikemas,
                                pesanan.tgl_dikirim,
                                pesanan.tgl_diterima,
                                pesanan.produk_id,
                                pesanan.status
                            FROM
                                pesanan
                            INNER JOIN
                                user ON user.id_user = pesanan.id_user  
                            INNER JOIN
                                produk ON produk.id_produk = pesanan.id_produk
                            INNER JOIN
                                pengiriman ON pengiriman.id_pengiriman = pesanan.id_pengiriman
                            WHERE
                                user.id_user = '$id'";
                        }

                        // Periksa apakah query berhasil dieksekusi
                        if (!$query) {
                            die("Error: " . mysqli_error($conn));
                        }

                        // Lakukan sesuatu dengan hasil query
                        if ($result > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                            <tr>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['invoice']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['total_harga']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['tgl_pending']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['tgl_dikemas']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['tgl_dikirim']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light">
                                <p class="mb-0 small"><?php echo $row['status']; ?></p>
                              </td>
                              <td class="p-3 align-middle border-light"><a class="reset-anchor" href="pesanan_ubah.php?id=<?= $row['id_pesanan']; ?>"><i class="fas fa-edit"></i></a>
                              <a class="reset-anchor" href="pesanan_hapus.php?id=<?= $row['id_pesanan']; ?>"><i class="fas fa-trash-alt"></i></a>
                              <a class="reset-anchor" href="pesanan_tambah.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-plus-square"></i></a>
                              <a class="reset-anchor" href="produk.php?id=<?= $row['id_toko']; ?>"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <?php
                                      }
                              } else {
                                  echo "Tidak ada data pesanan yang ditemukan.";
                              }
                          } else {
                              echo "Session ID tidak tersedia.";
                          }
                          
                          mysqli_close($conn);
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