<?php
require '../function.php';
$id_user = $_GET["id"];
if(pengguna_hapus($id_user) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='pengguna.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='pengguna.php';
    </script>
    ";
}
?>