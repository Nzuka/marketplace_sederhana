<?php
include '../header2.php';
@include '../config.php';

if(isset($_POST['submit'])){

   $nama = mysqli_real_escape_string($conn, $_POST['nama']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $no_hp = $_POST['no_hp'];
   $alamat = $_POST['alamat'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User sudah ada!';

   }else{

      if($pass != $cpass){
         $error[] = 'Pssword tidak sesuai!';
      }else{
         $insert = "INSERT INTO user(nama, email, password, user_type, no_hp, alamat) VALUES('$nama','$email','$pass','$user_type', '$no_hp', '$alamat')";
         mysqli_query($conn, $insert);
         header('location:pengguna.php');
      }
   }

};


?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">+ Pengguna</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                </nav>
              </div>
            </div>
          </div>
        </section>
        <form action="" method="post">
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">+ Pengguna</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="nama">Nama </label>
                    <input class="form-control form-control-lg" type="text" name="nama" id="nama">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="no_hp">No.HP </label>
                    <input class="form-control form-control-lg" type="text" id="no_hp" name="no_hp">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="alamat">Alamat </label>
                    <input class="form-control form-control-lg" type="text" id="alamat" name="alamat">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email </label>
                    <input class="form-control form-control-lg" type="email" id="email" name="email">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="password">Password </label>
                    <input class="form-control form-control-lg" type="password" id="password" name="password">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="password">Konfirmasi Password </label>
                    <input class="form-control form-control-lg" type="password" id="password" name="cpassword">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="level">Level</label>
                    <select name="user_type" id="user_type" class="form-control">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
        </form>
      </div>
      <?php
      include '../footer2.php';
      ?>