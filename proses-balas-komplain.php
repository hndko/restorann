<?php 
    // include 'dbconnect.php';

    // $idkomplain = $_POST['idkomplain'];
    // $userid = $_POST['userid'];
    // $pesan = $_POST['pesan'];
    // $detail = date('Y-m-d H:i:s');

    // $query = "insert into pesankomplain (idkomplain, userid, pesan, detail)
    // values('$idkomplain','$userid','$pesan','$detail')";
    // $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
        
    // if($sql){ 
    //     echo "<br><meta http-equiv='refresh' content='1; URL=halaman sebelumnya'> You will be redirected to the form in 5 seconds";
    // }else{
            
    // }
		
?>

<?php 

    include 'dbconnect.php';
    
    $idkomplain = $_POST['idkomplain'];
    $userid = $_POST['userid'];
    $pesan = $_POST['pesan'];
    $detail = date('Y-m-d H:i:s');
    
    $query = "insert into pesankomplain (idkomplain, userid, pesan, detail)
    values('$idkomplain','$userid','$pesan','$detail')";
    $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
        
    if ($sql) { 
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Penanganan kesalahan jika query gagal
    }

    
   
    ?>