<?php 
include '../header.php'; 
include('function.php');

$id_produk = $_GET['id_produk'];
$produk = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];
$kategori = query("SELECT * FROM produk WHERE id_kategori = 'id_kategori'");
$produk1 = query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 8");

if(isset($_POST["submit"])){
        if(keranjang_tambah($_POST) > 0){
                echo "
                <script>
                alert('data berhasil ditambahkan!');

                </script>
                ";
        }else {
                echo "
                <script>
                alert('data gagal ditambahkan!');
                </script>";
        }
}
?>


      <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide h-auto"><a class="glightbox product-view" href="../img/<?= $produk['foto_produk']; ?>" data-gallery="gallery2" data-glightbox="Product item 1"><img class="img-fluid" src="../img/<?= $produk['foto_produk']; ?>" alt="..."></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
              <ul class="list-inline mb-2 text-sm">
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
              </ul>
              <h1><?= $produk["nama_produk"];?></h1>
              <p class="text-muted lead">Rp. <?= $produk["harga_produk"];?></p>
              <p class="text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
              <form action="" method="post">
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select" name="jumlah_produk" id="jumlah_produk">Quantity</span>
                    <div class="row">
                    <div class="quantity">
                      <input class="form-control border-0 shadow-0 p-0" name="jumlah_produk" id="jumlah_produk" type="text" value="1">
                    </div>
                    </div>
                  </div>
                </div>
                <input type="text" hidden="" name="id_toko" class="form-control" id="id_toko" name="id_toko" required value="<?= $produk['id_toko'];?>">
                <input type="text" hidden="" name="id_produk" class="form-control" id="id_produk" name="id_produk" required value="<?= $produk['id_produk'];?>">
                <input type="text" hidden="" name="id_pembayaran" class="form-control" id="id_pengiriman" name="id_pembayaran" required value="<?= $produk['id_pembayaran'];?>">
                <input type="text" hidden="" name="id_pengiriman" class="form-control" id="id_pengiriman" name="id_pengiriman" required value="<?= $produk['id_pengiriman'];?>">
                <input type="text" hidden="" name="id_user" class="form-control" id="id_user" required value="<?= $produk['id_user'];?>">
                <input type="text" hidden="" name="foto_produk" class="form-control" id="foto_produk" required value="<?= $produk['foto_produk'];?>">
                <input type="text" hidden="" name="nama_produk" class="form-control" id="nama_produk" required value="<?= $produk['nama_produk'];?>">
                <input type="text" hidden="" name="harga_produk" class="form-control" id="harga_produk" required value="<?= $produk['harga_produk'];?>">
                <div class="col-sm-3 pl-sm-0"><button class="btn btn-dark" name="submit">Keranjang</button></div>
                <div class="col-sm-3 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="checkout.php?id=<?php echo $produk['id_produk']; ?>">Beli</a></div>
                </div>
                </form>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Stok</span>
                    <div class="quantity">
                      <input class="form-control border-0 shadow-0 p-0" type="text" value="<?= $produk["stok_produk"];?>">
                    </div>
                  </div>
                </div>
              </div>
              <a class="text-dark p-0 mb-4 d-inline-block" href="#!"><i class="far fa-heart me-2"></i>Add to wish list</a><br>
              <ul class="list-unstyled small d-inline-block">
                <li hidden="" class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ms-2" href="#!"><?= $produk["id_toko"];?></a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Tags:</strong><a class="reset-anchor ms-2" href="#!">Innovation</a></li>
              </ul>
            </div>
          </div>
          <!-- DETAILS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">Product description </h6>
                <p class="text-muted text-sm mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="d-flex mb-3">
                      <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-1.png" alt="" width="50"/></div>
                      <div class="ms-3 flex-shrink-1">
                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                        <ul class="list-inline mb-1 text-xs">
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                        </ul>
                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-2.png" alt="" width="50"/></div>
                      <div class="ms-3 flex-shrink-1">
                        <h6 class="mb-0 text-uppercase">Jane Doe</h6>
                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                        <ul class="list-inline mb-1 text-xs">
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                        </ul>
                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- RELATED PRODUCTS-->
          <h2 class="h5 text-uppercase mb-4">Related products</h2>
          <div class="row">
            <!-- PRODUCT-->
            <?php foreach ($produk1 as $row) : ?>
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php?id_produk=<?= $row["id_produk"]; ?>"><img class="img-fluid w-100" src="../img/<?php echo $row['foto_produk']; ?>" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html"><?= $row["nama_produk"]; ?></a></h6>
                <p class="small text-muted"><?= $row["harga_produk"]; ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
      <?php include '../footer.php'; ?>