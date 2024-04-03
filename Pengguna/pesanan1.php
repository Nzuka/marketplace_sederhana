<?php
session_start();
require('../function.php');
include('../header.php');

?>

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Cart</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <!-- CART TABLE-->
                <div class="table-responsive mb-4">
                    <table class="table text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <!-- Kolom tabel -->
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            <?php
                            if (isset($_SESSION['id_toko'])) {
                                $id_toko = $_SESSION['id_toko'];
                                $query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_toko = '$id_toko'");
                                if($_SESSION['user_type'] == 'admin'){
                                  $pesanan = "SELECT
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
                                } else {
                                $pesanan = "SELECT
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

                                if (!$result) {
                                    die("Error: " . mysqli_error($conn));
                                }

                                if (mysqli_num_rows($result) > 0) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                        <tr>
                      <th class="ps-0 py-3 border-light" scope="row">
                      <?php echo $i++; ?>
                        <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="img/product-detail-3.jpg" alt="..." width="70"/></a>
                          <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html"><?php echo $row['invoice']; ?></a></strong></div>
                        </div>
                      </th>
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
                        <p class="mb-0 small"><?php echo $row['diterima']; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small"><?php echo $row['status']; ?></p>
                      </td>
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
                <!-- CART NAV-->
                <div class="bg-light px-4 py-3">
                    <!-- Tombol navigasi -->
                </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
                <!-- Total pembelian -->
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php'
?>