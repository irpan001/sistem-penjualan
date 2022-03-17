<?php 
  session_start();

  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }

?>
<?php

@include 'config.php';

if(isset($_POST['order_btn'])){


   $nama_pembeli = $_POST['nama_pembeli'];
   $no_wa = $_POST['no_wa'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $alamat = $_POST['alamat'];
   $patokan = $_POST['patokan'];
   $status = $_POST['status'];

   $user = $_SESSION['id_user'];
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` where id_user='$user'");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['nama_ikan'] .' ('. $product_item['quantity'] .') ';
         $product_price = $product_item['price'] * $product_item['quantity'];
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(nama_pembeli, no_wa, email, method, alamat, patokan, total_products, total_price, status) 
      VALUES('$nama_pembeli','$no_wa','$email','$method','$alamat','$patokan','$total_product','$price_total','$status')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : Rp.".$price_total."  </span>
         </div>
         <div class='customer-details'>

      

            <p>(*pay when product arrives*)</p>
         </div>
            <a href='beranda.php' class='btn'>Belanja Lagi</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header_user.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Selesaikan Pembayaran</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $user = $_SESSION['id_user'];
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` where id_user='$user' ");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['nama_ikan']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : Rp. <?= $grand_total; ?> </span>
   </div>

      <div class="flex">

         <div class="inputBox">
            <span>NAMA</span>
            <input type="text"  name="nama_pembeli" value="<?php echo $_SESSION['nama']; ?>" required>
         </div>

         <div class="inputBox">
            <span>NO WHATSAPP</span>
            <input type="text"  name="no_wa" value="<?php echo $_SESSION['no_wa']; ?>" required>
         </div>

         <div class="inputBox">
            <span>EMAIL</span>
            <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
         </div>

         <div class="inputBox">
            <span>METODE PEMBAYARAN</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="dana">dana</option>
            </select>
         </div>

         <div class="inputBox">
            <span>ALAMAT</span>
            <input type="text" name="alamat" value="<?php echo $_SESSION['alamat']; ?>" required>
         </div>

         <div class="inputBox">
            <span>PATOKAN</span>
            <input type="text" name="patokan" placeholder="patokan rumahmu biar kurir tidak bingung" required>
         </div>
         
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>