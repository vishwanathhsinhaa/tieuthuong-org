<?php
// This script and data application were generated by AppGini 5.31
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	header("Content-type: text/javascript; charset=UTF-8");

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// no js code available!');
	}

	switch($mfk){

		case 'property':
			if(!$id){
				?>
				$('country<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				$('street<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				$('city<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				$('state<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				$('postal_code<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `properties`.`id` as 'id', `properties`.`property_name` as 'property_name', `properties`.`type` as 'type', `properties`.`number_of_units` as 'number_of_units', `properties`.`photo` as 'photo', IF(    CHAR_LENGTH(`rental_owners1`.`first_name`) || CHAR_LENGTH(`rental_owners1`.`last_name`), CONCAT_WS('',   `rental_owners1`.`first_name`, ' ', `rental_owners1`.`last_name`), '') as 'owner', `properties`.`operating_account` as 'operating_account', CONCAT('$', FORMAT(`properties`.`property_reserve`, 2)) as 'property_reserve', `properties`.`lease_term` as 'lease_term', `properties`.`country` as 'country', `properties`.`street` as 'street', `properties`.`City` as 'City', `properties`.`State` as 'State', `properties`.`ZIP` as 'ZIP' FROM `properties` LEFT JOIN `rental_owners` as rental_owners1 ON `rental_owners1`.`id`=`properties`.`owner`  WHERE `properties`.`id`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$('country<?php echo $rnd1; ?>').innerHTML = '<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['country']))); ?>&nbsp;';
			$('street<?php echo $rnd1; ?>').innerHTML = '<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['street']))); ?>&nbsp;';
			$('city<?php echo $rnd1; ?>').innerHTML = '<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['City']))); ?>&nbsp;';
			$('state<?php echo $rnd1; ?>').innerHTML = '<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['State']))); ?>&nbsp;';
			$('postal_code<?php echo $rnd1; ?>').innerHTML = '<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['ZIP']))); ?>&nbsp;';
			<?php
			break;


	}

?>