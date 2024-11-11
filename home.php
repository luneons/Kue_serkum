<!-- Search model end -->
<!-- Header Section Begin -->

<!-- Header Info Begin -->
<!-- Header End -->
<style type="text/css">/* General Styles */
body, html {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    scroll-behavior: smooth;
    background-color: #f4f6f9;
}

/* Hero Slider */
.hero-slider {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.hero-slider h1, .hero-slider h2 {
    color: #fff;
    font-size: 3rem;
    transition: transform 0.3s ease-in-out;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
}

.hero-slider h1:hover, .hero-slider h2:hover {
    transform: scale(1.1);
}

/* Features Section */
.features-section {
    background: linear-gradient(120deg, #f8f8f8, #ffffff);
    padding: 50px 0;
}

.features-ads .single-features-ads {
    text-align: center;
    padding: 30px;
    transition: transform 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #fff;
}

.features-ads .single-features-ads:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Products Section */
.latest-products {
    background-color: #ffffff;
    padding: 60px 0;
}

.single-product-item {
    transition: transform 0.3s;
}

.single-product-item:hover {
    transform: translateY(-10px);
}

.single-product-item figure {
    overflow: hidden;
    position: relative;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.single-product-item figure:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.single-product-item img {
    transition: transform 0.3s ease;
}

.single-product-item:hover img {
    transform: scale(1.1);
}

</style>
<!-- Hero Slider Begin -->
<section class="hero-slider">
    <div class="hero-items owl-carousel">
        <div class="single-slider-item set-bg" data-setbg="assets/img/home/home.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 style="color: black;"><i>Mila</i></h1>
                        <h2 style="color: black;"><i> Cake Shop</i></h2>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Hero Slider End -->

<!-- Features Section Begin -->
<section class="features-section spad">
    <div class="features-ads">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-features-ads first">
                        <img src="assets/img/icons/f-delivery.png" alt="">
                        <h4>Pengiriman</h4>
                        <p>Hanya menerima pemesanan atau pengiriman dalam Kabupaten Bekasi</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-features-ads second">
                        <img src="assets/img/icons/coin.png" alt="">
                        <h4>Uang Kembali</h4>
                        <p>Apabila ada kerusakaan saat produk telah sampai ke tujuan</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-features-ads">
                        <img src="assets/img/icons/chat.png" alt="">
                        <h4>Customer Services</h4>
                        <p>Silahkan bertanya atau memberi kritik saran kepada toko kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Box -->
    <div class="features-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="single-box-item first-box">
                        <img src="assets/img/home/cake1.JPG" height="600px">
                        <div class="box-text mt-5">
                            <h1 class="mt-5" style="color: white;">Decoration</h1>
                            <span class="trend-alert text-center">Terbaru</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="single-box-item large-box">
                            <img src="assets/img/home/cake2.jpg" height="600px">
                            <div class="box-text"><br>
                                <h2>TERJAMIN</h2>
                                <span class="trend-alert">Produk Berkualitas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Section End -->

<!-- Latest Product Begin -->
<section class="latest-products spad">
    <div class="container">
        <div class="product-filter">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section- title">
                        <h2>Produk Terbaru</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="product-list">
            <?php
            $ambil = $koneksi->query("SELECT * FROM tb_produk ORDER BY produk_id DESC LIMIT 4");
            while ($pecah = $ambil->fetch_object()) {
            ?>
                <div class="col-lg-3 col-sm-6 mix all dresses bags">
                    <div class="single-product-item">
                        <figure>
                            <a href="?page=pages/detailproduk&id= <?= $pecah->produk_id ?> "><img style="width:100%; height:280px" src="admin/img/produk/<?php echo $pecah->produk_foto ?>" alt=""></a>
                            <div class="p-status">new</div>
                        </figure>
                        <div class="product-text">
                            <a href=" ?page=pages/detailproduk&id= <?= $pecah->produk_id ?> ">
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

<!-- Latest Product End -->

<!-- Lookbok Section Begin -->
<section class=" lookbok-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-1">
                <div class="lookbok-left">
                    <div class="section-title">
                        <h2>Sejarah <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Singkat</h2>
                    </div>
                    <p>Mila Cake Decoration adalah usaha dekorasi kue yang berawal dari hobi dan kecintaan mendalam pada seni menghias kue. Berdiri di Indonesia, Mila Cake Decoration mulai dikenal karena kreasi unik dan kualitasnya dalam menghadirkan berbagai jenis dekorasi kue, mulai dari kue ulang tahun, pernikahan, hingga acara-acara spesial lainnya. Berawal dari usaha kecil di rumah, Mila Cake Decoration berkembang seiring dengan meningkatnya permintaan pelanggan akan kue-kue yang tidak hanya lezat tetapi juga menarik secara visual.

Mila Cake Decoration memadukan teknik dekorasi tradisional dengan sentuhan modern, menghasilkan kue yang tidak hanya cantik tapi juga memiliki cita rasa tinggi. Bahan-bahan berkualitas selalu menjadi prioritas untuk menjaga kelezatan dan kesehatan konsumennya. Melalui dedikasi dan kreativitas dalam setiap desain, Mila Cake Decoration terus menarik perhatian di kalangan pecinta kue dan menjadi salah satu pilihan utama dalam dekorasi kue di pasar lokal.

Dalam perjalanannya, Mila Cake Decoration juga telah mengadakan berbagai workshop dan pelatihan, menginspirasi banyak orang untuk mengembangkan keterampilan mereka dalam menghias kue. Dengan terus berinovasi dan mengikuti tren terbaru dalam dekorasi kue, Mila Cake Decoration berharap dapat melayani lebih banyak pelanggan dan mempertahankan posisinya sebagai salah satu pelopor di industri ini.</p>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 mt-3">
                <div class="mt-5">
                    <img src="assets/img/home/seje.jpg" height="550px">
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br>
<!-- Lookbok Section End -->