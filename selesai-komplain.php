<?php 
            include 'dbconnect.php';
            $id = $_GET['orderid'];
            
            $query = mysqli_query($conn, "update cart set status='Selesai' where orderid='$id'");
            if($query){
                echo "Komplain Selesai $id
                <meta http-equiv='refresh' content='1; url= index.php'/>";
            } else {
                echo "Gagal 
                <meta http-equiv='refresh' content='1; url= index.php'/>";
            }
                ?>