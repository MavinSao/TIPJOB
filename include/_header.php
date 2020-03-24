<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $title ?></title>
  <!-- MDB icon -->
  <link rel="icon" href="../www/img/job.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../www/css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="../www/css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet"  type="text/css" href="../www/css/style.css" media="all"/>
</head>
<body>

<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark unique-color-dark">
  <div class="container">
  <a class="navbar-brand" href="index.php"><i class="fab fa-accusoft"></i> &nbsp;TIPJOB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($page == "home" ? "active" : "")?>">
        <a class="nav-link" href="index.php">ទំពរ័ដើម</a>
      </li>
      <li class="nav-item <?php echo ($page == "question" ? "active" : "")?>">
        <a class="nav-link" href="question.php?limit=10&&offset=0">សំណួរ</a>
      </li>
      <li class="nav-item <?php echo ($page == "about" ? "active" : "")?>">
        <a class="nav-link" href="about.php">អំពីយើង</a>
      </li>
      <li class="nav-item <?php echo ($page == "contact" ? "active" : "")?>">
        <a class="nav-link" href="contact.php">ទំនាក់ទំនង</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item avatar">
        <a class="nav-link p-0" href="#">
          <img src="../www/img/mavin.jpg" class="rounded-circle z-depth-0"
            alt="avatar image" height="35">
        </a>
      </li>
    </ul>
  </div>
  </div>
</nav>
<!--/.Navbar -->