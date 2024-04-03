<?php
require '../function.php';
$id_pengiriman = $_GET["id"];
if(pengiriman_hapus($id_pengiriman) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='pengiriman.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='pengiriman.php';
    </script>
    ";
}
?>