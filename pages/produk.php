<style type="text/css">/* Preloader */
#preloder {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader {
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #3498db;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Search Model */
.search-model {
    background: rgba(0, 0, 0, 0.8);
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
}

.search-model .search-close-switch {
    color: #fff;
    font-size: 2rem;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 30px;
}

.search-model-form input {
    padding: 15px;
    width: 50%;
    background: #fff;
    border: none;
    border-radius: 25px;
    outline: none;
    font-size: 1rem;
    transition: all 0.3s;
}

.search-model-form input:focus {
    width: 70%;
}

/* Product Section */
.latest-products {
    background: #f7f8fa;
    padding: 60px 0;
}

.section-title h2 {
    color: #333;
    font-size: 2.5rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 40px;
    position: relative;
}

.section-title h2::after {
    content: "";
    width: 60px;
    height: 4px;
    background: #ff4b2b;
    position: absolute;
    left: 50%;
    bottom: -10px;
    transform: translateX(-50%);
}

/* Product Card */
.single-product-item {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}

.single-product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.single-product-item figure img {
    width: 100%;
    height: auto;
    transition: transform 0.3s;
}

.single-product-item:hover figure img {
    transform: scale(1.05);
}
/* Set ukuran tetap pada gambar produk */
.single-product-item figure img {
    width: 100%;           /* Lebar penuh dari kontainer */
    height: 280px;         /* Tinggi tetap untuk konsistensi */
    object-fit: cover;     /* Memotong gambar agar sesuai tanpa merusak proporsi */
    border-radius: 8px;    /* Memberikan border radius untuk tampilan lebih halus */
}


.product-text h6 {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
}

.product-text p {
    font-size: 1rem;
    color: #ff4b2b;
    font-weight: bold;
}
</style>
<!-- Search model -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here...">
        </form>
    </div>
</div>

<!-- Product Section -->
<section class="latest-products spad">
    <div class="container">
        <div class="product-filter">
            <div class="section-title text-center">
                <h2>Produk</h2>
            </div>
        </div>
        <ul class="nav justify-content-center nav-pills mb-5">
            <li class="nav-item"><a class="nav-link active" href="?page=pages/produk">Semua Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=pages/produk1">Kue Wedding</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=pages/produk2">Kue Ulang Tahun</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=pages/produk3">Kue Event</a></li>
        </ul>
        
        <div class="row" id="product-list">
            <?php
            $ambil = $koneksi->query("SELECT * FROM tb_produk");
            while ($pecah = $ambil->fetch_object()) {
            ?>
            <div class="col-lg-3 col-sm-6">
                <div class="single-product-item">
                    <figure>
                        <a href="?page=pages/detailproduk&id=<?= $pecah->produk_id ?>"><img src="admin/img/produk/<?php echo $pecah->produk_foto ?>" alt=""></a>
                    </figure>
                    <div class="product-text text-center">
                        <a href="?page=pages/detailproduk&id=<?= $pecah->produk_id ?>">
                            <h6><?php echo $pecah->produk_nama ?></h6>
                        </a>
                        <p>Rp. <?php echo number_format($pecah->produk_harga) ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
    