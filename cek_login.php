<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
$koneksi = mysqli_connect("localhost","root","","shop_db");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$pass = $_POST['pass'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * from user where username='$username' and pass='$pass'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){


	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['alamat'] = $data['alamat'];
		$_SESSION['no_wa'] = $data['no_wa'];
		$_SESSION['email'] = $data['email'];

		header("location:beranda_admin.php");

	}else if($data['level']=="user"){

		// buat session login dan username
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['alamat'] = $data['alamat'];
		$_SESSION['no_wa'] = $data['no_wa'];
		$_SESSION['email'] = $data['email'];

		header("location:beranda.php");
	}else{


		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}

?>