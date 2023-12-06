<style>
	.rating {
		unicode-bidi: bidi-override;
		direction: rtl;
		text-align: center;
	}

	.rating>input {
		display: none;
	}

	.rating>label {
		display: inline-block;
		position: relative;
		width: 1.1em;
		font-size: 25px;
		color: grey;
		cursor: pointer;
	}

	.rating>label:before {
		content: "\2606";
		position: absolute;
	}

	.rating>label:hover:before,
	.rating>input:checked~label:before {
		content: "\2605";
		color: gold;
	}
</style>

<?php
session_start();
if (!isset($_SESSION['log'])) {
	header('location:login.php');
} else {
};

$idorder = $_GET['id'];

include 'dbconnect.php';

//mengambil data produk
$brg = mysqli_query($conn, "SELECT * from detailorder d, produk p where orderid='$idorder' and d.idproduk=p.idproduk order by d.idproduk ASC");
$no = 1;
while ($b = mysqli_fetch_array($brg)) {


	if (isset($_POST['confirm'])) {

		$userid = $_SESSION['id'];
		$veriforderid = mysqli_query($conn, "select * from cart where orderid='$idorder'");
		$fetch = mysqli_fetch_array($veriforderid);

		// Cek Nilai Value dari $fetc
		$data1 = isset($fetch) ? $fetch : '';
		$liat = mysqli_num_rows($veriforderid);

		if ($data1 > 0) {
			$idproduk = $b['idproduk'];
			$userid = $_SESSION["id"];
			$komplain = $_POST['komplain'];

			$kon = mysqli_query($conn, "insert into komplain (orderid, idproduk, userid, komplain, tanggal) 
		values('$idorder','$idproduk','$userid','$komplain', CURDATE())");
			if ($kon) {

				$up = mysqli_query($conn, "update cart set status='Complain' where orderid='$idorder'");

				echo " <div class='alert alert-success'>
			Proses Komplain sedang diproses.
		  </div>
		<meta http-equiv='refresh' content='7; url= index.php'/>  ";
			} else {
				echo "<div class='alert alert-warning'>
			Gagal Submit, silakan ulangi lagi.
		  </div>
		 <meta http-equiv='refresh' content='3; url= daftarorder.php'/> ";
			}
		} else {
			echo "<div class='alert alert-danger'>
			Kode Order tidak ditemukan, harap masukkan kembali dengan benar
		  </div>
		 <meta http-equiv='refresh' content='4; url= komplain.php?id=" . $idorder . "'/> ";
		}
	};

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Dhan MOTOR - Nilai Pembelian</title>
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
		<!-- breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
					<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
					<li class="active">Komplain</li>
				</ol>
			</div>
		</div>
		<!-- //breadcrumbs -->
		<!-- register -->
		<div class="register">
			<div class="container">
				<h2>Komplain</h2>
				<div class="login-form-grids">
					<h3>Kode Order</h3>
					<form method="post">
						<strong>
							<input type="text" name="orderid" value="<?php echo $idorder ?>" disabled>
						</strong>
						<strong>
							<input type="hidden" name="iduser" value="<?php echo $_SESSION["id"]; ?>" disabled>
						</strong>
						<strong>
							<input type="hidden" name="idproduk" value="<?php echo $b['idproduk']; ?>" disabled>
						</strong>

						<h4 style="margin-top: 20px; margin-bottom: 10px;">Produk</h4>
						<div style="display: flex; justify-content: center;">
							<a href="product.php?idproduk=<?php echo $b['idproduk'] ?>">
								<img src="<?php echo $b['gambar'] ?>" width="100px" height="100px" />
							</a>
						</div>
					<?php
				}
					?>
					<h4 style="margin-top: 20px; margin-bottom: 10px;">Komplain</h4>
					<input type="text" name="komplain" placeholder="Ceritakan Masalah Anda" required>


					<br>
					<input type="submit" name="confirm" value="Kirim">
					</form>
				</div>
				<div class="register-home">
					<a href="daftarorder.php">Batal</a>
				</div>
			</div>
		</div>
		<!-- //register -->
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