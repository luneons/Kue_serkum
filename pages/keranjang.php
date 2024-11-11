<?php
if (empty($_SESSION['register'])) {
    echo "<script>
        alert('Login Terlebih Dahulu')
        window.location='login.php'
        </script>";
}

// Add this section to handle removing all items
if (isset($_POST['remove_all'])) {
    $iduser = $_SESSION['register']['register_id'];
    $koneksi->query("DELETE FROM tb_keranjang WHERE register_id = '$iduser'");
    
}
?>

<!-- Page Add Section Begin -->
<section class="page-add cart-page-add">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="page-breadcrumb">
                    <h2>Keranjang<span>.</span></h2>
                    <a href="#">Beranda</a>
                    <a href="#">Keranjang</a>
                </div>
            </div>
            <div class="col-lg-8">
            </div>
        </div>
    </div>
</section>
<!-- Page Add Section End -->

<!-- Cart Page Section Begin -->
<div class="cart-page">
    <div class="container">
        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th class="product-h">Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    @$iduser = $_SESSION['register']['register_id'];
                    $ambil = $koneksi->query("SELECT * FROM tb_keranjang 
                                                INNER JOIN tb_produk ON tb_keranjang.produk_id = tb_produk.produk_id 
                                                INNER JOIN tb_register ON tb_keranjang.register_id = tb_register.register_id 
                                                WHERE tb_keranjang.register_id = '$iduser'");
                    $total = 0; // Initialize total
                    while ($pecah = $ambil->fetch_object()) {
                        $subtotal = $pecah->keranjang_harga * $pecah->keranjang_jumlah;
                    ?>
                        <tr>
                            <td class="product-col">
                                <img src="admin/img/produk/<?= $pecah->produk_foto ?>" alt="">
                            </td>
                            <td>
                                <div class="p-title">
                                    <h5><?= $pecah->keranjang_nama ?></h5>
                                </div>
                            </td>
                            <td class="price-col">Rp. <?= number_format($pecah->keranjang_harga) ?></td>
                            <td class="price-col">
                                <?= $pecah->keranjang_jumlah ?>
                            </td>
                            <td class="price-col">Rp. <?= number_format($subtotal) ?></td>
                            <td>
                                <a href="?page=pages/hapusker&idhapus=<?= $pecah->keranjang_id ?>" class="remove-item"><img src="admin/img/x.svg" width="29px" alt=""></a>
                            </td>
                        </tr>
                        <?php
                        $total += $subtotal; // Calculate total
                        ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="shopping-method">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="total-info">
                        <div class="total-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="total-cart">Total Belanja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="total"></td>
                                        <td class="sub-total"></td>
                                        <td class="shipping"></td>
                                        <td class="total-cart-p">Rp. <?= number_format($total) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <form method="POST" style="display: inline;">
                                    <button type="submit" name="remove_all" class="btn btn-danger">Hapus Semua</button>
                                </form>
                                
                                <!-- Disable checkout if there are no items or total is zero -->
                                <?php if ($total > 0): ?>
                                    <a href="?page=pages/checkout" class="primary-btn checkout-btn">Checkout</a>
                                <?php else: ?>
                                    <button class="primary-btn checkout-btn" disabled>Checkout</button>
                                <?php endif; ?>
                            </div>
                            <?php $_SESSION['total'] = $total; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page Section End -->

<!-- Add some CSS for styling -->
<style>
    .cart-page {
        padding: 50px 0;
        background-color: #f8f9fa;
    }

    .cart-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table thead {
        background-color: #343a40;
        color: #fff;
    }

    .cart-table th, .cart-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .product-col img {
        width: 80px;
        height: auto;
    }

    .price-col {
        font-weight: bold;
    }

    .remove-item img {
        cursor: pointer;
    }

    .shopping-method {
        margin-top: 30px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .total-info {
        text-align: right;
    }

    .primary-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .primary-btn:hover:not(:disabled) {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .checkout-btn:disabled {
        background-color: #6c757d; /* Grey color for disabled */
        cursor: not-allowed;
    }
</style>
