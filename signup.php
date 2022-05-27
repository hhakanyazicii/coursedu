<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
</head>
<style>
    .form {
    margin: 50px auto;
    width: 300px;
    padding: 30px 25px;
    background: white;
}
h1.login-title {
    color: #666;
    margin: 0px auto 25px;
    font-size: 25px;
    font-weight: 300;
    text-align: center;
}
.login-input {
    font-size: 15px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 25px;
    height: 25px;
    width: calc(100% - 23px);
}
.login-input:focus {
    border-color:#6e8095;
    outline: none;
}
.login-button {
    color: #fff;
    background: #55a1ff;
    border: 0;
    outline: 0;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
}
.link {
    color: #666;
    font-size: 15px;
    text-align: center;
    margin-bottom: 0px;
}
.link a {
    color: #666;
}
h3 {
    font-weight: normal;
    text-align: center;
}
</style>
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
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
<?php   
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $ad = stripslashes($_REQUEST['ad']);
        $ad = mysqli_real_escape_string($conn,$ad);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $usertipi = stripslashes($_REQUEST['usertipi']);
        $usertipi = mysqli_real_escape_string($conn,$usertipi);
        $query    = "INSERT into `user` (username,ad, password, email, user_tipi)
                     VALUES ('$username','$ad', '" . md5($password) . "', '$email', '$usertipi')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Kayıt Başarılı.</h3><br/>
                  <p class='link'>Giriş yapmak için <a href='login.php'>tıklayınız.</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Gerekli alanlar boş.</h3><br/>
                  <p class='link'>Tekrar kayıt olmak için <a href='registration.php'>tıklayın.</a>.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Kayıt</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="ad" placeholder="Ad">
        <label for="usertipi">Kullanıcı Tipi:
        <select name="usertipi" class="login-input" id="usertipi">
            <option value="0">Öğrenci</option>
            <option value="1">Eğitmen</option>
        </select>
        </label>
        <input type="text" class="login-input" name="email" placeholder="Email">
        <input type="password" class="login-input" name="password" placeholder="Şifre">
        <input type="submit" name="submit" value="Kayıt Ol" class="login-button">
        <p class="link"><a href="login.php">Giriş yapmak için tıklayın</a></p>
    </form>
<?php
    }
?>
</body>
</html>