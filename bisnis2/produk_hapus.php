<?php
require '../function.php';
$id_produk = $_GET["id"];
if(produk_hapus($id_produk) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='toko.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='toko.php';
    </script>
    ";
}
?>