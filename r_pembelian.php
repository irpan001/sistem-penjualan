<?php 
  session_start();

  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }

?>
<?php

@include 'config.php';


if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_status = $_POST['update_p_status'];

   $update_query = mysqli_query($conn, "UPDATE `order` SET status = '$update_p_status' WHERE id = '$update_p_id'");

   if($update_query){

      $message[] = 'Data Berhasil diubah';
      header('location:r_penjualan.php');
   }else{
      $message[] = 'Data Gagal diubah';
      header('location:r_penjualan.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header_user.php'; ?>

<div class="container">

<section>

<form class="add-product-form">
   <h3>RIWAYAT PEMBELIAN</h3>
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>PRODUK</th>
         <th>METODE PEMBAYARAN</th>
         <th>TOTAL</th>
         <th>STATUS</th>
         <th>ACTION</th>

      </thead>

      <tbody>
         <?php
            $nama = $_SESSION['nama'];
            $select_products = mysqli_query($conn, "SELECT * FROM `order` where nama_pembeli='$nama'");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><?php echo $row['total_products']; ?></td>
            <td> <?php echo $row['method']; ?></td>
            <td>Rp. <?php echo $row['total_price']; ?></td>
            <td>
                        <?php if($row ["status"] == 0) { ?>
                            <b>SEDANG DIPROSES</b>
                            </a>

                        <?php }elseif ($row ["status"] == 1) { ?>
                            <b>SEDANG DIKIRIM</b>
                            </a>
                          
                        <?php }elseif ($row["status"] == 2) { ?>
                            <b>SUDAH DITERIMA</b>
                            </a>
                          
                        <?php }?>
            </td>
            <td>
                        <?php if($row ["status"] == 0) { ?>
            
                            </a>

                        <?php }elseif ($row ["status"] == 1) { ?>

                             <a href="r_pembelian.php?edit=<?php echo $row['id']; ?>" class="option-btn"> IKAN SUDAH DITERIMA </a>
                            </a>
                          
                        <?php }elseif ($row["status"] == 2) { ?>

                            </a>
                          
                        <?php }?>
            </td>


         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Belum ada data</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `order` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="hidden" class="box" required name="update_p_status" value="2">

      <input type="submit" value="IKAN SUDAH DITERIMA" name="update_product" class="btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>