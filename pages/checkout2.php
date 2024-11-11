<!-- Page Add Section Begin -->
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-4">
            <div class="page-breadcrumb">
                <h2>Status<span>.</span></h2>
            </div>
        </div>
        <div class="col-lg-8">
        </div>
    </div>
</div>
<!-- Page Add Section End -->
<?php
// Check if a session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started yet
}

// Check if the 'id' key exists in the session
if (!isset($_SESSION['id'])) {
echo "<div class='text-center mt-5'>";
            echo "<h4>Kosong</h4>";
            echo "<a href='?page=pages/produk' class='btn btn-primary mt-3'>Mulai Belanja</a>";
            echo "</div>";
    exit; // Stop further execution
}

$id = $_SESSION['id'];

// Mengambil data checkout berdasarkan id pengguna
$result = $koneksi->query("SELECT * FROM tb_checkout WHERE checkout_id = '$id'");

if (!$result || $result->num_rows == 0) { // Jika tidak ada data checkout
    echo '<div class="container text-center mt-5">';
    echo '<h4>Pesanan Anda kosong. Buat pesanan sekarang!</h4>';
    echo '<a href="?page=pages/keranjang" class="btn btn-primary mt-3">Buat Pesanan</a>';
    echo '</div>';
} else {
    $data = $result->fetch_assoc(); // Fetch the data as an associative array

    // Continue with your existing code...
?>
    <!-- Cart Total Page Begin -->
    <section class="cart-total-page spad">
        <style type="text/css">
            .cart-total-page {
                background-color: #f8f9fa; /* Warna latar belakang */
                padding: 50px 0;
            }
            /* Rest of your styles... */
        </style>
        <div class="container text-center">
            <?php if ($data['status'] == 'konfirmasi') { ?>
                <h4>Order Sedang Dikonfirmasi Oleh Admin, Silahkan Tunggu!</h4>
                <img src="assets/img/home/wait.gif">
            <?php } elseif ($data['status'] == 'terima') { ?>
                <div class="received-status">
                    <h4 class="received-title">Order Telah Dikonfirmasi & Dalam Proses Pengiriman.</h4>
                    <img src="assets/img/home/kurir.gif" class="delivery-icon">
                    <h4 class="mt-3">Klik Tombol Dibawah ini, Jika Barang Telah Diterima!</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-success mt-3 received-button" name="save">Barang Sudah Diterima</button>
                    </form>
                </div>
            <?php } elseif ($data['status'] == 'sukses') { ?>
                <div class="thank-you-status">
                    <img src="assets/img/home/tengkiu.gif" class="thank-you-icon">
                    <h4 id="thank-you-message">Puspa Cake Decoration!</h4>
                    <div id="back-order" style="display: none;">
                        <a href="?page=pages/keranjang" class="btn btn-primary mt-3">Kembali Pesan >>></a>
                        <h4>Tidak ada pesanan, Ayo pesan kembali~</h4>
                    </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('thank-you-message').style.display = 'none';
                        document.getElementById('back-order').style.display = 'block';
                    }, 3000);
                </script>
            <?php } ?>
        </div>
    </section>
    <!-- Cart Total Page End -->
    <?php
    if (isset($_POST['save'])) {
        $simpan = $koneksi->query("UPDATE `tb_checkout` SET status = 'sukses' WHERE checkout_id = '$id'");

        if ($simpan == true) {
            echo "<script>window.location='?page=pages/checkout2';</script>";
        } else {
            echo "<script>window.location='?page=pages/checkout1';</script>";
        }
    }
}
?>
