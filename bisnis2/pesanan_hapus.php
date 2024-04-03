<?php
require '../function.php';
$id_pesanan = $_GET["id"];
if(pesanan_hapus($id_pesanan) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='pesanan.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='pesanan.php';
    </script>
    ";
}
?>