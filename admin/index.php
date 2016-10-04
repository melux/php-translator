<?php include '../assets/libs/ptms/ptms.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP translation management system - Administration</title>

  <link href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/libs/medium-editor/css/medium-editor.min.css" rel="stylesheet">
  <link href="../assets/libs/medium-editor/css/themes/bootstrap.min.css" rel="stylesheet">

  <link href="../assets/css/sample.css" rel="stylesheet">
  <link href="../assets/css/translator-admin.css" rel="stylesheet">

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
          <li><a href="../">Home</a></li>
          <li class="active"><a href="">Admin</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php if($_SESSION['lng'] == "en") {echo 'active';} ?>"><a href="?lang=en">EN</a></li>
          <li class="<?php if($_SESSION['lng'] == "fr") {echo 'active';} ?>"><a href="?lang=fr">FR</a></li>
          <li class="<?php if($_SESSION['lng'] == "es") {echo 'active';} ?>"><a href="?lang=es">ES</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1><?php __("Hello, admin!"); ?> <i class="fa fa-globe"></i></h1>
      </div>
    </div>

    <div class="row">
      <div id="translations" class="col-xs-12">
        <input class="search form-control" placeholder="Search" />
        <table class="translations-table table table-hover table-striped">
          <thead>
            <tr>
              <th><span><?php __("Translatable item"); ?></span></th>
              <th><span>EN</span></th>
              <th><span>FR</span></th>
              <th><span>ES</span></th>
          </thead>
          <tbody class="list">
          <?php
            getKeys();
            for($t=0; $t<count($_SESSION["keys"]); $t++) {
              $ts = $_SESSION["keys"][$t];
              echo "<tr>";
                echo "<td class=\"trl_key\"><span class=\"pull-left\">".$ts->trl_key."</span></td>";
                echo "<td>";
                  echo "<span class=\"trl_value trl_en pull-left\" data-lng=\"4\" data-key-id=\"".$ts->key_id."\">";
                    for($e=0; $e<count($ts->values); $e++) {
                      if($ts->values[$e]->lng_id == 4) {
                        echo $ts->values[$e]->trl_value;
                        break;
                      }
                    }
                  echo "</span>";
                  echo "<span class=\"pull-right\"><button class=\"btn btn-link btn-save\"><i class=\"fa fa-floppy-o\"></i></button></span>";
                echo "</td>";
                echo "<td>";
                  echo "<span class=\"trl_value trl_fr pull-left\" data-lng=\"5\" data-key-id=\"".$ts->key_id."\">";
                    for($e=0; $e<count($ts->values); $e++) {
                      if($ts->values[$e]->lng_id == 5) {
                        echo $ts->values[$e]->trl_value;
                        break;
                      }
                    }
                  echo "</span>";
                  echo "<span class=\"pull-right\"><button class=\"btn btn-link btn-save\"><i class=\"fa fa-floppy-o\"></i></button></span>";
                echo "</td>";
                echo "<td>";
                  echo "<span class=\"trl_value trl_es pull-left\" data-lng=\"6\" data-key-id=\"".$ts->key_id."\">";
                    for($e=0; $e<count($ts->values); $e++) {
                      if($ts->values[$e]->lng_id == 6) {
                        echo $ts->values[$e]->trl_value;
                        break;
                      }
                    }
                  echo "</span>";
                  echo "<span class=\"pull-right\"><button class=\"btn btn-link btn-save\"><i class=\"fa fa-floppy-o\"></i></button></span>";
                echo "</td>";
              echo"</tr>";
            }
          ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4">
                <ul class="pagination"></ul>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>

  <script src="../assets/libs/jquery-1.12.4.min.js"></script>
  <script src="../assets/libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/libs/list.min.js"></script>
  <script src="../assets/libs/list.pagination.min.js"></script>
  <script src="../assets/libs/medium-editor/js/medium-editor.min.js"></script>
  <script src="../assets/libs/medium-editor/extensions/autolist.min.js"></script>
  <script src="../assets/libs/noty/packaged/jquery.noty.packaged.min.js"></script>
  <script src="../assets/libs/noty/layouts/topRight.js"></script>

  <script src="../assets/js/admin.js"></script>
</body>
</html>
