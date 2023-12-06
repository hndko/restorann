<?php
session_start();
include 'dbconnect.php';

$nama = mysqli_query($conn, "SELECT * FROM rating JOIN login ON rating.userid=login.namalengkap");
$no = 1;
$idproduk = $_GET['idproduk'];

if (isset($_POST['addprod'])) {
	if (!isset($_SESSION['log'])) {
		header('location:login.php');
	} else {
		$ui = $_SESSION['id'];
		$cek = mysqli_query($conn, "select * from cart where userid='$ui' and status='Cart'");
		$liat = mysqli_num_rows($cek);
		$f = mysqli_fetch_array($cek);
		$orid = $f['orderid'];

		//kalo ternyata udeh ada order id nya
		if ($liat > 0) {

			//cek barang serupa
			$cekbrg = mysqli_query($conn, "select * from detailorder where idproduk='$idproduk' and orderid='$orid'");
			$liatlg = mysqli_num_rows($cekbrg);
			$brpbanyak = mysqli_fetch_array($cekbrg);
			$jmlh = $brpbanyak['qty'];

			//kalo ternyata barangnya ud ada
			if ($liatlg > 0) {
				$i = 1;
				$baru = $jmlh + $i;

				$updateaja = mysqli_query($conn, "update detailorder set qty='$baru' where orderid='$orid' and idproduk='$idproduk'");

				if ($updateaja) {
					echo " <div class='alert alert-success'>
							Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
						  </div>";
					header('Location: checkout.php');
				} else {
					echo "<div class='alert alert-warning'>
							Gagal menambahkan ke keranjang
						  </div>
						  <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
				}
			} else {

				$tambahdata = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$orid','$idproduk','1')");
				if ($tambahdata) {
					echo " <div class='alert alert-success'>
							Berhasil menambahkan ke keranjang
						  </div>
						  ";

					header('Location: checkout.php');
				} else {
					echo "<div class='alert alert-warning'>
							Gagal menambahkan ke keranjang
						  </div>
						 <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
				}
			};
		} else {

			//kalo belom ada order id nya
			$oi = crypt(rand(22, 999), time());

			$bikincart = mysqli_query($conn, "insert into cart (orderid, userid) values('$oi','$ui')");

			if ($bikincart) {
				$tambahuser = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$oi','$idproduk','1')");
				if ($tambahuser) {
					echo " <div class='alert alert-success'>
							Berhasil menambahkan ke keranjang
						  </div> ";

					header('Location: checkout.php');
				} else {
					echo "<div class='alert alert-warning'>
							Gagal menambahkan ke keranjang
						  </div>
						 <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
				}
			} else {
				echo "gagal bikin cart";
			}
		}
	}
};
?>

<!DOCTYPE html>
<html>

<head>
	<title>Depot Moro Seneng - Menu</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Tokopekita, Richard's Lab" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- //js -->
	<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
</head>

<body>
	<!-- header -->
	<?php include "template_user/header.php" ?>

	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i><a href="https://wa.me/6281132322" target="_blank">Hubungi Kami : (+6281) 222 333</a></li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">Depot Moro Seneng</a></h1>
			</div>
			<div class="w3l_search">
				<form action="search.php" method="post">
					<input type="search" name="Search" placeholder="Cari produk...">
					<button type="submit" class="btn btn-default search" aria-label="Left Align">
						<i class="fa fa-search" aria-hidden="true"> </i>
					</button>
					<div class="clearfix"></div>
				</form>
			</div>

			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //header -->
	<!-- navigation -->
	<!-- navbar -->
	<?php include "template_user/navbar.php"; ?>
	<!-- navbar -->

	<!-- //navigation -->
	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active"><?php
									$p = mysqli_fetch_array(mysqli_query($conn, "Select * from produk where idproduk='$idproduk'"));
									echo $p['namaproduk'];
									?></li>
			</ol>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<div class="products">
		<div class="container">
			<div class="agileinfo_single">

				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo $p['gambar'] ?>" alt=" " class="img-responsive">
				</div>
				<div class="col-md-8 agileinfo_single_right">
					<h2><?php echo $p['namaproduk'] ?></h2>
					<div class="rating1">
						<span class="starRating">
							<?php
							$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
							$rate = $p['rate'];

							for ($n = 1; $n <= $rate; $n++) {
								echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
							};
							?>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Deskripsi :</h4>
						<p><?php echo $p['deskripsi'] ?></p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4 class="m-sing">Rp<?php echo number_format($p['hargaafter']) ?> <span>Rp<?php echo number_format($p['hargabefore']) ?></span></h4>
						</div>
						<div class="snipcart-item block">
							<div class="snipcart-thumb agileinfo_single_right_snipcart">
								<h4 class="m-sing">Stok <?php echo number_format($p['stok']) ?> Porsi</h4>
							</div>
							<div class="snipcart-details agileinfo_single_right_details">
								<form action="#" method="post">
									<fieldset>
										<input type="hidden" name="idprod" value="<?php echo $idproduk ?>">
										<input type="submit" name="addprod" value="Beli" class="button">
									</fieldset>
								</form>
							</div>
						</div>
					</div>

					<!-- RATING -->
					<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
						<div class="agile-tp">
							<h2>Ulasan</h2>
						</div>
						<div class="agile_top_brands_grids">

							<?php

							// $query3 = mysqli_query($conn, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");
							// $nama = mysqli_query($conn, "SELECT * FROM rating JOIN login ON rating.userid = login.namalengkap");
							$brgs = mysqli_query($conn, "SELECT * FROM rating WHERE idproduk = $idproduk");
							// $brgs = mysqli_query($conn,"SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY hasil.nilai DESC");
							// $brgs = mysqli_query($conn,"SELECT * FROM rating JOIN login ON rating.userid=login.namalengkap");
							$no = 1;
							while ($p = mysqli_fetch_array($brgs)) {
								$iduser = $p['userid'];
							?>
								<div style="margin-top: 20px;" class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block">
														<div class="snipcart-thumb">
															<?php
															$nama = mysqli_query($conn, "SELECT * FROM login WHERE userid = $iduser");
															while ($q = mysqli_fetch_array($nama)) {

															?>
																<p style="text-align: left;"><?php echo $q['namalengkap']; ?></p>
															<?php } ?>
															<div class="stars">
																<?php
																$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
																$rate = $p['rating'];

																for ($n = 1; $n <= $rate; $n++) {
																	echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
																};
																?>
															</div>
															<h4 style="text-align: left;">Ulasan Produk <br><br></h4>
															<?php echo $p['ulasan'] ?>
														</div>

													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>


							<div class="clearfix"> </div>
						</div>
					</div>
					<!-- END RATING -->


					<div class="clearfix"> </div>
				</div>
			</div>
		</div>

		<!-- //footer -->
		<div class="footer">
			<div class="container">
				<div class="w3_footer_grids">
					<div class="col-md-4 w3_footer_grid">
						<h3>Hubungi Kami</h3>

						<ul class="address">
							<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Depot Moro Seneng</li>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@email">info@email</a></li>
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i><a href="https://wa.me/6281132322" target="_blank">+62 8113 2322</a></li>
						</ul>
					</div>
					<div class="col-md-3 w3_footer_grid">
						<h3>Tentang Kami</h3>
						<ul class="info">
							<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
							<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">How To</a></li>
							<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">FAQ</a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="footer-copy">

				<div class="container">
					<p>© 2023 Depot Moro Seneng. All rights reserved</p>
				</div>
			</div>

		</div>
		<div class="footer-botm">
			<div class="container">
				<div class="w3layouts-foot">
					<ul>
						<li><a href="#" class="w3_agile_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="payment-w3ls">
					<img src="images/card.png" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //footer -->
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- top-header and slider -->
		<!-- here stars scrolling icon -->
		<script type="text/javascript">
			$(document).ready(function() {

				var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 4000,
					easingType: 'linear'
				};


				$().UItoTop({
					easingType: 'easeOutQuart'
				});

			});
		</script>
		<!-- //here ends scrolling icon -->

		<!-- main slider-banner -->
		<script src="js/skdslider.min.js"></script>
		<link href="css/skdslider.css" rel="stylesheet">
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#demo1').skdslider({
					'delay': 5000,
					'animationSpeed': 2000,
					'showNextPrev': true,
					'showPlayButton': true,
					'autoSlide': true,
					'animationType': 'fading'
				});

				jQuery('#responsive').change(function() {
					$('#responsive_wrapper').width(jQuery(this).val());
				});

			});
		</script>
		<!-- //main slider-banner -->
</body>

</html>