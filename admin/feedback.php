<?php 
	session_start();
	include '../dbconnect.php';
	date_default_timezone_set("Asia/Bangkok");

    $caricart = mysqli_query($conn,"select * from komplain");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['orderid'];

	if(isset($_POST["edit"])){
        $resolusi = $_POST['resolusi'];
        $idorder = $_POST['idorder'];

        $q3 = mysqli_query($conn, "UPDATE komplain SET resolusi='$resolusi' WHERE orderid = '$orderidd'");
        if ($q3) {
            echo "Berhasil Menambahkan Resolusi";
            header("Refresh: 1; url=feedback.php");
        } else {
            echo "Gagal Menambahkan Resolusi: " . mysqli_error($conn);
            header(" url=feedback.php");
        }
    }
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
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Ulasan Pembeli</h2>
								</div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Order Id</th>
												<th>Id Produk</th>
												<th>User Id</th>
												<th>Rating</th>
												<th>Ulasan</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from rating");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$orderids = $p['orderid'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><a href="order.php?orderid=<?php echo $p['orderid'] ?>">#<?php echo $p['orderid'] ?></a></strong></td>
													<td><?php echo $p['idproduk'] ?></td>
													<td><?php echo $p['userid'] ?></td>
													<td><div class="stars">
																<?php
																$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
																$rate = $p['rating'];
																
																for($n=1;$n<=$rate;$n++){
																	echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
																};
																?>
                                                                <span style="display: none;"><?php echo $p['rating']; ?></span>
															</div></td>
													<td><?php echo $p['ulasan'] ?></td>
													
												</tr>		
												<?php 
											}
											?>
										</tbody>
										</table>
                                    </div>
                                    
                                </div>
                                

                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">

                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        </div>


                    <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Komplain</h2>
								</div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable2" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>ID Pesanan</th>
												<th>Nama Customer</th>
												<th>Tanggal Order</th>
												<th>Total</th>
												<th>Opsi</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status='Complain'  order by idcart ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$orderids = $p['orderid'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><?php echo $p['orderid'] ?></strong></td>
													<td><?php echo $p['namalengkap'] ?></td>
													<td><?php echo $p['tglorder'] ?></td>
													<td>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></td>
                                                    
                                                    <td><a href="admin-lihat-detail-komplain.php?id=<?= $p['orderid'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></a> </td>

												</tr>		
												<?php 
                                            }
											?>
										</tbody>
										</table>
                                        </div>

                                    <a href="feedback_print.php" target="_blank" class="btn btn-danger">Print <Datag></Datag></a>
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
    <script src="../assets/bower_components/chart.js/Chart.min.js"></script>
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
	
	<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
var xValues = ["Rating 5", "Rating 4", "Rating 3", "Rating 2", "Rating 1"];

var yValues = [
    <?php
                                                $rating5 = mysqli_query($conn,"SELECT * FROM rating where rating=5");
                                                $r5 = mysqli_num_rows($rating5);
                                                $total_rating5 = $r5;
                                                if($total_rating5 ==""){
                                                    echo "0,";
                                                }else{
                                                    echo $total_rating5.",";
                                                }
                                                $rating4 = mysqli_query($conn,"SELECT * FROM rating where rating=4");
                                                $r4 = mysqli_num_rows($rating4);
                                                $total_rating4 = $r4;
                                                if($total_rating4 ==""){
                                                    echo "0,";
                                                }else{
                                                    echo $total_rating4.",";
                                                }
                                                $rating3 = mysqli_query($conn,"SELECT * FROM rating where rating=3");
                                                $r3 = mysqli_num_rows($rating3);
                                                $total_rating3 = $r3;
                                                if($total_rating3 ==""){
                                                    echo "0,";
                                                }else{
                                                    echo $total_rating3.",";
                                                }
                                                $rating2 = mysqli_query($conn,"SELECT * FROM rating where rating=2");
                                                $r2 = mysqli_num_rows($rating2);
                                                $total_rating2 = $r2;
                                                if($total_rating2 ==""){
                                                    echo "0,";
                                                }else{
                                                    echo $total_rating2.",";
                                                }
                                                $rating1 = mysqli_query($conn,"SELECT * FROM rating where rating=1");
                                                $r1 = mysqli_num_rows($rating1);
                                                $total_rating1 = $r1;
                                                if($total_rating1 ==""){
                                                    echo "0,";
                                                }else{
                                                    echo $total_rating1.",";
                                                }
    ?>
];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Jumlah Rating"
    }
  }
});
</script>
</body>

</html>
