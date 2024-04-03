<?php
require '../function.php';
session_start();
$id_user = $_GET['id'];
$user = query("SELECT * FROM user WHERE id_user = $id_user")[0];

if (isset($_POST["submit"])) {
  if (profiluser($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'index.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'profil.php'
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
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Profil Akun</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post" >
              <input type="hidden" name="id_user" value="<?= $user["id_user"];?>">
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama">Nama </label>
                    <input type="text" name="nama" class="form-control" id="nama" required value="<?= $user['nama'];?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email </label>
                    <input type="email" name="email" class="form-control" id="email" required value="<?= $user['email'];?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="password">Password </label>
                    <input type="password" name="password" class="form-control" id="password" required value="<?= $user['password'];?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="no_hp">No.HP </label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" required value="<?= $user['no_hp'];?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="alamat">Alamat </label>
                    <input type="text" name="alamat" class="form-control" id="alamat" required value="<?= $user['alamat'];?>">
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
            <?php

// Ambil foto profil dari database
$query = "SELECT foto_profil FROM user WHERE id_user = 'id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Tanggapan jika kueri gagal
    echo "Error: " . mysqli_error($conn);
} else {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // Tampilkan foto profil jika baris ditemukan
        $foto_profil = $row['foto_profil'];
        echo '<img src="' . $foto_profil . '" alt="Profile Picture" class="img-fluid rounded-circle mb-4">';
    } else {
        // Tanggapan jika tidak ada baris yang ditemukan
        echo "Data tidak ditemukan";
    }
}
?>
        </div>
    </div>
</div>
          </div>
        </section>
      </div>
      
<?php
include '../footer.php';
?>