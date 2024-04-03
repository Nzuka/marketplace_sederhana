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

    $id_user = $data["id_user"];
    $nama = htmlspecialchars($data['nama']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);
    $user_type = htmlspecialchars($data['user_type']);
    $fotoLama = htmlspecialchars($data['fotoLama']);

    // Mengambil password lama dan baru tanpa pengolahan khusus
    $password_lama = $data['password_lama'];
    $password_baru = $data['password_baru'];

    // Hash password baru jika ada
    if ($password_baru) {
        $password = password_hash($password_baru, PASSWORD_DEFAULT);
    } else {
        $password = $password_lama;
    }

    // Mengunggah foto baru jika ada, jika tidak, gunakan foto lama
    if($_FILES['foto_profil']['error'] === 4 ){
        $foto_profil = $fotoLama;
    } else {
        $foto_profil = upload(); // Anda perlu mendefinisikan fungsi upload()
    }

    // Menyiapkan query SQL
    $query = "UPDATE user SET
        nama = '$nama',
        no_hp = '$no_hp',
        alamat = '$alamat',
        email = '$email',
        user_type = '$user_type',
        foto_profil = '$foto_profil',
        password = '$password'
        WHERE id_user = $id_user
    ";

    // Menjalankan query SQL
    mysqli_query($conn, $query);

    // Mengembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($conn);
}

// Penjual 
function penjual_tambah($data){
    global $conn;

    // Periksa apakah kunci "nama_toko" ada dalam array $data
    if(isset($data["nama_toko"])) {
        $id_user = $data["id_user"];
        $nama_toko = stripcslashes($data["nama_toko"]);
        $alamat_toko = stripcslashes($data["alamat_toko"]);
        $hp_toko = stripcslashes($data["hp_toko"]);
        
        $query = "INSERT INTO toko (id_user, nama_toko, alamat_toko, hp_toko) 
        VALUES
        ('$id_user', '$nama_toko', '$alamat_toko', '$hp_toko')";

        $result = mysqli_query ($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        // Tanggapan jika kunci "nama_toko" tidak ditemukan dalam array
        echo "Kunci 'nama_toko' tidak ditemukan dalam array";
        return false;
    }
}

function toko_ubah($data){
    global $conn;

    $id_toko = $data["id_toko"];
    $nama_toko = htmlspecialchars($data['nama_toko']);
    $hp_toko = htmlspecialchars($data['hp_toko']);
    $alamat_toko = htmlspecialchars($data['alamat_toko']);
    $fotoLama = htmlspecialchars($data['fotoLama']);

    if($_FILES['foto_toko']['error'] === 4 ){
        $foto_toko = $fotoLama;
    }else {
        $foto_toko = upload();
    }

    $query = "UPDATE toko SET
    nama_toko = '$nama_toko',
    hp_toko = '$hp_toko',
    alamat_toko = '$alamat_toko',
    foto_toko = '$foto_toko'
    WHERE id_toko = $id_toko
    ";

mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}

function toko_hapus($id_toko){
    global $conn;
    mysqli_query($conn, "DELETE FROM toko WHERE id_toko = $id_toko");
    return mysqli_affected_rows($conn);
    }

 // Keranjang
 function keranjang_tambah($data){
    global $conn;
    $foto_produk = htmlspecialchars($data["foto_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $jumlah_produk = $data["jumlah_produk"];
    $id_user = $data["id_user"];

    $total_produk = $harga_produk * $jumlah_produk;

    $query = "INSERT INTO keranjang (foto_produk, nama_produk, harga_produk, jumlah_produk, total_produk, id_user) 
    VALUES
    ('$foto_produk', '$nama_produk','$harga_produk', '$jumlah_produk', '$total_produk', '$id_user')";

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

// Produk
    function produk_tambah($data){
        global $conn;
        $nama_produk = htmlspecialchars($data["nama_produk"]);
        $harga_produk = htmlspecialchars($data["harga_produk"]);
        $berat_produk = htmlspecialchars($data["berat_produk"]);
        $stok_produk = htmlspecialchars($data["stok_produk"]);
        $id_toko = $data["id_toko"];
        $id_user = $data["id_user"];
        $id_kategori = $data["id_kategori"];


        //upload foto
        $foto_produk = upload();
        if( !$foto_produk ){
            return false;
        }
        
        $query = "INSERT INTO produk (foto_produk, nama_produk, harga_produk, berat_produk, stok_produk, id_kategori, id_toko, id_user) 
        VALUES
        ('$foto_produk', '$nama_produk','$harga_produk', '$berat_produk', '$stok_produk', '$id_kategori', '$id_toko', '$id_user')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function upload(){
        if(isset($_FILES['foto_produk'])) {
            $namaFile = $_FILES['foto_produk']['name'];
            $ukuranFile = $_FILES['foto_produk']['size'];
            $error = $_FILES['foto_produk']['error'];
            $tmpName = $_FILES['foto_produk']['tmp_name'];
    
            $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
            $ekstensiFoto = pathinfo($namaFile, PATHINFO_EXTENSION);
            $ekstensiFoto = strtolower($ekstensiFoto);
    
            if (!in_array($ekstensiFoto, $ekstensiFotoValid)){
                echo "<script>
                alert('File anda tidak berupa foto!');
                </script>";
                return false;
            }
    
            if ($ukuranFile > 1000000){
                echo "<script>
                alert('File anda terlalu besar!');
                </script>";
                return false;
            }
    
            // Memuat gambar ke dalam memori berdasarkan ekstensi
            if ($ekstensiFoto == 'jpg' || $ekstensiFoto == 'jpeg') {
                $image = imagecreatefromjpeg($tmpName);
            } elseif ($ekstensiFoto == 'png') {
                $image = imagecreatefrompng($tmpName);
            } else {
                // Tidak ada dukungan untuk ekstensi selain jpg/jpeg/png
                echo "<script>
                alert('Ekstensi gambar tidak didukung!');
                </script>";
                return false;
            }
    
            // Dimensi yang diinginkan untuk gambar yang dipangkas
            $newWidth = 1920; // Ubah sesuai kebutuhan
            $newHeight = 1920; // Ubah sesuai kebutuhan
    
            // Memangkas gambar
            $resizedImage = imagescale($image, $newWidth, $newHeight);
    
            // Simpan gambar yang dipangkas
            $namaFileBaru = uniqid() . '.' . $ekstensiFoto;
            $lokasiFileBaru = '../img/' . $namaFileBaru;
            if ($ekstensiFoto == 'jpg' || $ekstensiFoto == 'jpeg') {
                imagejpeg($resizedImage, $lokasiFileBaru);
            } elseif ($ekstensiFoto == 'png') {
                imagepng($resizedImage, $lokasiFileBaru);
            }
    
            // Hapus gambar dari memori
            imagedestroy($image);
            imagedestroy($resizedImage);
    
            return $namaFileBaru;
        }
    }

function produk_ubah($data){
    global $conn;

    $id_produk = $data["id_produk"];
    $nama_produk = htmlspecialchars($data['nama_produk']);
    $harga_produk = htmlspecialchars($data['harga_produk']);
    $berat_produk = htmlspecialchars($data['berat_produk']);
    $stok_produk = htmlspecialchars($data['stok_produk']);
    $fotoLama = htmlspecialchars($data['fotoLama']);

    if($_FILES['foto_produk']['error'] === 4 ){
        $foto_produk = $fotoLama;
    }else {
        $foto_produk = upload();
    }

    $query = "UPDATE produk SET
    nama_produk = '$nama_produk',
    harga_produk = '$harga_produk',
    berat_produk = '$berat_produk',
    stok_produk = '$stok_produk',
    foto_produk = '$foto_produk'
    WHERE id_produk = $id_produk
    ";

mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}

function produk_hapus($id_produk){
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
    return mysqli_affected_rows($conn);
    }

    //pesanan
    function pesanan_ubah($data){
        global $conn;
    
        $id_pesanan = $data["id_pesanan"];
        $tgl_dikemas = htmlspecialchars($data['tgl_dikemas']);
        $tgl_dikirim = htmlspecialchars($data['tgl_dikirim']);
        $status = htmlspecialchars($data['status']);
    
        $query = "UPDATE pesanan SET
        tgl_dikemas = '$tgl_dikemas',
        tgl_dikirim = '$tgl_dikirim',
        status= '$status'
        WHERE id_pesanan = $id_pesanan
        ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function pesanan_hapus($id_pesanan){
        global $conn;
        mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan");
        return mysqli_affected_rows($conn);
        }

    //Pengguna
    function pengguna_ubah($data){
        global $conn;
    
        $id_user = $data["id_user"];
        $nama = htmlspecialchars($data['nama']);
        $no_hp = htmlspecialchars($data['no_hp']);
        $alamat = htmlspecialchars($data['alamat']);
        $email = htmlspecialchars($data['email']);
        $user_type = htmlspecialchars($data['user_type']);
        $fotoLama = htmlspecialchars($data['fotoLama']);
    
        // Mengambil password lama dan baru tanpa pengolahan khusus
        $password_lama = $data['password_lama'];
        $password_baru = $data['password_baru'];
    
        // Hash password baru jika ada
        if ($password_baru) {
            $password = password_hash($password_baru, PASSWORD_DEFAULT);
        } else {
            $password = $password_lama;
        }
    
        // Mengunggah foto baru jika ada, jika tidak, gunakan foto lama
        if($_FILES['foto_profil']['error'] === 4 ){
            $foto_profil = $fotoLama;
        } else {
            $foto_profil = upload(); // Anda perlu mendefinisikan fungsi upload()
        }
    
        // Menyiapkan query SQL
        $query = "UPDATE user SET
            nama = '$nama',
            no_hp = '$no_hp',
            alamat = '$alamat',
            email = '$email',
            user_type = '$user_type',
            foto_profil = '$foto_profil',
            password = '$password'
            WHERE id_user = $id_user
        ";
    
        // Menjalankan query SQL
        mysqli_query($conn, $query);
    
        // Mengembalikan jumlah baris yang terpengaruh
        return mysqli_affected_rows($conn);
    }

    function pengguna_hapus($id_user){
        global $conn;
        mysqli_query($conn, "DELETE FROM user WHERE id_user = $id_user");
        return mysqli_affected_rows($conn);
        }

        // Kategori
    function kategori_tambah($data){
        global $conn;
        $nama_kategori = htmlspecialchars($data["nama_kategori"]);
        
        $query = "INSERT INTO kategori (nama_kategori) 
        VALUES
        ('$nama_kategori')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function kategori_hapus($id_kategori){
        global $conn;
        mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id_kategori");
        return mysqli_affected_rows($conn);
        }

    // Pengiriman
    function pengiriman_tambah($data){
        global $conn;
        $nama_pengiriman = htmlspecialchars($data["nama_pengiriman"]);
        $harga_pengiriman = htmlspecialchars($data["harga_pengiriman"]);
        
        $query = "INSERT INTO pengiriman (nama_pengiriman, harga_pengiriman) 
        VALUES
        ('$nama_pengiriman', '$harga_pengiriman')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function pengiriman_ubah($data){
        global $conn;
    
        $id_pengiriman = $data["id_pengiriman"];
        $nama_pengiriman = htmlspecialchars($data['nama_pengiriman']);
        $harga_pengiriman = htmlspecialchars($data['harga_pengiriman']);
    
        $query = "UPDATE pengiriman SET
        nama_pengiriman = '$nama_pengiriman',
        harga_pengiriman = '$harga_pengiriman'
        WHERE id_pengiriman = $id_pengiriman
        ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }
    function pengiriman_hapus($id_pengiriman){
        global $conn;
        mysqli_query($conn, "DELETE FROM pengiriman WHERE id_pengiriman = $id_pengiriman");
        return mysqli_affected_rows($conn);
        }
    
        // Pembayaran
    function pembayaran_tambah($data){
        global $conn;
        $nama_pembayaran = htmlspecialchars($data["nama_pembayaran"]);
        $biaya_pembayaran = htmlspecialchars($data["biaya_pembayaran"]);
        
        $query = "INSERT INTO pembayaran (nama_pembayaran, biaya_pembayaran) 
        VALUES
        ('$nama_pembayaran', '$biaya_pembayaran')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function pembayaran_ubah($data){
        global $conn;
    
        $id_pembayaran = $data["id_pembayaran"];
        $nama_pembayaran = htmlspecialchars($data['nama_pembayaran']);
        $biaya_pembayaran = htmlspecialchars($data['biaya_pembayaran']);
    
        $query = "UPDATE pembayaran SET
        nama_pembayaran = '$nama_pembayaran',
        biaya_pembayaran = '$biaya_pembayaran'
        WHERE id_pembayaran = $id_pembayaran
        ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

    function pembayaran_hapus($id_pembayaran){
        global $conn;
        mysqli_query($conn, "DELETE FROM pembayaran WHERE id_pembayaran = $id_pembayaran");
        return mysqli_affected_rows($conn);
        }

?>
