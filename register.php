<!DOCTYPE html>
<html lang="en">
<?php
include "admin/components/koneksi.php";
?>

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/icons/favicon2.ico" />
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>

<style>
/* Apply the same custom styles from login page */
:root {
    --background: #1a1a2e;
    --color: #ffffff;
    --primary-color: #0f3460;
}
body {
    background-color: var(--background);
    color: var(--color);
    font-family: "poppins";
    letter-spacing: 1px;
}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.login-container {
    position: relative;
    width: 22.2rem;
}
.form-container {
    border: 1px solid hsla(0, 0%, 65%, 0.158);
    box-shadow: 0 0 36px 1px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 2rem;
    backdrop-filter: blur(20px);
}
.form-container h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    opacity: 0.6;
}
.form-container input,
.form-container button {
    display: block;
    width: 100%;
    margin: 1rem 0;
    padding: 14.5px;
    border-radius: 5px;
    border: none;
    background-color: rgba(145, 145, 145, 0.1);
    color: var(--color);
    font-size: 15px;
    letter-spacing: 0.8px;
}
.form-container button {
    background-color: var(--primary-color);
    font-weight: bold;
    cursor: pointer;
}
</style>

<body>
    <section class="container">
        <div class="login-container">
            <div class="form-container">
                <h1>REGISTER</h1>
                <form method="POST" action="">
                    <input type="text" name="register_username" placeholder="Masukkan Nama Lengkap" required />
                    <input type="email" name="register_email" placeholder="Masukkan Email" required />
                    <input type="password" name="register_password" placeholder="Masukkan Password" required />
                    <button type="submit" name="register">DAFTAR</button>
                </form>
                <div class="register-forget">
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['register'])) {
        $register_username = $_POST['register_username'];
        $register_email = $_POST['register_email'];
        $register_password = $_POST['register_password'];

        $register = $koneksi->query("INSERT INTO tb_register (register_username, register_email, register_password) VALUES ('$register_username','$register_email','$register_password')");

        if ($register) {
            echo "<script>alert('Register Berhasil'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Register Gagal'); window.location='register.php';</script>";
        }
    }
    ?>

    <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
