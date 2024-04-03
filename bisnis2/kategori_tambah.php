<?php
require '../function.php';
include '../header2.php';

if(isset($_POST["submit"])){
        if(kategori_tambah($_POST) > 0){
                echo "
                <script>
                alert('data berhasil ditambahkan!');
                document.location.href='kategori_tabel.php';
                </script>
                ";
        }else {
                echo "
                <script>
                alert('data gagal ditambahkan!');
                document.location.href='kategori_tabel.php';
                </script>";
        }
}
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">+ Kategori</h1>
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
          <h2 class="h5 text-uppercase mb-4">+ Kategori</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post">
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama_kategori">Nama Kategori </label>
                    <input class="form-control form-control-lg" type="text" id="nama_kategori" name="nama_kategori">
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
      <?php
      include '../footer2.php';
      ?>