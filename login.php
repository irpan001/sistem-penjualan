
<!DOCTYPE html>
<html lang="en">
<?php
// deklarasi parameter koneksi database
$server   = "localhost";
$username = "root";
$password = "";
$database = "shop_db";

// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : '.$mysqli->connect_error);
}
?>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sistem Informasi Penjualan Ikan Sukaratu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

<section>

<form method="post" class="add-product-form" role="form" action="cek_login.php">
   <h3>Sistem Informasi Penjualan Ikan Sukaratu</h3>
   <input type="text" name="username" placeholder="Masukan Username" class="box" required>
   <input type="pass" name="pass" placeholder="Masukan Password" class="box" required>
   <h2 align="center">Belum Punya Akun?<a href="daftar.php"> Silahkan Daftar</a></h2>
   <input type="submit" value="masuk" class="btn">
</form>

</section>

</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>