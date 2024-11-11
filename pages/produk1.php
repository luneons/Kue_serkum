<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kue</title>
    <style>
        /* Preloader */
        #preloder {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            background-color: #fff;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }
        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #3498db;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Search model */
        .search-model {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }
        .search-model-form input {
            padding: 10px;
            width: 50%;
            border: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .search-close-switch {
            font-size: 30px;
            color: white;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        /* Product Section */
        .latest-products {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        .section-title h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .nav-pills .nav-link {
            color: #333;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 5px;
        }
        .nav-pills .nav-link.active {
            background-color: #3498db;
            color: #fff;
        }
        .single-product-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            text-align: center;
        }
        .single-product-item:hover {
            transform: translateY(-10px);
        }
        .single-product-item figure img {
            border-radius: 8px;
        }
        .product-text h6 {
            margin: 15px 0 10px;
            font-size: 18px;
            font-weight: 600;
        }
        .product-text p {
            font-size: 16px;
            color: #e74c3c;
        }
    </style>
</head>
<body>

<!-- Page Preloader -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Search Model -->
<div class="search-model" id="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch" onclick="toggleSearchModel()">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>

<!-- Latest Products Section -->
<section class="latest-products spad">
    <div class="container">
        <div class="product-filter">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Kue Wedding</h2>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav justify-content-center nav-pills mb-5">
            <li class="nav-item">
                <a class="nav-link" href="?page=pages/produk">Semua Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?page=pages/produk1">Kue Wedding</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=pages/produk2">Kue Ulang Tahun</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=pages/produk3">Kue Event</a>
            </li>
        </ul>

        <div class="row" id="product-list">
            <?php
            $ambil = $koneksi->query("SELECT * FROM tb_produk WHERE produk_kat = 'Kue Wedding'");
            while ($pecah = $ambil->fetch_object()) {
            ?>
                <div class="col-lg-3 col-sm-6 mix all accesories bags">
                    <div class="single-product-item">
                        <figure>
                            <a href="?page=pages/detailproduk&id=<?= $pecah->produk_id ?>"><img style="width:100%; height:280px" src="admin/img/produk/<?php echo $pecah->produk_foto ?>" alt=""></a>
                        </figure>
                        <div class="product-text">
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

<script>
    // Preloader
    window.onload = function() {
        document.getElementById("preloder").style.display = "none";
    };

    // Search model toggle
    function toggleSearchModel() {
        const searchModel = document.getElementById("search-model");
        searchModel.style.display = searchModel.style.display === "none" || !searchModel.style.display ? "flex" : "none";
    }
</script>

</body>
</html>
