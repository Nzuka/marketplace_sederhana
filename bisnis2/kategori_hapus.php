<?php
require '../function.php';
$id_kategori = $_GET["id"];
if(kategori_hapus($id_kategori) > 0) {
   echo "
   <script>
   alert('data berhasil dihapus!');
   document.location.href='kategori_tabel.php';
   </script>
   ";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href='kategori_tabel.php';
    </script>
    ";
}
?>