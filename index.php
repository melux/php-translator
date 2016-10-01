<?php include 'assets/libs/ptms/ptms.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP translation management system</title>

  <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link href="assets/css/sample.css" rel="stylesheet">

</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">PHP Translations management system</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="">Home</a></li>
          <li><a href="admin/">Admin</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php if($_SESSION['lng'] == "en") {echo 'active';} ?>"><a href="en">EN</a></li>
          <li class="<?php if($_SESSION['lng'] == "fr") {echo 'active';} ?>"><a href="fr">FR</a></li>
          <li class="<?php if($_SESSION['lng'] == "es") {echo 'active';} ?>"><a href="es">ES</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1><?php __("Hello world!"); ?> <i class="fa fa-globe"></i></h1>
        <h2><?php __("Welcome"); ?></h2>
        <h3><?php __("Goodbye"); ?></h3>
        <h4><?php __("Good night"); ?></h4>
        <h5><?php __("Good evening"); ?></h5>
      </div>
    </div>
  </div>

  <script src="assets/libs/jquery-1.12.4.min.js"></script>
  <script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
