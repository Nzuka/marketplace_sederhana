<?php
require 'function.php';
$id_keranjang = $_GET["id_keranjang"];
if(keranjang_hapus($id_keranjang) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='cart.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='cart.php';
    </script>
    ";
}