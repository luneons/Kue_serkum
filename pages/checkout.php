<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah pengguna sudah login
if (empty($_SESSION['register'])) {
    echo "<script>
        alert('Login Terlebih Dahulu');
        window.location='login.php';
        </script>";
    exit;
}

// Ambil id user dari session
$iduser = $_SESSION['register']['register_id'];

// Cek status pesanan terakhir di database
$statusPesanan = $koneksi->query("SELECT status FROM tb_checkout WHERE register_id = '$iduser' ORDER BY checkout_id DESC LIMIT 1");
$status = $statusPesanan->fetch_object();

// Jika pesanan terakhir belum diterima, beri peringatan dan sembunyikan tombol checkout
$bolehCheckout = true;
if ($status && $status->status !== 'sukses') {
    $bolehCheckout = false;
    echo "<script>alert('Pesanan sebelumnya belum diterima. Silakan konfirmasi pesanan terlebih dahulu.')</script>
    <script>window.location='?page=pages/checkout2';</script>";
}

// Menjalankan query untuk mendapatkan total bayar
$totalQuery = $koneksi->query("SELECT SUM(keranjang_harga * keranjang_jumlah) AS total 
                               FROM tb_keranjang 
                               WHERE register_id = '$iduser'");

$totalRow = $totalQuery->fetch_object();
$total = $totalRow->total ?? 0; // Menggunakan null coalescing operator
$_SESSION['total'] = $total;

?>
<style>
    .page-add {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
    }

    .page-breadcrumb h2 {
        font-size: 28px;
        color: #333;
        margin: 0;
    }

    .cart-total-page {
        margin: 20px 0;
        padding: 30px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .checkout-form {
        font-family: Arial, sans-serif;
    }

    .in-name {
        font-weight: bold;
        color: #555;
    }

    .order-table {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .primary-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .primary-btn:hover {
        background-color: #0056b3;
    }

    .cart-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    h4 {
        margin-bottom: 20px;
        color: #333;
    }
</style>

<!-- Page Add Section Begin -->
<section class="page-add">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="page-breadcrumb">
                    <h2>Checkout<span>.</span></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Add Section End -->

<!-- Cart Total Page Begin -->
<section class="cart-total-page spad">
    <div class="container">
        <form method="POST" class="checkout-form">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Data Pembeli</h3>
                </div>
                <div class="col-lg-9">
                    <!-- Customer Information Form -->
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">Nama</p></div>
                        <div class="col-lg-10"><input type="text" name="checkout_nama" required></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">Alamat Lengkap</p></div>
                        <div class="col-lg-10"><input type="text" name="checkout_alamat" required></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">No Hp</p></div>
                        <div class="col-lg-10"><input type="text" name="checkout_nohp" required pattern="\d{10,13}" title="Masukkan nomor HP yang valid (10-13 angka)"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">No Rek</p></div>
                        <div class="col-lg-10"><input type="text" name="checkout_norek" required pattern="\d{10,16}" title="Masukkan nomor rekening yang valid (10-16 angka)"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">Nama Rek</p></div>
                        <div class="col-lg-10"><input type="text" name="checkout_namarek" required></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><p class="in-name">Transfer ke Bank</p></div>
                        <div class="col-lg-10">
                            <select class="cart-select" name="checkout_transfer" required>
                                <option value="">Pilih Bank</option>
                                <option value="BRI">BRI - 050401000239300</option>
                                <option value="MANDIRI">MANDIRI - 0700001855555</option>
                                <option value="BNI">BNI - 0098888819</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="order-table">
                        <div class="cart-item">
                            <center><h4>Checkout</h4></center>
                            <h3>Total Bayar</h3>
                            <h4><b>Rp. <?php echo number_format($total) ?></b></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="submit" name="simpan" class="primary-btn">Checkout Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Cart Total Page End -->
<?php
if (isset($_POST['simpan'])) {
    // Validasi PHP
    $nama = $_POST['checkout_nama'];
    $alamat = $_POST['checkout_alamat'];
    $nohp = $_POST['checkout_nohp'];
    $norek = $_POST['checkout_norek'];
    $namarek = $_POST['checkout_namarek'];
    $transfer = $_POST['checkout_transfer'];

    // Cek apakah input kosong atau tidak valid
    if (!empty($nama) && !empty($alamat) && preg_match('/^\d{10,13}$/', $nohp) && preg_match('/^\d{10,16}$/', $norek) && !empty($namarek) && !empty($transfer)) {
        
        // Ambil item keranjang
        $keranjang = $koneksi->query("SELECT produk_id, keranjang_jumlah FROM tb_keranjang WHERE register_id = '$iduser'");
        
        $stokOk = true; // Flag untuk stok
        while ($item = $keranjang->fetch_object()) {
            $produk_id = $item->produk_id;
            $jumlah_dibeli = $item->keranjang_jumlah;

            // Periksa stok produk
            $produk = $koneksi->query("SELECT produk_stok FROM tb_produk WHERE produk_id = '$produk_id'")->fetch_object();
            if ($produk->produk_stok < $jumlah_dibeli) {
                $stokOk = false; // Stok tidak cukup
                break; // Hentikan pengecekan
            }
        }

        if ($stokOk) {
            // Jika semua stok tersedia, simpan ke session
            $_SESSION['info'] = [
                'nama' => $nama,
                'alamat' => $alamat,
                'nohp' => $nohp,
                'norek' => $norek,
                'nmrek' => $namarek,
                'tf' => $transfer,
                'tot' => $total
            ];

            echo "<script>alert('Checkout Berhasil, Silahkan Upload Bukti Bayar');</script>
                  <script>window.location='?page=pages/checkout1';</script>";
        } else {
            echo "<script>alert('Jumlah yang diminta melebihi stok yang tersedia.');</script>";
        }
    } else {
        echo "<script>alert('Mohon isi semua data dengan benar.');</script>";
    }
}
?>