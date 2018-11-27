<?php
include('db.php');
?>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>BK Banat - Home</title>
  <!-- ubaciti ikonicu -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="style1.css">
  <link rel="icon" href="images/gloves.jpg">


</head>
<body>
  <div class="container">

    <div class="logo row">
      <div class="col-md-4 col-sm-4">
        <img src="images/logo.jpg" alt="BKBanat logo">
      </div>
      <div class="col-md-4 col-sm-4">
        <p>BOKSERSKI KLUB</p>
        <p>BANAT</p>

      </div>
      <div class="col-md-4 logo2 col-sm-4">
        <img src="images/zrlogo.jpg" alt="ZRLOGO" class="zrlogo">
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark nas_nav">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto milan">
          <li class="nav-item active ">
            <a class="nav-link" href="?page=1">Početna <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form action="logout.php" class="form-inline my-2 my-lg-0">
          <a href="login.php" class="btn btn btn-info my-2 my-sm-0 logout">Prijavi se</a>
        </form>
      </div>
    </nav>
    <div class="glavni">
      <?php
        include 'modules/pocetna.php';
      ?>
      <br><br>
    </div>

    <footer>
      <div class="container row">
        <div class="col-md-6">
          <h3>Kako do nas</h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1532.6977199670253!2d20.398727689578077!3d45.38516749326162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475adb3f8e32f1bd%3A0x7f96b2c88ee8fd29!2sKristalna+Dvorana!5e1!3m2!1sen!2sjo!4v1531053532668" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6" >
          <h3>Kontakt</h3>
          <ul>
            <li>Telefon: 0638803928 trener Milivoj Sojic <br><br>
             0631999700 Dragan Sojic</li>
            <li>E-mail :kovica70@gmail.com</li>
            <li></li>
          </ul>
          <p style="font-size: 20px;">
            Boks klub "Banat" vrsi upis u <b>besplatnu</b> skolu boksa.
          </p>
          <ul class="sm">
            <li><a target="_blank" href="https://www.facebook.com/bokserskiklub.banatzrenjanin.1" ><img src="https://www.facebook.com/images/fb_icon_325x325.png" class="img-responsive"></a></li>
            <li><a href="#" ><img src="images/insta.jpg" class="img-responsive" ></a></li>
          </ul>
        </div>
      </div>

    </footer>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" ></script>
</body>

</html>
