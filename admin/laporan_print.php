 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Penjualan</title>
 	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 	<?php include '../dbconnect.php'; ?>
 </head>
 <body>

 	<style type="text/css">
 		.table-tanggal tr th, .table-tanggal tr td{
 			padding: 5px;
 		}
 	</style>	

 	<center>
 		<h4>LAPORAN PENJUALAN</h4>
 		<h4>DHAN MOTOR</h4>
 	</center>
 		

 		<table class="table table-bordered table-striped" id="table-datatable">
 			<thead>
 				<tr>
 					<th width="1%">NO</th>
 					<th width="10%" class="text-center">NO.INVOICE</th>
 					<th class="text-center">TANGGAL</th>
 					<th class="text-center">PELANGGAN</th>
 					<th class="text-center">TOTAL BAYAR</th>
 					<th class="text-center">STATUS</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php 
 				$no=1;
 				$totall=0;
 				$data = mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid order by idcart ASC");
 				while($d = mysqli_fetch_array($data)){
 					?>
 					<tr>
 						<td class="text-center"><?php echo $no++; ?></td>
 						<td class="text-center"><strong><?php echo $d['orderid'] ?></strong></td>
 						<td class="text-center"><?php echo date('d-m-Y', strtotime($d['tglorder'])); ?></td>
 						<td class="text-center"><?php echo $d['namalengkap']; ?></td>
 						<td class="text-center">
						<?php 			
						$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$d[orderid]' and p.idproduk=d.idproduk order by d.idproduk ASC");
						$cekrow = mysqli_num_rows($result1);
						$row1 = mysqli_fetch_assoc($result1);
						$count = $row1['count'];
						$totall= $totall+$count;
						if($cekrow > 0){
							echo "Rp.".number_format($count).",-";
						} else {
						echo 'No data';
						}?></td>
 						<td class="text-center"><?php echo $d['status']; ?></td>
 					</tr>
 					<?php 
 				}
 				?>
 			</tbody>
 			<tfoot>
 				<tr class="bg-info">
 					<td colspan="4" class="text-right"><b>TOTAL</b></td>
 					<td class="text-center"><?php echo "Rp.".number_format($totall).",-"; ?></td>
 					<td class="text-center"></td>
 				</tr>
 			</tfoot>
 		</table>


 		<?php 
 	
 	?>


 	<script>
 		window.print();
 		$(document).ready(function(){

 		});
 	</script>

 </body>
 </html>
