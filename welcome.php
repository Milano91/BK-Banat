<?php
session_start();
if(isset($_SESSION['priority']) && ($_SESSION['priority'] == 3)){
  $ime = $_SESSION['ime'];
}
elseif (isset($_SESSION['priority']) && ($_SESSION['priority'] == 1)) {
  header('Location: user.php');
}
else {
  header('Location: login.php');
}
include('db.php');
$message = '';
if(isset($_POST['objavi'])){
  $uploadOk = 1;
  $targetFolder = 'newsUploads/';
  $imgForUpload = basename($_FILES['img']['name']);
  $targetfile = $targetFolder . $imgForUpload;
  $imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  if (file_exists($targetfile)) {
    $message = "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if ($_FILES["img"]["size"] > 500000) {
    $message = "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    $message = "Greska prilikom ucitavanja fajla";
  }
  else {
    move_uploaded_file($_FILES["img"]["tmp_name"], $targetfile);
    $naslov = $_POST['naslov'];
    $sadrzaj = $_POST['sadrzaj'];

    $query = "INSERT into vesti (naslov, sadrzaj, img) VALUES ('$naslov', '$sadrzaj', '$imgForUpload');";
    $posalji = $conn->query($query);
  }

}
if (isset($_POST['change'])) {
  $idForChenge = $_POST['id'];
  $newHeadline = $_POST['naslov'];
  $newContent = $_POST['sadrzaj'];
  $queryChn = "UPDATE vesti set naslov = '$newHeadline', sadrzaj = '$newContent' WHERE id = '$idForChenge';";
  $chn = $conn->query($queryChn);
}
if (isset($_POST['delete'])) {
  $idForDelete = $_POST['id'];
  $queryDel = "DELETE FROM vesti WHERE id = '$idForDelete';";
  $del = $conn->query($queryDel);
}

$newsRequest = "SELECT * FROM vesti ORDER BY id DESC limit 4";
$newsQuery = $conn->query($newsRequest);
while ($newsRow = $newsQuery->fetch_object()) {
  $newsIds[] = $newsRow->id;
  $newsHeadlines[] = $newsRow->naslov;
  $newsContent[] = $newsRow->sadrzaj;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <title>Administrator</title>
  <link rel="icon" href="images/gloves.jpg">
</head>
<style>
body {
  background-image:url(images/9.jpg);
  background-size: cover;
}
.hocuCursor{
  cursor: pointer;
  margin-left: 10px;
}
.personal{
  margin-left: 365px;
  font-weight: bold;
  color: black;
  font-size: 25px;
}
form{
  margin-top: 15px;
  margin-bottom: 35px;
  border: 1px solid white;
  padding: 10px;
}
form label{
  color:white;
}
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="btn btn-info my-2 my-sm-0" href="user.php">Početna <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a href='' class="btn btn-info my-2 my-sm-0 hocuCursor" data-toggle="modal" data-target="#exampleModal">Dodaj novu vest</a>
        </li>
        <li class="nav-item active personal">
          ADMINISTRATOR
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
        <input type="submit" class="btn btn-info my-2 my-sm-0" name="submit" value="Odjavi se">
      </form>
    </div>
  </nav>
  <!-- ovde praviti logiku za iscitavanje vesti -->
  <div class="col-lg-4 col-md-4">
    <?php
      for ($i=0; $i < count($newsContent); $i++) {
        echo '
        <form action="" method="post">
        <div class="form-group row">
        <input type="text" hidden name="id" value="' . $newsIds[$i] . '">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Naslov</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="naslov" value="' . $newsHeadlines[$i] . '">
        </div>
        </div>
        <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Sadržaj</label>
        <div class="col-sm-10">
        <textarea type="text" class="form-control" name="sadrzaj">' . $newsContent[$i] . '</textarea>
        </div>
        </div>
        <div class="form-group row">
        <div class="col-sm-12 text-right">
        <button type="submit" class="btn btn-primary" name="change">Izmeni vest</button>
        <button type="submit" class="btn btn-primary" name="delete">Obriši vest</button>
        </div>
        </div>
        </form>';
      }
    ?>
  </div>
  <div class="col-lg-4 col-md-4">

  </div>
  <div class="col-lg-4 col-md-4">

  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nova vest</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Naslov</label>
              <input type="text" class="form-control" name="naslov">
            </div>
            <div class="form-group">
              <label>Slika</label>
              <input type="file" class="form-control" name="img">
            </div>
            <div class="form-group">
              <label>Sadrzaj</label>
              <textarea type="password" class="form-control" name="sadrzaj"></textarea>
            </div>
            <?php
            if($message){
              echo "<div class='alert alert-danger'>";
              echo $message;
              echo "</div>";
            }
             ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Izadji</button>
            <button type="submit" class="btn btn-primary" name="objavi">Objavi</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" ></script>
</body>
</html>
