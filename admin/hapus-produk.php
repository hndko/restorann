<?php include '../dbconnect.php'; ?>

<?php
$ada_error = false;
$result = '';

$idproduk = (isset($_GET['idproduk'])) ? trim($_GET['idproduk']) : '';

if(!$idproduk) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($conn,"SELECT * FROM produk WHERE idproduk = '$idproduk'");
	$cek = mysqli_num_rows($query);
	
	if($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($conn,"DELETE FROM produk WHERE idproduk = '$idproduk';");
        //hapus rating
		mysqli_query($conn,"DELETE FROM rating WHERE idproduk = '$idproduk';");
		echo "<meta http-equiv='refresh' content='1; url= produk.php'/>";
	}
}
?>

	<?php if($ada_error): ?>
		<?php echo '<div class="alert alert-danger">'.$ada_error.'</div>'; ?>	
	<?php endif; ?>
