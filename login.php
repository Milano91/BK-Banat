<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BK Banat - Log in</title>
  <link rel="icon" href="images/gloves.jpg">
</head>
<body>
  <style>
    body {
      background-image:url(images/5.jpg);
      background-size: cover;

    }
  </style>
  <!-- <form action="" method='post'>
    <input type="text" name='username'> <br><br>
    <input type="password" name="password"> <br><br>
    <input type="submit" value="LOGIN" name='submit'>
    <a href="signin.php">ili idi na prijavu</a>
  </form> -->



  <?php
  include('db.php');

  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users where ime = '$username' and password = '$password'";
    $posalji = $conn->query($query);
    if($posalji->num_rows > 0){
      while($red_iz_baze = $posalji->fetch_object()){

        session_start();
        $_SESSION['id'] = $red_iz_baze->id;
        $_SESSION['ime'] = $red_iz_baze->ime;
        $_SESSION['prezime'] = $red_iz_baze->prezime;
        $_SESSION['email'] = $red_iz_baze->email;
        $_SESSION['phone'] = $red_iz_baze->phone_number;
        $_SESSION['adresa'] = $red_iz_baze->adresa;
        $_SESSION['priority'] = $red_iz_baze->priority;
        header('location: welcome.php');

      }

    }
  }

  ?>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title">Prijava</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
          <form class="form-horizontal" action="" method="post" >
            <div style="margin-bottom: 25px" class="input-group col-md-offset-3 col-md-6">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" class="form-control" name="username">
            </div>
            <div style="margin-bottom: 25px" class="input-group col-md-offset-3 col-md-6">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password">
            </div>
            <div style="margin-top:10px" class="form-group">
              <!-- Button -->
              <div class="col-sm-12 controls">
                <input i class="btn btn-success col-md-offset-3 col-md-6" value="Login" type="submit" name='submit' />
                <!-- <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a> -->
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 control">
                <div style="border-top: 1px solid#888; padding-top:15px;  text-align:right; font-size: 20px" >
                  Nemate nalog?
                  <a href="signin.php">
                    Registrujte se
                  </a>
                </div>
              </div>
            </div>
          </form>
          <!-- <form action="" method='post'>
            <input type="text" name='username'> <br><br>
            <input type="password" name="password"> <br><br>
            <input type="submit" value="LOGIN" name='submit'>
            <a href="signin.php">ili idi na prijavu</a>
          </form> -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>
