<?php ob_start(); ?>
<center>

<?php

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	$memberID = db_escape(strtolower($_GET['memberID']), db_link());
	if($memberID!=''){
		$res=sql("select memberID from membership_users where lcase(memberID)='$memberID'", $eo);
		if($row=db_fetch_row($res)){
			echo "<b>".str_replace("<MemberID>", $memberID, $Translation['user already exists'])."</b><!-- NOT AVAILABLE -->";
		}else{
			echo "<b>".str_replace("<MemberID>", $memberID, $Translation['user available'])."</b><!-- AVAILABLE -->";
		}
	}else{
		echo $Translation['empty user'];
	}
?>

<br><br><input type="button" value="Close" onClick="window.close();">
</center>
