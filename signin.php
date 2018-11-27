<?php
include("db.php");
if(isset($_POST['submit'])){
  $uploadOk = 1;
  $targetFolder = 'userUploads/';
  $imgForUpload = basename($_FILES['img']['name']);
  $targetfile = $targetFolder . basename($_FILES['img']['name']);
  $imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
  echo $imageFileType;
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  if (file_exists($targetfile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if ($_FILES["img"]["size"] > 50000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo "greska prilikom ucitavanja fajla";
  }
  else {
    move_uploaded_file($_FILES["img"]["tmp_name"], $targetfile);
  }
  $username = $_POST['name'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $adresa = $_POST['adresa'];
  $password = $_POST['password'];
  if($username != '' && $email != ''){
    $query = "insert into users(ime, prezime, email, phone_number, adresa, password, priority, img)
    values('$username', '$lastname', '$email', '$phone', '$adresa', '$password', '1', '$imgForUpload')";
    $poslato = $conn->query($query);
    if($poslato){
      $lastId = $conn->insert_id;
    }



    session_start();
    $_SESSION['id'] = $lastId;
    $_SESSION['ime'] = $username;
    $_SESSION['prezime'] =$lastname;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['adresa'] = $adresa;

    header('location: user.php');
  }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BK Banat - Sign In</title>
  <link rel="icon" href="images/gloves.jpg">
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="style.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<style>

body {
  background-image: url(images/11.jpg);
  background-size: cover;
}

</style>
<body>
  <div class="login-page">
    <div class="form">
      <form class="register-form" action="" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="name" name="name" minlength="3" maxlength="12"/>
        <!-- uradi validaciju za sva polja po tvom izboru! -->

        <input type="text" placeholder="lastname" name="lastname"/>
        <!-- igraj se sa patternima kuci -->

        <input type="text" placeholder="email" name="email"/>

        <input type="tel" placeholder="0641234567" name="phone"/>
        <!-- pattern="[0-9]{9}" primeni u telefon -->
        <input type="text" placeholder="address" name="adresa" />

        <input type="password" placeholder="password" name="password">
        <input type="file" name="img">
        <button name="submit" id="create">create</button>
        <p class="message">Imate nalog? <a href="login.php">Ulogujte se</a></p>
      </form>
    </div>
  </div>


</body>
</html>
