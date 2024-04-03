<?php 
include '../header.php'; 
include('function.php');

$id_produk = $_GET['id_produk'];
$produk = query("SELECT * FROM produk WHERE id_produk=$id_produk")[0];
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
          <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
            <div class="swiper product-slider-thumbs">
              <div class="swiper-wrapper">
                <div class="swiper-slide h-auto swiper-thumb-item mb-3"><img class="w-100 h-100" src="images/<?= $barang['gambar_barang']; ?>" alt=""></div>
                <?php if (isset($barang['gambar_barang2']) && $barang['gambar_barang2'] != '') : ?>
                  <div class="swiper-slide h-auto swiper-thumb-item mb-3"><img class="w-100 h-100" src="images/<?= $barang['gambar_barang2']; ?>" alt=""></div>
                <?php endif; ?>
                <?php if (isset($barang['gambar_barang3']) && $barang['gambar_barang3'] != '') : ?>
                  <div class="swiper-slide h-auto swiper-thumb-item mb-3"><img class="w-100 h-100" src="images/<?= $barang['gambar_barang3']; ?>" alt=""></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-sm-10 order-1 order-sm-2">
            <div class="swiper product-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide h-auto"><a class="glightbox product-view" href="images/<?= $barang['gambar_barang']; ?>" data-gallery="gallery2" data-glightbox="Product item 1"><img class="w-100 h-100 img-fluid" src="images/<?= $barang['gambar_barang']; ?>" alt=""></a></div>
                <?php if (isset($barang['gambar_barang2']) && $barang['gambar_barang2'] != '') : ?>
                  <div class="swiper-slide h-auto"><a class="glightbox product-view" href="images/<?= $barang['gambar_barang2']; ?>" data-gallery="gallery2" data-glightbox="Product item 2"><img class="w-100 h-100 img-fluid" src="images/<?= $barang['gambar_barang2']; ?>" alt=""></a></div>
                <?php endif; ?>
                <?php if (isset($barang['gambar_barang3']) && $barang['gambar_barang3'] != '') : ?>
                  <div class="swiper-slide h-auto"><a class="glightbox product-view" href="images/<?= $barang['gambar_barang3']; ?>" data-gallery="gallery2" data-glightbox="Product item 3"><img class="w-100 h-100 img-fluid" src="images/<?= $barang['gambar_barang3']; ?>" alt=""></a></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- PRODUCT DETAILS-->
      <div class="col-lg-6">
        <ul class="list-inline mb-2 text-sm">
          <li class="list-inline-item m-0"><i class="fas fa-star fa-solid fa-star text-warning"></i></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star fa-solid fa-star text-warning"></i></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star fa-solid fa-star text-warning"></i></i></li>
          <li class="list-inline-item m-0"><i class="far fa-regular fa-star text-warning"></i></i></li>
          <li class="list-inline-item m-0"><i class="far fa-regular fa-star text-warning"></i></i></li>
        </ul>
        <h1><?= $barang["nama_barang"]; ?></h1>
        <p class="text-muted lead">IDR <?= $barang['harga_barang'] ?></p>
        <p class="text-sm mb-4"><?= $barang['deskripsi_barang'] ?></p>
        <div class="row align-items-stretch mb-4">
          <div class="col-sm-5 pr-sm-0">
            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span name="jumlah_barang" id="jumlah_barang" class="small text-uppercase text-gray mr-4 no-select">Kuantitas</span>
              <form action="" method="post">
                <div class="quantity">
                  <div class="row">
                    <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                    <input class="form-control border-0 shadow-0 p-0" type="text" name="jumlah_barang" id="jumlah_barang" value="1">
                    <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                  </div>
                </div>
                <input type="hidden" name="nama_barang" id="nama_barang" value="<?= $barang["nama_barang"]; ?>">
                <input type="hidden" name="gambar_barang" id="gambar_barang" value="<?= $barang['gambar_barang']; ?>">
                <input type="hidden" name="harga_barang" id="harga_barang" value="<?= $barang['harga_barang'] ?>">
            </div>
          </div>
          <div class="col-sm-3 pl-sm-0"><button type="submit" name="submit" class="btn btn-outline-dark btn-sm btn-block w-100 h-100 d-flex align-items-center justify-content-center px-0"><i class="fas fa-solid fa-cart-plus" style="color: #990000;"></i>&nbsp; Keranjang</button></div>
          <div class="col-sm-3 pl-sm-0"><button class="btn btn-dark btn-sm btn-block w-100 h-100 d-flex align-items-center justify-content-center px-0 text-white">Beli Sekarang</a></div>
          </form>
          <ul class="list-unstyled small d-inline-block">
            <li class="px-3 py-2 mt-2 text-muted"><strong class="text-uppercase text-dark">Tersisa:</strong><a class="reset-anchor ms-2" href="#!"><?= $barang['stok_barang'] ?> buah</a></li>
            <li class="px-3 py-2 text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ms-2" href="#!"><?= $kategori['nama_kategori'] ?></a></li>
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
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.html"><img class="img-fluid w-100" src="img/product-1.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">Kui Ye Chen’s AirPods</a></h6>
                <p class="small text-muted">$250</p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.html"><img class="img-fluid w-100" src="img/product-2.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">Air Jordan 12 gym red</a></h6>
                <p class="small text-muted">$300</p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.html"><img class="img-fluid w-100" src="img/product-3.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">Cyan cotton t-shirt</a></h6>
                <p class="small text-muted">$25</p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.html"><img class="img-fluid w-100" src="img/product-4.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">Timex Unisex Originals</a></h6>
                <p class="small text-muted">$351</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php include '../footer.php'; ?>