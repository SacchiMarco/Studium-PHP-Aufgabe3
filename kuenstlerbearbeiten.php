<?php 
require_once("environment.php");
HTML::printPageHeader("Bearbeiten");
HTML::printCaption("Bearbeiten Sie den Namen des K&uuml;nstlers",1);
$kuenstlerTable = new KuenstlerGateway();
$update = false;
	if(isset($_REQUEST['id']) and isset($_REQUEST['kuenstler']))
	{
		$id = $_REQUEST['id'];
	}
		
	if(isset($_REQUEST['update']))
	{
		$id = $_REQUEST['update'];
		
		if(empty($_REQUEST['newname']))
			echo'<p style="color: red;">Es wurde keine Name eingegeben!</p>';
		else
		{
			$kuenstlerTable->update($id, $_REQUEST['newname']);
			$update = true;
		}
			
			
	}
	$toChange = $kuenstlerTable->findById($id);		
	$form =
		"<form action=\"". $_SERVER['PHP_SELF'] ."\" method=\"post\">"
		.'<input type="hidden" name="update" value="'. $id .'">'
		."<p>Geben Sie den korrigierten Namen ein: <input type=\"text\" value=\"". $toChange->getName() ."\" name=\"newname\"><p>"
		.'<p><input value="Aktualisieren" name="Aktualisieren" type="submit"></p>'
		."</form>";
		
	$button_back = 'Zur K&uuml;nstlerliste <input type=button onClick="window.location.href=\'alle_kuenstler.php\'" value="Zur&uuml;ck">';
					


if($update === false)
{
	echo $form;
	echo $button_back;
}
else
{
	echo "Der K&uuml;nstler mit der ID $id wurde ge&auml;ndert in ". $toChange->getName() ."<br><br>";
	echo $button_back;
}


HTML::printPageFoot();
?>