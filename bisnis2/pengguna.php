<?php
include '../header2.php';
require '../function.php';
$user = query("SELECT * FROM user");
session_start();
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-2 px-lg-3 py-lg-2 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 mb-0">Daftar Pengguna</h1>
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
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="../bisnis/toko.php"><i class="fas fa-long-arrow-alt-left me-2"> </i>Kembali</a></div>
                  <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="../bisnis2/pengguna_tambah.php">+ Pengguna<i class=" ms-2"></i></a></div>
                </div>
              </div>
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Nama</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Email</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">No.HP</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Alamat</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Level</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Opsi</strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                  <?php
                    $id = $_SESSION['id_user'];
                    $where_id = "WHERE id_user = $id";
                    if($_SESSION['user_type'] == 'admin'){
                        $user = mysqli_query($conn, "SELECT * FROM user");
                    } else {
                        $user = mysqli_query($conn, "SELECT * FROM user $where_id");
                    }
                    if ($user) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($user)) {
                    ?>
                    <tr>
                    <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["nama"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["email"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["no_hp"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["alamat"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0"><?= $row["user_type"]; ?></p>
                      </td>
                      <td class="p-3 align-middle border-light"><a class="reset-anchor" href="pengguna_ubah.php?id=<?= $row['id_user']; ?>"><i class="fas fa-edit"></i></a>
                      <a class="reset-anchor" href="pengguna_hapus.php?id=<?= $row['id_user']; ?>"><i class="fas fa-trash-alt"></i></a>
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