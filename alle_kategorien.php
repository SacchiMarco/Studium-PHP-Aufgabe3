<?php 
require_once("environment.php");
$kategorien = new KategorieGateway();

$kateListe = $kategorien->findAll();

HTML::printPageHeader("Alle Kategorien");
HTML::printCaption("Liste aller Kategorien",1);
HTML::printNavi();
HTML::back_button("","kategorieanlegen.php","Neue Kategorie");

HTML::printTableBegin(1,3,1);
HTML::printTableHeader(array("ID", "Kategorie"));
foreach($kateListe as $kategorie)
{
	echo "<tr>";
	
	HTML::printTableTd($kategorie->getId());
	HTML::printTableTd($kategorie->getName());
	echo "<td>";
	HTML::printLink("kategoriebearbeiten.php?id=". $kategorie->getId() ."&name=". urlencode($kategorie->getName()) .""," Bearbeiten ");
	echo "</td><td>";
	HTML::printLink("kategorieloeschen.php?id=". $kategorie->getId(). 
	                                   "&name=". urlencode($kategorie->getName()) .
																		 ""," L&ouml;schen ");
  echo "</td></tr>";					
}
HTML::printTableEnd();

HTML::printPageFoot();
?>