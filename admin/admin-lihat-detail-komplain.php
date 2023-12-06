<?php 
	session_start();
	include '../dbconnect.php';
	date_default_timezone_set("Asia/Bangkok");
    $orderid = $_GET['id'];
	?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Pesanan - Dhan MOTOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="main-menu">
                <div class="menu-inner">
                <nav>
                        <?php
                        if($_SESSION['role']=='Admin'):
                        ?>
                        <ul class="metismenu" id="menu">
							<li class="active"><a href="index.php"><span>Home</span></a></li>
							<li><a href="../"><span>Kembali ke Showroom</span></a></li>
							<li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
							<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola Showroom
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="kategori.php">Kategori</a></li>
                                    <li><a href="produk.php">Produk</a></li>
									<li><a href="pembayaran.php">Metode Pembayaran</a></li>
                                </ul>
                            </li>
							<li><a href="feedback.php"><span>Feedback Pembeli</span></a></li>
							<li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
							<li><a href="user.php"><span>Kelola Admin</span></a></li>
                            <li>
                                <a href="../logout.php"><span>Logout</span></a>
                                
                            </li>
                            
                        </ul>
                        <?php
                        elseif($_SESSION['role']=='Pimpinan'):
                        ?>
                            <ul class="metismenu" id="menu">
							<li class="active"><a href="index.php"><span>Home</span></a></li>
							<li><a href="../"><span>Kembali ke Showroom</span></a></li>
                            <li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
							<li><a href="feedback.php"><span>Feedback Pembeli</span></a></li>
                            <li>
                                <a href="../logout.php"><span>Logout</span></a>
                                
                            </li>
                        </ul>
                        <?php
                        endif;
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><h3><div class="date">
								<script type='text/javascript'>
						
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>

						</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
			
            
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                    <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <?php $brg=mysqli_query($conn,"SELECT * FROM komplain where orderid='$orderid'");
                while ($row = mysqli_fetch_assoc($brg)) {
                    $nama = $row['userid'];
                    $komplain = $row['komplain'];
                    $tanggal = $row['tanggal'];
                    $idkomplain = $row['idkomplain'];
            ?>
            <h1>Order ID <?php echo $orderid;  ?></h1>
            <h6>Nama Pembeli : <?php echo $nama;  ?></h6>
            <h6>Detail Komplain : <?php echo $komplain;  ?></h6>
            <h6>Tanggal Komplain : <?php echo $tanggal;  ?></h6>
            <h6>ID Komplain : <?php echo $idkomplain;  ?></h6>
            <?php 
            }        
            ?>
            <!-- selesaikan complain -->
            <a href="selesai.php"><button>Selesaikan Komplain</button></a>

            <div class="data-tables datatable-dark">
                <table id="dataTable2" class="display" style="width:100%"><thead class="thead-dark">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pesan</th>
                            <th>Detail</th>
                        </tr>
                                        </thead>                            
                                        <tbody>
                                            <?php 
											// $brgs=mysqli_query($conn,"SELECT * from pesankomplain c, login l where c.userid=l.userid and status='Complain'  order by idcart ASC");
                                            $brgs=mysqli_query($conn,"SELECT * FROM pesankomplain where idkomplain='$idkomplain'");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												?>
												
												<tr>
													<td>
                                                        <?php 
                                                        if($p['userid']==$_SESSION['id']){
                                                            echo '<strong style="color: blue;">Saya</strong>';
                                                        }else{
                                                            echo $p['userid'];
                                                        }
                                                        ?>
                                                        
                                                    </td>
													<td><?php echo $p['pesan'] ?></td>
													<td><?php echo $p['detail'] ?></td>

												</tr>		
												<?php 
                                            }
											?>
										</tbody>
										</table>
                                        <!-- balas pesan -->
                                        <div>
                                            <form method="post" action="../proses-balas-komplain.php">
                                                <div class="register">

                                                <input type="hidden" name="idkomplain" value=" <?php echo $idkomplain ?> ">
                                                    <input type="hidden" name="userid" value=" <?php echo $_SESSION['id'] ?> " >
                                                    
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
                        </div>
                    </div>
                    
                </div>
                </div>
                </div>
              
                
                <!-- row area start-->
            </div>
            
        </div>
        <!-- main content area end -->


        <!-- second content area -->

        
        <!-- main content area end -->

                                    

        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>By Dhan Motor</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

            <!-- Modal Lihat Komplain -->
			

            <?php 
				$brgs=mysqli_query($conn,"SELECT * from komplain");
				$no=1;
				while($q=mysqli_fetch_array($brgs)){
			?>
			<div class="modal fade" id="lihat<?= $q['orderid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
							<div class="modal-body">
							<form action="tambah-resolusi-komplain.php" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                            <label>Order Id</label>
                                            <input name="idorder" value=" <?php echo $q['orderid'] ?> " type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Id Produk</label>
                                            <input name="idproduk" value=" <?php echo $q['idproduk'] ?> " type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Id User</label>
                                            <input name="iduser" value=" <?php echo $q['userid'] ?> " type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Komplain</label>
                                            <input name="tangal" value="<?php echo $q['tanggal'] ?>" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Komplain</label>
                                            <input name="komplain" value="<?php echo $q['komplain'] ?>" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Resolusi</label>
                                            <input name="resolusi" placeholder="input resolusi" type="text" class="form-control">
                                        </div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
									<input name="edit" type="submit" class="btn btn-primary" value="Simpan">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php 
			} 
			?>
	
	<script>	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
	
</body>

</html>
