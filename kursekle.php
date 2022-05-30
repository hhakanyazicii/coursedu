<?php include 'connect.php' ?>
<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coursedu</title>
    <!-- CSS only -->
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
<style>
    .wrapper{ width: 360px; padding: 20px; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php" >Coursedu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Anasayfa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Kurslar</a>
      </li>
      <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Kategoriler
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <?php 
    $query = "SELECT * FROM kategori";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            echo "<li><a class='dropdown-item' href='kategori.php?id=". $row[0] . "'>" . $row[1] . "</a></li>" ;
        } ?>
  </ul>
</div>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    <?php 
     if(@$_SESSION['username'] === 'admin') { ?>
      <li class='nav-item'>
      <a class='nav-link' href='#'>Profilim</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='admin.php'>Admin Panel</a>
    </li>
    
    <li class='nav-item'>
    <a class='nav-link' href='logout.php'>Çıkış Yap</a>
    </li>
    <?php } elseif(@$_SESSION['username'] && @$_SESSION['usertipi'] === '0') { ?> 
      <li class='nav-item'>
      <a class='nav-link' href='#'>Profilim</a>
    </li>
      <li class='nav-item'>
      <a class='nav-link' href='#'>Kurslarım</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='#'>Sepet</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='logout.php'>Çıkış Yap</a>
    </li>
      <?php } elseif(@$_SESSION['username'] && @$_SESSION['usertipi'] === '1') { ?> 
        <li class='nav-item'>
      <a class='nav-link' href='#'>Profilim</a>
    </li>
      <li class='nav-item'>
      <a class='nav-link' href='kursekle.php'>Kurs Ekle</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='logout.php'>Çıkış Yap</a>
    </li>
        <?php } else { ?>
      <li class='nav-item'>
      <a class='nav-link' href='login.php'>Giriş Yap</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='signup.php'>Kayıt Ol</a>
    </li>
     <?php }; ?>
    
      </ul>
  </div>
</nav>
<form action="kurspost.php" method="POST" class="container" enctype="multipart/form-data">
<input type="text" class="form-control" name="kursadi" id="kursadi">

      <input type="text" class="form-control" name="kursFiyati" id="kursFiyati">
  
      <input type="text" class="form-control" name="kursAciklamasi" id="kursAciklamasi">
  
      <input type="file" class="custom-file-input" name="kursResim" id="kursResim">
      <select name="kategori" id="kategori">
      <?php 
          $query = "SELECT * FROM kategori";
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            echo "<option value='$row[0]'>". $row[1] . "</option>" ;
        } ?>
      </select>
      <input class="btn btn-primary"  type="submit" name="ekle">Ekle</input>
</form>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>