<?php 
require_once("environment.php");


	

HTML::printPageHeader("Kategorie Löschen");
HTML::printCaption("Kategorie l&ouml;schen",1);

if(isset($_POST['oldid']))
{
	$id = $_POST['oldid'];
	$name = $_POST['oldname'];
	$kategorie = new KategorieGateway();
	$kategorie->delete($id);
	
	HTML::printCaption("Kategorie ID: ". $id ." ". $name ." wirklich l&ouml;schen?",4,"green");
}
else
{
	HTML::printCaption("Kategorie ID: ". $_REQUEST['id'] ." ". $_REQUEST['name']." wirklich l&ouml;schen?",4,"red");
	echo '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">';
	echo '<input type="hidden" name="oldid" value="'. $_REQUEST['id'] .'">';
	echo '<input type="hidden" name="oldname" value="'. $_REQUEST['name'] .'">';
	echo '<input type="submit" value="L&ouml;schen">';
	echo '</form>';
}

HTML::back_button("Zur&uuml;ck zur... ","alle_kategorien.php","Kategorieliste");
HTML::printPageFoot();
?>