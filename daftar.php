<?php

@include 'config.php';

if(isset($_POST['daftar'])){
   $nama = $_POST['nama'];
   $email = $_POST['email'];
   $no_wa = $_POST['no_wa'];
   $alamat = $_POST['alamat'];
   $username = $_POST['username'];
   $pass = $_POST['pass'];
   $level = $_POST['level'];



   $insert_query = mysqli_query($conn, "INSERT INTO `user`(nama, email, no_wa, alamat, username, pass, level) 
      VALUES('$nama', '$email', '$no_wa', '$alamat', '$username', '$pass', 'user')") or die('query failed');

   if($insert_query){
      header('location:login.php');
      $message[] = 'Data Berhasil ditambahkan';
   }else{
      header('location:daftar.php');
      $message[] = 'Data Gagal ditambahkan';
   }
};

?>
<!DOCTYPE html>
<html lang="en">
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

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Sistem Informasi Penjualan Ikan Sukaratu</h3>

   <input type="text" name="nama" placeholder="Masukan Nama" class="box" required>
   <input type="text" name="email" placeholder="Masukan Email" class="box" required>

   <input type="text" name="no_wa" placeholder="Masukan No WA" class="box" required>
   <input type="text" name="alamat" placeholder="Masukan Alamat" class="box" required>

   <input type="text" name="username" placeholder="Masukan Username" class="box" required>
   <input type="text" name="pass" placeholder="Masukan Password" class="box" required>

   <input type="hidden" name="level" placeholder="Masukan Username" class="box" required>

   <input type="submit" value="Simpan" name="daftar" class="btn">
</form>

</section>

</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>