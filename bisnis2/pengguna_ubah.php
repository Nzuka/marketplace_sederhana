<?php
session_start();
require '../function.php';

$id_user = $_GET['id'];
$user = query("SELECT * FROM user WHERE id_user = $id_user")[0];

if (isset($_POST["submit"])) {
  if (pengguna_ubah($_POST) > 0) {
      echo "
      <script>
      alert('data berhasil diubah!')
      document.location.href = 'toko.php'
      </script>
      "; 
  } else {
      echo "
      <script>
      alert('data gagal diubah!')
      document.location.href = 'toko.php'
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
                <h1 class="h2 text-uppercase mb-0">Profil Pengguna</h1>
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
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="fotoLama" value="<?= $produk["foto_profil"]; ?>">
                <div class="row gy-3">
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="id_user">id user </label>
                    <input class="form-control form-control-lg" type="text" name="id_user" id="id_user" value="<?= $user["id_user"]; ?>">
                  </div>
                  <div class="col-lg-6" hidden="">
                    <label class="form-label text-sm text-uppercase" for="foto_profil">Foto </label>
                    <input class="form-control form-control-lg" type="file" name="foto_lama" value="<?= $user["foto_profil"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="foto_profil">Foto </label>
                    <input class="form-control form-control-lg" type="file" name="foto_profil" id="foto_profil" value="<?= $user["foto_profil"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama">Nama </label>
                    <input class="form-control form-control-lg" type="text" name="nama" id="nama" value="<?= $user["nama"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email </label>
                    <input class="form-control form-control-lg" type="text" name="email" id="email" value="<?= $user["email"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase">Password </label>
                    <input type="hidden" name="password_lama" id="password_lama" value="<?= $user["password"]; ?>">
                    <input class="form-control form-control-lg" type="password" name="password_baru" id="password" autocomplete="off">
                    <a style="font-size:x-small; color: #990000;">* Kosongkan Password Jika Tidak Ingin Diubah</a>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="no_hp">No.Hp </label>
                    <input class="form-control form-control-lg" type="text" name="no_hp" id="no_hp" value="<?= $user["no_hp"]; ?>">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="alamat">Alamat </label>
                    <input class="form-control form-control-lg" type="text" name="alamat" id="alamat" value="<?= $user["alamat"]; ?>">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="form-label text-sm text-uppercase" for="kategori">Level</label>
                    <select name="user_type" id="" class="form-control" id="user_type" required value="<?= $user['user_type'];?>">
                            <option value="admin">
                                admin
                            </option>
                            <option value="user">
                                user
                            </option>
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