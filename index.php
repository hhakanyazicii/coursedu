<?php include 'connect.php' ?>
<?php session_start(); ?>
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
  body {
    background-color: rgb(66, 66, 66);
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Coursedu</a>
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
    <a class='nav-link' href='logout.php'>????k???? Yap</a>
    </li>
    <?php } elseif(@$_SESSION['username'] && @$_SESSION['usertipi'] === '0') { ?> 
      <li class='nav-item'>
      <a class='nav-link' href='#'>Profilim</a>
    </li>
      <li class='nav-item'>
      <a class='nav-link' href='#'>Kurslar??m</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='#'>Sepet</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='logout.php'>????k???? Yap</a>
    </li>
      <?php } elseif(@$_SESSION['username'] && @$_SESSION['usertipi'] === '1') { ?> 
        <li class='nav-item'>
      <a class='nav-link' href='#'>Profilim</a>
    </li>
      <li class='nav-item'>
      <a class='nav-link' href='kursekle.php'>Kurs Ekle</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='logout.php'>????k???? Yap</a>
    </li>
        <?php } else { ?>
      <li class='nav-item'>
      <a class='nav-link' href='login.php'>Giri?? Yap</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='signup.php'>Kay??t Ol</a>
    </li>
     <?php }; ?>
    
      </ul>
  </div>
</nav>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/2.jpg" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/udemy.jpg" class="d-block w-50" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<<div class="container">
        <div class="row">
            
<?php
          $kurslarDeneme = "SELECT * FROM kurslar INNER JOIN img ON kurslar.img_id=img.id INNER JOIN kurs_veren ON kurslar.id=kurs_veren.kurs_id INNER JOIN user ON kurs_veren.uye_id=user.id;";
          $kurslarSRC=mysqli_query($conn, $kurslarDeneme);
          while ($row = mysqli_fetch_array($kurslarSRC, MYSQLI_BOTH)) {
           ?>

<div class="card" style="width: 18rem; margin-left:20px; margin-bottom:20px;">
  <img class="card-img-top" src="images/<?php echo $row[7] ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row[1] ?></h5>
    <p class="card-text">Kurs A????klamas??: <?php echo $row[3] ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Fiyat: <?php echo $row[2] ?> TL</li>
    <li class="list-group-item">E??itmen: <?php echo $row[12] ?></li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
  </div>
</div>

<?php ;
        } ?> 
</div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>