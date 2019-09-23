<?php 
require_once("environment.php");
HTML::printPageHeader("L&ouml;schen");
HTML::printCaption("K&uuml;nstlers L&ouml;schen",1);
$del = new KuenstlerGateway();
$check = false; 

if(isset($_REQUEST['id']))
{
	$id = $_REQUEST['id'];
	$daten = $del->findById($id);
}
	
if(isset($_REQUEST['delId']))
{
	$delId = $_REQUEST['delId'];
	$delName = $_REQUEST['delName'];
	$check = true;
	$del->delete($delId);
}


if($check === false)
{
	echo '<p>Soll der K&uuml;nstler <b>'. $daten->getName() .'</b> wirklich gel&ouml;scht werden?</p><br>';
	echo '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">';
	echo '<input type="hidden" value="'. $daten->getId() .'" name="delId">';
	echo '<input type="hidden" value="'. $daten->getName() .'" name="delName">';
	echo '<p><input type="submit" value="L&ouml;schen" ></p>';
	echo '</form>';
	
	HTML::back_button("Oder zur&uuml;ck zur Liste...","alle_kuenstler.php","Zur&uuml;ck");
}
elseif($check === true)
{
	echo '<p>Der K&uuml;nstler <b>'. $delName .'</b> mit der ID: '. $delId .' wurde gel&ouml;scht!</p><br>';
	HTML::back_button("Zur Liste ","alle_kuenstler.php","Zur&uuml;ck");
}
?>