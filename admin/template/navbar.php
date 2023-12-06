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