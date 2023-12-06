<?php
session_start();
include '../dbconnect.php';


if (isset($_POST["addproduct"])) {
    $namaproduk = $_POST['namaproduk'];
    $idkategori = $_POST['idkategori'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $rate = $_POST['rate'];
    $hargabefore = $_POST['hargabefore'];
    $hargaafter = $_POST['hargaafter'];


    $nama_file = $_FILES['uploadgambar']['name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $random = crypt($nama_file, time());
    $ukuran_file = $_FILES['uploadgambar']['size'];
    $tipe_file = $_FILES['uploadgambar']['type'];
    $tmp_file = $_FILES['uploadgambar']['tmp_name'];
    $path = "../produk/" . $random . '.' . $ext;
    $pathdb = "produk/" . $random . '.' . $ext;


    if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
        if ($ukuran_file <= 5000000) {
            if (move_uploaded_file($tmp_file, $path)) {

                $query = "INSERT INTO `produk` VALUES (NULL,'$idkategori','$namaproduk','$pathdb','$deskripsi','$stok','$rate','$hargabefore','$hargaafter',CURRENT_TIMESTAMP)";
                $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

                if ($sql) {
                    echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
                } else {
                    // Jika Gagal, Lakukan :
                    echo "Sorry, there's a problem while submitting.";
                    echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
                }
            } else {
                // Jika gambar gagal diupload, Lakukan :
                echo "Sorry, there's a problem while uploading the file.";
                echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
            }
        } else {
            // Jika ukuran file lebih dari 1MB, lakukan :
            echo "Sorry, the file size is not allowed to more than 1mb";
            echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
        }
    } else {
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "Sorry, the image format should be JPG/PNG.";
        echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
    }
};

if (isset($_POST["edit"])) {
    $namaproduk = $_POST['namaproduk'];
    $idproduk = $_POST['idproduk'];
    $idkategori = $_POST['idkategori'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $update = mysqli_query($conn, "UPDATE `produk` SET `idkategori`='$idkategori',`namaproduk`='$namaproduk',`deskripsi`='$deskripsi',`stok`='$stok',`hargaafter`='$harga' WHERE `idproduk`='$idproduk'");
    if ($update) {
        echo "
            <script>
                alert('Data berhasil diperbaharui');
                window.location.href='';
            </script>
        ";
    } else {
        echo "error : " . mysqli_error($conn);
    }
};

if (isset($_POST["hapus"])) {
    $idproduk = $GET['idproduk'];
    mysqli_query($conn, "DELETE FROM produk WHERE idproduk = '$idproduk';");
    if ($update) {
        echo "
            <script>
                alert('Data berhasil dihapuskan');
                window.location.href='';
            </script>
        ";
    } else {
        echo "error : " . mysqli_error($conn);
    }
};
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Menu - Depot Moro Seneng</title>
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
                        <ul class="metismenu" id="menu">
                            <li><a href="index.php"><span>Home</span></a></li>
                            <li><a href="../"><span>Kembali ke Halaman Utama</span></a></li>
                            <li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola
                                        Restoran
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="kategori.php">Kategori</a></li>
                                    <li class="active"><a href="produk.php">Menu</a></li>
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
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                                                'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];
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
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- page title area end -->
            <div class="main-content-inner">

                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h2>Daftar Menu</h2>
                                    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Produk</button>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Gambar</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Harga Diskon</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Rate</th>
                                                <th>Harga Awal</th>
                                                <th>Tanggal</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $brgs = mysqli_query($conn, "SELECT * from kategori k, produk p where k.idkategori=p.idkategori order by idproduk ASC");
                                            $no = 1;
                                            while ($p = mysqli_fetch_array($brgs)) {

                                            ?>

                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><img src="../<?php echo $p['gambar'] ?>" width="50%" \></td>
                                                    <td><?php echo $p['namaproduk'] ?></td>
                                                    <td><?php echo $p['namakategori'] ?></td>
                                                    <td><?php echo $p['hargaafter'] ?></td>
                                                    <td><?php echo $p['deskripsi'] ?></td>
                                                    <td><?php echo $p['stok'] ?></td>
                                                    <td><?php echo $p['rate'] ?></td>
                                                    <td><?php echo $p['hargabefore'] ?></td>
                                                    <td><?php echo $p['tgldibuat'] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a data-toggle="modal" data-placement="bottom" title="Edit Data" href="#edit<?= $p['idproduk'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-produk.php?idproduk=<?php echo $p['idproduk']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>

                                                    <?php $idp = $p['idproduk'] ?>

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
            </div>


            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>By Depot Moro Seneng</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Menu</h4>
                </div>

                <div class="modal-body">
                    <form action="produk.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input name="namaproduk" type="text" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select name="idkategori" class="form-control">
                                <option selected>Pilih Kategori</option>
                                <?php
                                $det = mysqli_query($conn, "select * from kategori order by namakategori ASC");
                                while ($d = mysqli_fetch_array($det)) {
                                ?>
                                    <option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input name="deskripsi" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input name="stok" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Rating (1-5)</label>
                            <input name="rate" type="number" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Sebelum Diskon</label>
                            <input name="hargabefore" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Harga Setelah Diskon</label>
                            <input name="hargaafter" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input name="uploadgambar" type="file" class="form-control" accept=".png, .jpeg">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input name="addproduct" type="submit" class="btn btn-primary" value="Tambah">
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    <?php
    $brgs = mysqli_query($conn, "SELECT * from produk");
    $no = 1;
    while ($p = mysqli_fetch_array($brgs)) {
    ?>
        <div class="modal fade" id="edit<?= $p['idproduk'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="produk.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Id Produk</label>
                                <input name="idproduk" value="<?php echo $p['idproduk'] ?>" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input name="namaproduk" value="<?php echo $p['namaproduk'] ?>" type="text" class="form-control" required autofocus>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Kategori</label>
                                    <select name="idkategori" class="form-control" required>
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $idkategori = $p['idkategori'];
                                        $q3 = mysqli_query($conn, "SELECT * FROM kategori ");
                                        while ($d3 = mysqli_fetch_array($q3)) {
                                            $selected = ($d3['idkategori'] == $idkategori) ? 'selected' : ''; // Menandai opsi yang sesuai dengan ID alternatif
                                        ?>
                                            <option value="<?= $d3['idkategori'] ?>" <?= $selected ?>><?= $d3['namakategori'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input name="deskripsi" type="text" value="<?php echo $p['deskripsi'] ?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input name="stok" type="text" value="<?php echo $p['stok'] ?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input name="harga" type="number" value="<?php echo $p['hargaafter'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input name="uploadgambar" type="file" class="form-control" accept=".png, .jpeg">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input name="edit" type="submit" class="btn btn-primary" value="Edit">
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
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
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