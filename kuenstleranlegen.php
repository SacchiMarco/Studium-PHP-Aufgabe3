<?php 
require_once("environment.php");
$dbInstance = new KuenstlerGateway();
HTML::printPageHeader("K&uuml;nstler anlegen");
HTML::printCaption("K&uuml;nstler anlegen", 1);
if(isset($_POST['newIns']))
{
	if(!empty($_POST['newIns']))
	{
		$newIns = $_POST['newIns'];
		$dbInstance->insert($newIns);
		echo '<div style="color:green">Der K&uuml;nstler '. $newIns .' wurde zur Liste hinzugef&uuml;gt.</div>';
	}
	else
	{
		echo '<div style="color:red">Fehler: Keine Eingabedaten gefunden!</div>';
	}
}
else
{
	echo '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">';
	echo '<p>Geben Sie den Namen des K&uuml;nstlers ein: <input type="text" name="newIns" id="ins" onkeyup="checkInput()"></input><a style="color:red" id="fehler"></a></p>';
	echo '<button id="saveButton" type="submit">Speichern</button>';
	echo '</form>';
}
HTML::back_button("Zur K&uuml;nstlerliste","alle_kuenstler.php","Zur&uuml;ck");
HTML::printPageFoot();
?>

<script>
var zahl;
document.getElementById("saveButton").disabled=true;
String.prototype.trim = function() {
    return this.replace(/^\s+/g, '').replace(/\s+$/g, '');
} 

function checkInput()
{
	zahl = document.getElementById("ins").value;
	zahl = zahl.trim();
	if (zahl.length > 0)
	{
		document.getElementById("saveButton").disabled=false;
		document.getElementById("fehler").innerHTML = "";
	}
	if(zahl.length == 0)
	{
		document.getElementById("fehler").innerHTML = " Keine leere eingabe erlaubt!";
		document.getElementById("saveButton").disabled=true;
		document.getElementById("ins").value = '';
	}
}
</script>