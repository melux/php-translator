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

$_SESSION['translations'] = getTranslations($_SESSION['lngs'][$_SESSION['lng']]);

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

  $_SESSION['keys'] = $keys;
}

if($_POST['setTranslation'] == true) {
  $lang_id = $mysqli->real_escape_string($_POST['lang_id']);
  $key_id = $mysqli->real_escape_string($_POST['key_id']);
  $value = $mysqli->real_escape_string($_POST['value']);

  setValue($lang_id, $key_id, $value);
}

function setValue($lang_id, $key_id, $value) {
  global $mysqli;

  $return = array();
  $return["type"] = "update";
  $q="SELECT trl_values.trl_id from trl_values WHERE trl_values.key_id='".$key_id."' AND trl_values.lng_id='".$lang_id."'";
  $qr = mysqli_query($mysqli,$q);
  if($qr && mysqli_num_rows($qr) ===0 ) {
    $qu = "INSERT INTO trl_values (`trl_id`,`lng_id`,`key_id`,`trl_value`) VALUES (NULL,".$lang_id.",".$key_id.",'".$value."');";
    $return["type"] = "create";
  }else{
    $qu = "UPDATE trl_values t SET t.trl_value='".$value."' WHERE t.lng_id=".$lang_id." AND t.key_id=".$key_id;
    $return["type"] = "update";
	}

  $qur = mysqli_query($mysqli,$qu);
  if($qur) {
    $return["status"] = true;
  }else{
    $return["status"] = false;
  }

  $response = json_encode($return, JSON_FORCE_OBJECT);
	echo $response;

}

?>
