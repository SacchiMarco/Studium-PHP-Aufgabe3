<?php 
require_once("environment.php");
$kategorien = new KategorieGateway();
$showform = true;

HTML::printPageHeader("Kategorie anlegen");
HTML::printCaption("Kategorie anlegen",1);

if(isset($_REQUEST['newKate']))
{ 
  $name = trim($_REQUEST['newKate']);
	
	if(empty($name))
	{
		HTML::printCaption("eine Leere eingabe ist nicht erlaubt!",4,"red");
	}
	else
	{
		HTML::printCaption($name." wurde Gepseichert",4,"green");
		$showform = false;
		$kategorien->insert($name);
	}
}

if($showform)
{
	echo '<form action="'. $_SERVER['PHP_SELF'].'" method="post">';
	echo '<input type="text" name="newKate">';
	echo '<input type="submit" value="Speichern">';
	echo '</form>';
}

HTML::back_button("Zur&uuml;ck zur... ","alle_kategorien.php","Kategorieliste");
HTML::printPageFoot();
?>