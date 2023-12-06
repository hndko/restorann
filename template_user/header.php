<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
			<p></p>
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
					} elseif($_SESSION['role']=='Admin') {
					echo '
					<li style="color:white">Halo, '.$_SESSION["name"].'
					<li><a href="admin">Admin Panel</a></li>
					<li><a href="logout.php">Keluar?</a></li>
					';
					}
					else{
						echo '
						<li style="color:white">Halo, '.$_SESSION["name"].'
						<li><a href="admin">Pimpinan Panel</a></li>
						<li><a href="logout.php">Keluar?</a></li>
						';
					}
					
				}
				?>
					
				</ul>
			</div>
			<div class="product_list_header">  
					<!-- <a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					 </a> -->
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>