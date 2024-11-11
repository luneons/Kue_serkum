<?php
$id = $_GET['id'];

$data = $koneksi->query("SELECT * FROM tb_produk WHERE produk_id = '$id'")->fetch_object();
?>
<style type="text/css">/* Hero Section */
.page-add {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: white;
    padding: 50px 0;
    text-align: center;
}

.page-breadcrumb h2 {
    color: white;
    font-size: 2.5rem;
}

.page-breadcrumb a {
    color: #f0f0f0;
    font-weight: bold;
    text-transform: uppercase;
}

.page-breadcrumb a:hover {
    color: #ffffff;
    text-decoration: underline;
}

/* Product Section */
.product-page {
    padding: 60px 0;
}

.product-slider {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.product-img figure {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.product-img figure:hover {
    transform: scale(1.05);
}

.product-content h2 {
    font-size: 2rem;
    color: #333;
}

.pc-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 15px;
}

.pc-meta h5 {
    color: #ff4b2b;
    font-weight: bold;
    font-size: 1.8rem;
}

.rating i {
    color: #ffb400;
}

.rating i:hover {
    color: #ff4b2b;
    cursor: pointer;
}

/* Quantity and Button */
.product-quantity .pro-qty input {
    width: 60px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px;
    margin: 0 5px;
    font-size: 1rem;
}

.primary-btn {
    padding: 10px 30px;
    font-size: 1rem;
    color: white;
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    border-radius: 25px;
    text-transform: uppercase;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.primary-btn:hover {
    background: linear-gradient(45deg, #ff4b2b, #ff416c);
    transform: translateY(-3px);
}

/* Tags Section */
.tags li {
    font-size: 0.9rem;
    color: #666;
    padding: 5px;
    border-radius: 5px;
    display: inline-block;
    margin-right: 10px;
    background-color: #f1f1f1;
}

.tags li span {
    font-weight: bold;
    color: #333;
}
</style>
<!-- Page Add Section Begin -->
<section class="page-add">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-breadcrumb">
                    <h2>Detail Produk<span>.</span></h2>
                    <a href="#">Beranda</a>
                    <a href="#">Detail Produk</a>
                </div>
            </div>
            <div class="col-lg-8">
            </div>
        </div>
    </div>
</section>
<!-- Page Add Section End -->

<!-- Product Page Section Begin -->
<section class="product-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-slider owl-carousel">
                    <div class="product-img">
                        <figure>
                            <img style="" src="admin/img/produk/<?php echo $data->produk_foto ?>" alt="" class="img-fluid">
                        </figure>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <form action="" method="POST">
                    <div class="product-content">
                        <input type="hidden" name="produk_id" value="<?php echo $data->produk_id; ?>">
                        <h2><?php echo $data->produk_nama ?></h2>
                        <div class="pc-meta">
                            <h5>Rp. <?php echo number_format($data->produk_harga) ?></h5>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p><?php echo $data->produk_detail ?></p>
                        <ul class="tags">
                            <li><span>Stok : </span><?php echo $data->produk_stok ?></li>
                            <li><span>Kategori : </span><?php echo $data->produk_kat ?></li>
                        </ul>
                        <div class="product-quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" name="keranjang_jumlah">
                            </div>
                        </div>
                        <button type="submit" name="simpan" class="primary-btn pc-btn">Tambah Keranjang</button>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $id = $data->produk_id;
                    $register_id = $_SESSION['register']['register_id'];
                    $keranjang_nama = $data->produk_nama;
                    $keranjang_harga = $data->produk_harga;
                    $keranjang_jumlah = $_POST['keranjang_jumlah'];
                    $keranjang_foto = $data->produk_foto;

                    // Cek apakah jumlah yang diminta melebihi stok
                    if ($keranjang_jumlah > $data->produk_stok) {
                        echo "<script>alert('Jumlah yang diminta melebihi stok yang tersedia.')</script>";
                    } else {
                        // Saat menyimpan item baru ke keranjang
                        $simpan = $koneksi->query("INSERT INTO tb_keranjang(register_id, keranjang_nama, keranjang_harga, keranjang_jumlah, keranjang_foto, produk_id, selected) 
                        VALUES ('$register_id', '$keranjang_nama', '$keranjang_harga', '$keranjang_jumlah', '$keranjang_foto', '$id', 1)");

                        if ($simpan) {
                            echo "
                            <script>window.location='?page=pages/keranjang'</script>
                            ";
                        } else {
                            echo "
                            <script>alert('Tambah Keranjang Gagal')</script>
                            <script>window.location='?page=pages/keranjang'</script>
                            ";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <br><br><br>
</section>
<!-- Product Page Section End -->
