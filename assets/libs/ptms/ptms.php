<?php

$baseurl = "/work/shifoome/php-translator/";

include 'inc.php';

session_start();

if(!$_SESSION['lng']) {
  $_SESSION['lng'] = "en";
}
$_SESSION['lngs'] = array("en"=>4,"fr"=>5,"es"=>6);
$_SESSION['translations'] = array();

if($_GET['lang']) {
  $_SESSION['lng'] = $_GET['lang'];
}

function getTranslations($lng) {
  global $mysqli;
  $q = "SELECT trl_values.trl_value, trl_keys.trl_key from trl_values INNER JOIN trl_keys ON trl_values.key_id = trl_keys.key_id WHERE trl_values.lng_id='".$_SESSION['lngs'][$_SESSION['lng']]."'";
  $rs = mysqli_query($mysqli, $q);

	if($rs) {
		while($obj = mysqli_fetch_object($rs)) {
      $_SESSION['translations'][$obj->trl_key] = $obj->trl_value;
		}
	}

  return $_SESSION['translations'];
}

function setTranslation() {
  global $mysqli;
  $_SESSION['translations'] = getTranslations($_SESSION['lngs'][$_SESSION['lng']]);
}

setTranslation();

function __($keyt) {
  $translation = $keyt;

  if($_SESSION['translations'][$keyt]) {
    $translation = $_SESSION['translations'][$keyt];
  }else{
    if($_GET["scan"] == "true") {
      $lngs = array();
      global $mysqli;

      $l = "SELECT * from trl_keys WHERE trl_key='".$keyt."'";
    	$sl = mysqli_query($mysqli, $l);
      $translation .= mysqli_error($mysqli);
    	if($sl) {
    		while($obj = mysqli_fetch_object($sl)) {
    			$lngs[] = $obj;
    		}
    		if(count($lngs) == 0)
    		{
    			$q = "INSERT INTO trl_keys (`key_id`,`trl_key`) VALUES (NULL,'".$keyt."');";
    			$rs = mysqli_query($mysqli, $q);
    			if($rs) {
    				$translation .= " <span class=\"label label-info\">new key added</span>";
    			}else{
            $translation .= " <span class=\"label label-danger\">error adding new key: ".mysqli_error($mysqli)."</span>";
    			}
    		}
        $translation .= " <span class=\"label label-warning\">not translated</span>";
    	}else{
    		$translation .= " <span class=\"label label-danger\">error searching in keys: ".mysqli_error($mysqli)."</span>";
    	}
    }
  }
  echo $translation;
}

/* ADMIN PART */

function getKeys() {
  global $mysqli;
  $keys = array();
  $q = "SELECT * from trl_keys";
  $rs = mysqli_query($mysqli, $q);

	if($rs) {
		while($obj = mysqli_fetch_object($rs)) {
      $keys[] = $obj;
		}
	}

  $values = array();
  $v = "SELECT * from trl_values";
  $rv = mysqli_query($mysqli, $v);

	if($rv) {
		while($objv = mysqli_fetch_object($rv)) {
      $values[] = $objv;
		}
	}

  for($k=0; $k<count($keys); $k++) {
    $kn = $keys[$k];
    $kn->values = array();
    for($v=0; $v<count($values); $v++) {
      $vn = $values[$v];
      if($kn->key_id == $vn->key_id) {
        array_push($kn->values, $vn);
      }
    }
  }



  /*for($k=0; $k<count($keys); $k++) {
    $qk = "SELECT * FROM trl_values WHERE trl_values.key_id='".$keys[$k]['key_id']."'";
    $rsk = mysqli_query($mysqli, $qk);
    if($rsk) {
      while($objk = mysqli_fetch_object($rsk)) {
        $keys[$k]['values'] = $objk;
      }
    }
  }*/

  $_SESSION['keys'] = $keys;
}

?>
