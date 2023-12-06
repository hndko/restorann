<?php
session_start();
include 'dbconnect.php';
$orderid = $_GET['id'];

if (!isset($_SESSION['log'])) {
    header('location: login.php');
} else {
}


$uid = $_SESSION['id'];
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Depot Moro Seneng - Daftar Belanja</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Tokopekita, Richard's Lab" />
    <script type="application/x-javascript">addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
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
            $(".scroll").click(function(event){        
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>
    
<body>
<!-- header -->
    <div class="agileits_header">
        <div class="container">
            <div class="w3l_offers">

            </div>
            <div class="agile-login">
                <ul>
                <?php
                if(!isset($_SESSION['log'])){
                    echo '
                    <li><a href="registered.php"> Daftar</a></li>
                    <li><a href="login.php">Masuk</a></li>
                    ';
                } else {
                    
                    if($_SESSION['role']=='Member'){
                    echo '
                    <li style="color:white">Halo, '.$_SESSION["name"].'
                    <li><a href="logout.php">Keluar?</a></li>
                    ';
                    } else {
                    echo '
                    <li style="color:white">Halo, '.$_SESSION["name"].'
                    <li><a href="admin">Admin Panel</a></li>
                    <li><a href="logout.php">Keluar?</a></li>
                    ';
                    };
                    
                }
                ?>
                    
                </ul>
            </div>
            <div class="product_list_header">  
                    <a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                     </a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

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
<!-- navbar -->
<?php include "template_user/navbar.php"; ?>
<!-- navbar -->
<!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
    </div>
<!-- //breadcrumbs -->
<!-- checkout -->
    <div class="checkout">
        <div class="container">
            <?php $brg=mysqli_query($conn,"SELECT * FROM komplain where orderid='$orderid'");
                while ($row = mysqli_fetch_assoc($brg)) {
                    $nama = $row['userid'];
                    $komplain = $row['komplain'];
                    $tanggal = $row['tanggal'];
                    $idkomplain = $row['idkomplain'];
            ?>
            <h1>Order ID <?php echo $orderid;  ?></h1>
            <h5>Nama Pembeli : <?php echo $nama;  ?></h5>
            <h5>Detail Komplain : <?php echo $komplain;  ?></h5>
            <h5>Tanggal Komplain : <?php echo $tanggal;  ?></h5>
            <h5>ID Komplain : <?php echo $idkomplain;  ?></h5>

<!-- selesaikan proses komplain -->



<div>
    <form action="selesai-komplain.php?orderid=<?php echo $orderid ?>" method="post">
        <div class="register">
            <label for="">orderid</label>
            <input type="text" name="orderid" value=" <?php echo $orderid ?> ">
            <input type="submit" class="btn btn-success" name="selesai" value="Selesaikan Complain">
        </div>
    </form>
</div>
<!-- selesaikan proses komplain -->

            <?php } ?>

            <div class="checkout-right" style="margin-top: 20px;">
                    <?php 
                    $brg=mysqli_query($conn,"SELECT * FROM pesankomplain where idkomplain='$idkomplain'");
                    $no=1;
                    while($b=mysqli_fetch_array($brg)){
                    ?>
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pesan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tr class="rem1">
                        <form method="post">
                            <td class="invert"><?php echo $b['userid'] ?></td>
                            <td class="invert"><?php echo $b['pesan'] ?></td>
                            <td class="invert"><?php echo $b['detail'] ?></td>
                        </form>
                    </tr>
                </table>
                    <?php
                        }
                    ?>
                
                <!-- balas pesan -->
                <div>
                    <form method="post" action="proses-balas-komplain.php">
                        <div class="register">
                            <input type="hidden"  name="idkomplain" value=" <?php echo $idkomplain ?> ">
                            <input type="hidden" name="userid" value=" <?php echo $uid ?> " >
                            
                            <input type="text" name="pesan" placeholder="Ketik pesan">
                            <button type="submit">
                                <i class="fa fa-send" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- //checkout -->
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
				<p>© 2023 Depot Moro Seneng All rights reserved</p>
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
			
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 
</body>
</html>