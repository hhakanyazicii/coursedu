<?php include 'connect.php' ?>
<?php
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn,$username);
	$sifre = stripslashes($_REQUEST['password']);
	$sifre = mysqli_real_escape_string($conn,$sifre);
  $usertipi = stripslashes($_REQUEST['usertipi']);
  $usertipi = mysqli_real_escape_string($conn,$usertipi);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `user` WHERE username='$username'
AND sifre='".md5($sifre)."' AND user_tipi='$usertipi'";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);
        if($rows==1){    
	    $_SESSION['username'] = $username;
      $_SESSION['usertipi'] = $usertipi;
            // Redirect user to index.php
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
<h3>Kullanıcı ad veya şifre yanlış.</h3>
<br/>Giriş yapmak için <a href='login.php'>tıklayınız.</a></div>";
	}
    }else{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
<style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <!-- NAVBAR START -->
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
          $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                  echo "<li><a class='dropdown-item' href='kategori.php?id=". $row[0] . "'>" . $row[1] . "</a></li>" ;
              } ?>
  </ul>
</div>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
    <li class="nav-item">
        <a class="nav-link" href="login.php">Giriş Yap</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Kayıt Ol</a>
      </li>
      </ul>
  </div>
</nav>
<!-- NAVBAR END -->
<div class="wrapper container form-floating">
<h1 style="color:white;">Giriş</h1>
<form action="login.php" method="post" name="login">
<input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı" required />
<br>
<input type="password" class="form-control" name="password" placeholder="Şifre" required />
<br>
<select name="usertipi" class="form-control" id="usertipi">
  <option value="0">Öğrenci</option>
  <option value="1">Öğretmen</option>
  <option value="2">Admin</option>
</select>
<br>
<input name="submit" class="w-100 btn btn-lg btn-primary" type="submit" value="Login" />
</form>
    </div>
</body>
<?php } ?>
</html>