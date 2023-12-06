<?php 
	session_start();
	include '../dbconnect.php';

    $resolusi = $_POST['resolusi'];
    $idorder = $_POST['idorder'];

	if(isset($_POST["edit"])){

        $q3 = mysqli_query($conn, "UPDATE komplain SET resolusi='$resolusi' WHERE orderid = '$idorder'");
        if ($q3) {
            echo "Berhasil Menambahkan Resolusi";
            header("Refresh: 1; url=feedback.php");
        } else {
            echo "Gagal Menambahkan Resolusi: " . mysqli_error($conn);
            header(" url=feedback.php");
        }
    }
	?>