<?php

require '../function.php';
session_start();

$id_user = query("SELECT * FROM user");

if(isset($_POST["submit"])) {
  $toko_added = penjual_tambah($_POST);
  
  if($toko_added > 0) {
      $id_user = $_SESSION['id_user'];
      
      $query_user_type = "SELECT user_type FROM user WHERE id_user = $id_user";
      $result_user_type = mysqli_query($conn, $query_user_type);
      $row_user_type = mysqli_fetch_assoc($result_user_type);
      $user_type = $row_user_type['user_type'];
      
      if($user_type != 'admin') {
          $query_update = "UPDATE user SET user_type = 'bisnis' WHERE id_user = $id_user";
          $result_update = mysqli_query($conn, $query_update);
          
          if(!$result_update) {
              echo "Query update failed: " . mysqli_error($conn);
          }
      }
      
      $query_count = "SELECT COUNT(*) AS total_toko FROM toko WHERE id_user = $id_user";
      $result_count = mysqli_query($conn, $query_count);
      $row_count = mysqli_fetch_assoc($result_count);
      $total_toko = $row_count['total_toko'];
      
      if($total_toko <= 5) {
          echo "<script>
                  alert('Data berhasil ditambahkan!');
                  document.location.href= '../bisnis2/toko.php';
                </script>";
      } else {
          echo "Batas maksimal toko (5) telah tercapai.";
      }
  } else {
      echo "Penambahan toko gagal";
  }
}

include '../header.php';
?>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Buka Toko</h1>
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
          <h2 class="h5 text-uppercase mb-4">+ TOKO</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post">
                <div class="row gy-3">
                <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_user">id user</label>
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
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_user">id user</label>
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
                    <label class="form-label text-sm text-uppercase" for="nama_toko">Nama </label>
                    <input class="form-control form-control-lg" type="text" name="nama_toko" id="nama_toko">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="alamat_toko">Alamat </label>
                    <input class="form-control form-control-lg" type="text" name="alamat_toko" id="alamat_toko">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="hp_toko">No.HP </label>
                    <input class="form-control form-control-lg" type="text" name="hp_toko" id="hp_toko">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email</label>
                    <?php
                        $id_user = $_SESSION['id_user'];
                        $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                            echo '<input type="text" name="email" id="email" class="form-control"  readonly="" value="' . $row['email'] . '">';
                        }
                    ?>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" name="submit"><a href="../bisnis2/toko.php">Masuk ke halaman toko</a></button>
                    <button class="btn btn-dark" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer.php';
      ?>