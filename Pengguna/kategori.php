<?php
include('../header.php');
require('function.php');

$id = isset($_POST['id']) ? $_POST['id'] : 'default';
$produk = array();

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

if(isset($_GET['keyword'])) {
  $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
  $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama_produk LIKE '%keyword%'");
} else if (isset($_GET['kategori'])) {
  $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);
  $queryGetKategoriId = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE nama_kategori = '$kategori'");
  $kategoriId = mysqli_fetch_array($queryGetKategoriId);

  $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id_kategori = '$kategoriId[id_kategori]' ");
} else {
  $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}
$countData = mysqli_num_rows($queryProduk);

switch ($id) {
  case 'terbaru';
  $produk = query("SELECT * FROM produk ORDER BY id_produk DESC");
  break;
  case 'termurah';
  $produk = query("SELECT * FROM produk ORDER BY harga_produk ASC");
  break;
  case 'termahal';
  $produk = query("SELECT * FROM produk ORDER BY harga_produk DESC");
  break;
  case 'default';
  $produk = query("SELECT * FROM produk");
  break;
}

?>

      <!--  Modal -->
      <?php $i=1 ?>
      <?php foreach ($produk as $row) : ?>
      <div class="modal fade" id="productView<?= $row["id_produk"]; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content overflow-hidden border-0">
            <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
              <div class="row align-items-stretch">
                <div class="col-lg-6 p-lg-0">
                <img class="img-fluid w-100" src="../img/<?= $row["foto_produk"]; ?>" alt="...">
                </div>
                <div class="col-lg-6">
                  <div class="p-4 my-md-4">
                    <ul class="list-inline mb-2">
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                    </ul>
                    <h2 class="h4"><?= $row["nama_produk"]; ?></h2>
                    <p class="text-muted"><?= $row["harga_produk"]; ?></p>
                    <p class="text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
                    <div class="row align-items-stretch mb-4 gx-0">
                      <div class="col-sm-7">
                      <div class="border d-flex align-items-center justify-content-between py-1 px-3">
                          <span class="small text-italic text-gray mr-4 no-select">Stok</span>
                          <div class="quantity">
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="<?= $row["stok_produk"]; ?>">
                          </div>
                        </div>
                        <div class="border d-flex align-items-center justify-content-between py-1 px-3">
                          <span class="small text-italic text-gray mr-4 no-select">Kuantitas</span>
                          <div class="quantity">
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5"><a class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0" href="detail.php?id_produk=<?=["id_produk"];?>">Keranjang</a></div>
                    </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i class="far fa-heart me-2"></i>Add to wish list</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php $i++; ?>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5"  style="background-image: url('https://store.sirclo.com/blog/wp-content/uploads/2022/12/beautiful-asian-woman-carrying-colorful-bags-shopping-online-with-mobile-phone_8087-3877.jpg'); background-size: cover; background-position: center;">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: #FFFFFF;">Belanja Sekarang</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
              <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item">
                      <form method="post" action="">

                  </form>
                  </li>
                    </ul>
                  </div>
                </div>
                <h5 class="text-uppercase mb-4" style="color: #379392;">Kategori</h5>
                <ul class="text-muted ps-lg-4 font-weight-normal" style="list-style-type: square;">
                  <?php 
                  while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a class="" href="kategori.php?kategori=<?php echo $kategori['nama_kategori']; ?>">
                    <li class="mb-2"><?php echo $kategori['nama_kategori']; ?></li>
                  <?php 
                } ?>        
                </ul>
                <h6 class="text-uppercase mb-3">Show only</h6>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" id="checkbox_1">
                  <label class="form-check-label" for="checkbox_1">Returns Accepted</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" id="checkbox_2">
                  <label class="form-check-label" for="checkbox_2">Returns Accepted</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" id="checkbox_3">
                  <label class="form-check-label" for="checkbox_3">Completed Items</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" id="checkbox_4">
                  <label class="form-check-label" for="checkbox_4">Sold Items</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="checkbox" id="checkbox_5">
                  <label class="form-check-label" for="checkbox_5">Deals &amp; Savings</label>
                </div>
                <div class="form-check mb-4">
                  <input class="form-check-input" type="checkbox" id="checkbox_6">
                  <label class="form-check-label" for="checkbox_6">Authorized Seller</label>
                </div>
                <h6 class="text-uppercase mb-3">Buying format</h6>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="radio" name="customRadio" id="radio_1">
                  <label class="form-check-label" for="radio_1">All Listings</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="radio" name="customRadio" id="radio_2">
                  <label class="form-check-label" for="radio_2">Best Offer</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="radio" name="customRadio" id="radio_3">
                  <label class="form-check-label" for="radio_3">Auction</label>
                </div>
                <div class="form-check mb-1">
                  <input class="form-check-input" type="radio" name="customRadio" id="radio_4">
                  <label class="form-check-label" for="radio_4">Buy It Now</label>
                </div>
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-sm text-muted mb-0"></p>
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item">
                      <form method="post" action="">

                  </form>
                  </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCT-->
                  <?php
                  if ($countData < 1) {
                  } else {
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                  ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-primary bg-"></div><a class="d-block" href="detail.php?id_produk=<?php echo $produk["id_produk"]; ?>"><img class="img-fluid w-100" src="../img/<?php echo $produk['foto_produk']; ?>" alt="..."></a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="detail.php?id_produk=<?php echo $produk["id_produk"]; ?>">Keranjang</a></li>
                            <li class="list-inline-item me-0"><a class="btn btn-sm btn-outline-dark" href="#productView<?php echo $produk["id_produk"]; ?>" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="detail.php"><?php echo $produk['nama_produk'] ?></a></h6>
                      <p class="small text-muted">Rp. <?php echo $produk['harga_produk'] ?></p>
                    </div>
                  </div>
                  <?php
                  }
                }
              ?>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php
include '../footer.php';
?>