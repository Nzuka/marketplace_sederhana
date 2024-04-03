<?php
require '../function.php';
$id_pembayaran = $_GET["id"];
if(pembayaran_hapus($id_pembayaran) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='pembayaran.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='pembayaran.php';
    </script>
    ";
}
?>