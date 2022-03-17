<header class="header">

   <div class="flex">

      <a href="#" class="logo">Sistem Informasi Penjualan Ikan Sukaratu</a>
       <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
      <nav class="navbar">
         <a href="beranda.php">HOME</a>
         <a href="produk.php">PRODUK</a>
         <a href="user.php">USER</a>
         <a href="r_penjualan.php">RIWAYAT PENJUALAN</a>
         <a href="logout.php">LOGOUT</a>
      </nav>      
      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>