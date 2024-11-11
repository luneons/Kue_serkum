<?php
// pages/hapusselected.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedItems'])) {
    foreach ($_POST['selectedItems'] as $itemId) {
        $koneksi->query("DELETE FROM tb_keranjang WHERE keranjang_id = '$itemId'");
    }
    echo "<script>
        alert('Item yang dipilih berhasil dihapus');
        window.location='?page=pages/keranjang';
    </script>";
} else {
    echo "<script>
        alert('Tidak ada item yang dipilih');
        window.location='?page=pages/keranjang';
    </script>";
}
?>
