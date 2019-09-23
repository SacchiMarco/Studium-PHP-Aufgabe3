<?php 
session_start();
if(isset($_GET['id']) && isset($_GET['name']))
{
	$_SESSION['kategorie']['id'] = $_GET['id'];
	$_SESSION['kategorie']['name'] = $_GET['name'];
}

require_once("environment.php");
$kate = new KategorieGateway();
$showform = true;

if(isset($_POST['newname']))
{
	$error = false;
	if($_POST['oldid'] === $_SESSION['kategorie']['id']) 
	{
		$id = $_POST['oldid'];
	}
	else
	{
		$error = "Fehler: Daten konnten nicht zugeordnet werden!";
	}
	
	if(!empty($_POST['newname']))
	{
		$newname = $_POST['newname'];
	}
	else
	{
		$error = "Fehler: Es ist keine leere Eingabe erlaubt!";
	}
	
	if($error === false)
	{
		$showform = false;
		$kate->update($id, $newname);
	}
}

HTML::printPageHeader("Kategorie bearbeiten");
HTML::printCaption($_SESSION['kategorie']['name']." bearbeiten",1);

if(isset($error)) echo '<p style="color:red">'. $error .'</p>';
if($showform)
{
	echo '<form method="post" action="'. $_SERVER['PHP_SELF'].'">';
	echo '<input type="hidden" name="oldid" value="'.$_SESSION['kategorie']['id'] .'">';
	echo '<input type="text" name="newname" value="'. $_SESSION['kategorie']['name'].'">';
	echo '<input type="submit" value="Speichern">';
	echo '</form>';
}
else
{
	echo '<p style="color:green">Die Kategorie '. $newname .' wurde gespeichert.</p>';
	unset( $_SESSION['kategorie']);
}

HTML::back_button("Zur Kategorieliste... ","alle_kategorien.php","zur&uuml;ck");
HTML::printPageFoot();
?>