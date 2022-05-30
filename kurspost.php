<?php

use LDAP\Result;

 include 'connect.php' ?>

<?php 
try {
    session_start();
    $filename = $_FILES["kursResim"]["name"];
    $tempname = $_FILES["kursResim"]["tmp_name"];   
    // $folder = "images/".$filename;
    move_uploaded_file($tempname,'images/'.$filename);

    $sql = "INSERT INTO img (filename) VALUES ('$filename')";
 
        // Execute query
        mysqli_query($conn, $sql);

    $resimID = mysqli_insert_id($conn);
    

    
        // removes backslashes
    $kursadi = stripslashes($_POST['kursadi']) ;
    
    $kursFiyati = stripslashes($_POST['kursFiyati']);
    
    $kursAciklamasi = stripslashes($_POST['kursAciklamasi']);
    
    $kategoriID = stripslashes($_POST['kategori']);
    //Checking is user existing in the database or not
    $query    = "INSERT INTO `kurslar` (adi,fiyat, aciklama, img_id, kategori_id)
    VALUES ('$kursadi','$kursFiyati','$kursAciklamasi',$resimID,$kategoriID);";
    $result   = mysqli_query($conn, $query); 

    $kursSonEklenenID = mysqli_insert_id($conn);
    $kursVerenID = "SELECT * FROM user WHERE username = '" . $_SESSION['username'] . "'";
    $queryKursVerenID = mysqli_query($conn, $kursVerenID);
    $kursverenResult = $queryKursVerenID->fetch_array()['id'] ?? '';

     $queryKursVeren = "INSERT INTO `kurs_veren` (uye_id,kurs_id) VALUES ($kursverenResult,$kursSonEklenenID);";
     $resultKursVeren = mysqli_query($conn,$queryKursVeren);
    header("Location: index.php");

    } 

    

    catch(Exception $e) {
        echo $e;
    }

?>