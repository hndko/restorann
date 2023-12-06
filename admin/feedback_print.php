 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Laporan Penjualan</title>
     <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
     <?php include '../dbconnect.php'; ?>
     <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/css/font-awesome.min.css">
     <link rel="stylesheet" href="assets/css/themify-icons.css">
     <link rel="stylesheet" href="assets/css/metisMenu.css">
     <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
     <link rel="stylesheet" href="assets/css/slicknav.min.css">

     <!-- amchart css -->
     <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
         media="all" />
     <!-- Start datatable css -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" type="text/css"
         href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
     <link rel="stylesheet" type="text/css"
         href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
     <link rel="stylesheet" type="text/css"
         href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

     <!-- others css -->
     <link rel="stylesheet" href="assets/css/typography.css">
     <link rel="stylesheet" href="assets/css/default-css.css">
     <link rel="stylesheet" href="assets/css/styles.css">
     <link rel="stylesheet" href="assets/css/responsive.css">
     <!-- modernizr css -->
     <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
 </head>

 <body>

     <style type="text/css">
     .table-tanggal tr th,
     .table-tanggal tr td {
         padding: 5px;
     }
     </style>

     <center>
         <h4>LAPORAN RATING DAN COMPLAIN</h4>
         <h4>DHAN MOTOR</h4>
     </center>

     <h2>Ulasan Pembeli</h2>
     <div class="data-tables datatable-dark">
         <table class="table table-bordered table-striped" id="table-datatable">
             <thead class="thead-dark">
                 <tr>
                     <th>No</th>
                     <th>Order Id</th>
                     <th>Id Produk</th>
                     <th>User Id</th>
                     <th>Rating</th>
                     <th>Ulasan</th>
                 </tr>
             </thead>
             <tbody>
                 <?php 
										   $brgs=mysqli_query($conn,"SELECT * from rating");
										   $no=1;
										   while($p=mysqli_fetch_array($brgs)){
										   $orderids = $p['orderid'];
											   ?>

                 <tr>
                     <td><?php echo $no++ ?></td>
                     <td><strong><?php echo $p['orderid'] ?></strong>
                     </td>
                     <td><?php echo $p['idproduk'] ?></td>
                     <td><?php echo $p['userid'] ?></td>
                     <td>
                         <div class="stars">
                             <?php
															   $bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
															   $rate = $p['rating'];
															   
															   for($n=1;$n<=$rate;$n++){
																   echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
															   };
															   ?>
                             <span style="display: none;"><?php echo $p['rating']; ?></span>
                         </div>
                     </td>
                     <td><?php echo $p['ulasan'] ?></td>

                 </tr>
                 <?php 
										   }
										   ?>
             </tbody>
         </table>
     </div>

     <h2>Komplain</h2>
     <div class="data-tables datatable-dark">
         <table class="table table-bordered table-striped" id="table-datatable">
             <thead class="thead-dark">
                 <tr>
                     <th>No</th>
                     <th>ID Pesanan</th>
                     <th>Nama Customer</th>
                     <th>Tanggal Order</th>
                     <th>Total</th>
                     <th>Opsi</th>
                 </tr>
             </thead>
             <tbody>
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

                     <td></td>

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


     <!-- row area start-->
     </div>


     <?php 
 	
 	?>


     <script>
     window.print();
     $(document).ready(function() {

     });
     </script>

 </body>

 </html>