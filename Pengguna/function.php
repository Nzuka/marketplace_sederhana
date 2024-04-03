<?php
$conn = mysqli_connect("localhost", "root", "", "sena_store");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function profiluser1($data){
    global $conn;
    $id = $data["id_user"];
    $nama = htmlspecialchars($conn, $data['nama']);
    $email = htmlspecialchars($conn, $data['email']);
    $password_lama = mysqli_real_escape_string($conn, $data['password_lama']);
    $password_baru = htmlspecialchars($conn, $data['password_baru']);
    $no_hp = htmlspecialchars($conn, $data['no_hp']);

    if ($password_baru) {
        $password_user = password_hash($password_baru, PASSWORD_DEFAULT);
    } else {
        $password_user = $password_lama;
    }

    $query = "UPDATE user SET
    nama = '$nama',
    email = '$email',
    password = '$password'
    WHERE id_user = $id
    ";

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}
return mysqli_affected_rows($conn);
}

function profiluser($data){
    global $conn;
    $id = $data["id_user"];
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $password = stripcslashes($data['password']);
    $no_hp = htmlspecialchars($data['no_hp']);

    $query = "UPDATE user SET
    nama = '$nama',
    email = '$email',
    no_hp = '$no_hp',
    password = '$password'
    WHERE id_user = $id
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

 //Tabel Produk
 function keranjang_tambah($data){
    global $conn;
    $foto_produk = htmlspecialchars($data["foto_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $jumlah_produk = $data["jumlah_produk"];
    $id_user = $data["id_user"];
    $id_toko = $data["id_toko"];
    $id_produk = $data["id_produk"];
    $id_pengiriman = $data["id_pengiriman"];
    $id_pembayaran = $data["id_pembayaran"];

    $total_produk = $harga_produk * $jumlah_produk;

    $query = "INSERT INTO keranjang (foto_produk, nama_produk, harga_produk, jumlah_produk, total_produk, id_user, id_toko, id_produk, id_pengiriman, id_pembayaran) 
    VALUES
    ('$foto_produk', '$nama_produk','$harga_produk', '$jumlah_produk', '$total_produk', '$id_user', '$id_toko', '$id_produk', '$id_pengiriman', '$id_pembayaran')";

mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}

function keranjang_hapus($id_keranjang){
    global $conn;
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = $id_keranjang");
    return mysqli_affected_rows($conn);
    }

function cari($keyword){
    $query = "SELECT * FROM produk
    WHERE
    nama_produk LIKE '$keyword%' OR
    harga_produk LIKE '%$keyword%'
    ";
    return query($query);
    }

    //Pesanan
    function pesanan_tambah($data) {  
        global $conn;
        
        $id_produk = htmlspecialchars($data["id_produk"]);
        $id_user = htmlspecialchars($data["id_user"]);
        $id_toko = htmlspecialchars($data["id_toko"]);
        $invoice = htmlspecialchars($data["invoice"]);
        $harga_produk = floatval($data["harga_produk"]);
        $jumlah_produk = floatval($data["jumlah_produk"]);
        $tgl_pending = htmlspecialchars($data["tgl_pending"]);
        $id_pengiriman = htmlspecialchars($data["id_pengiriman"]);
        $id_pembayaran = htmlspecialchars($data["id_pembayaran"]);
        $status = htmlspecialchars($data["status"]);
        $pesan = htmlspecialchars($data["pesan"]);
        
        $produk = "SELECT harga_produk FROM produk WHERE id_produk = $id_produk";
        $result_produk = mysqli_query($conn, $produk);
        $row_produk = mysqli_fetch_assoc($result_produk);
        $harga_produk = $row_produk['harga_produk'];

        $pembayaran = "SELECT biaya_pembayaran FROM pembayaran WHERE id_pembayaran = $id_pembayaran";
        $result_pembayaran = mysqli_query($conn, $pembayaran);
        $row_pembayaran = mysqli_fetch_assoc($result_pembayaran);
        $biaya_pembayaran = $row_pembayaran['biaya_pembayaran'];
    
        $pengiriman = "SELECT harga_pengiriman FROM pengiriman WHERE id_pengiriman = $id_pengiriman";
        $result_pengiriman = mysqli_query($conn, $pengiriman);
        $row_pengiriman = mysqli_fetch_assoc($result_pengiriman);
        $harga_pengiriman = $row_pengiriman['harga_pengiriman'];
    
        $total_harga = $harga_pengiriman + $biaya_pembayaran + ($jumlah_produk * $harga_produk);
    
        $produk = "SELECT stok_produk FROM produk WHERE id_produk = $id_produk";
        $result_produk = mysqli_query($conn, $produk);
        $row_produk = mysqli_fetch_assoc($result_produk);
        $stok_produk = $row_produk['stok_produk'];
    
        mysqli_query($conn, "UPDATE produk SET stok_produk = $stok_produk - $jumlah_produk WHERE id_produk = $id_produk");
        // Masukkan data pesanan ke dalam tabel pesanan
        $query = "INSERT INTO pesanan (id_produk, id_user, id_toko, invoice, pesan, tgl_pending, id_pengiriman, status, total_harga, id_pembayaran) 
        VALUES ('$id_produk', '$id_user', '$id_toko', '$invoice', '$pesan', '$tgl_pending', '$id_pengiriman', '$status', '$total_harga', '$id_pembayaran')";
    
        
        $result = mysqli_query ($conn, $query);
        return mysqli_affected_rows($conn);
        }

?>
