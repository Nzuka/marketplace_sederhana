<?php
@include 'config.php';

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
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="csslogin1/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Registrasi</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="nama" required placeholder="Masukkan nama anda!">
      <input type="no_hp" name="no_hp" required placeholder="Konfirmasi Nomor Telepon anda!">
      <input type="alamat" name="alamat" required placeholder="Konfirmasi Alamat anda!">
      <input type="email" name="email" required placeholder="Masukkan email anda!">
      <input type="password" name="password" required placeholder="Masukkan password anda!">
      <input type="password" name="cpassword" required placeholder="Konfirmasi password anda!">
      <select name="user_type">
         <option value="user">user</option>
         <option value="bisnis">bisnis</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="registrasi sekarang" class="form-btn">
      <p>Sudah punya akun? <a href="index.php">Login</a></p>
   </form>

</div>

</body>
</html>