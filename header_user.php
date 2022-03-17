
<header class="header">

   <div class="flex">

      <a href="#" class="logo">Sistem Informasi Penjualan Ikan Sukaratu</a>
       <?php
      $user = $_SESSION['id_user'];
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart` where id_user='$user' ") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
      <nav class="navbar">
         <a href="beranda.php">BERANDA</a>
         <a href="cart.php" class="cart">KERANJANG <span><?php echo $row_count; ?></span> </a>
         <a href="checkout.php">PEMBAYARAN</a>
         <a href="r_pembelian.php">RIWAYAT</a>
         <a href="logout.php">LOGOUT</a>
      </nav>      
      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>