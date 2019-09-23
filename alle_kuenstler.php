<?php 
require_once("environment.php");


$kuenstlerTable = new KuenstlerGateway();
$max = $kuenstlerTable->size();
$rows = 15;
$chkid = null;
$chkname = null;

if(isset($_REQUEST['direction']))
{
	$direction = $_REQUEST['direction'];
	if($direction == "forward")
	{
		$from = $_REQUEST['oldvalue'] + $rows;
	}
	else
	{
		$from = $_REQUEST['oldvalue'] - $rows;
		if($from < 0) $from = 0;
	}
}
else
{
	$from = 0;
	if(isset($_REQUEST['jump'])) $from = $_REQUEST['jump'];
}

if(isset($_REQUEST['show']))
{
	if(request("sort") == "byname")
	{
		$kuenstlerListe = $kuenstlerTable->findAllOrderByName($from, $rows);
		$chkname = "checked";
	}
	else
	{
		$kuenstlerListe = $kuenstlerTable->findAllOrderById($from, $rows);
		$chkid = "checked";
	}
}
else
{
	$kuenstlerListe = $kuenstlerTable->findAllOrderByID($from, $rows);
	$chkid = "checked";
}

if(isset($_REQUEST['letter']))
{
	if(request("sort") == "byname")
	{
		$kuenstlerListe = $kuenstlerTable->findBuchstabeOrderByName(request("letter"),$from,$rows);
		$chkname = "checked";
	}
	else
	{		
		$kuenstlerListe = $kuenstlerTable->findBuchstabeOrderById(request("letter"),$from,$rows);
		$chkid = "checked";
	}
}


HTML::printPageHeader("Alle K&uuml;nstler");
HTML::printCaption("Liste aller K&uuml;nstler", 1);
HTML::printNavi();
HTML::back_button("", "kuenstleranlegen.php","Neuen K&uuml;nstler anlegen");

printFormSort($chkid, $chkname, request("letter"));

HTML::printTableBegin(2,4,1);
HTML::printTableHeader(array("ID", "Name"));
foreach( $kuenstlerListe as $kuenstler)
{
	print"<tr>";
	print $kuenstler->toHTMLTableColums();
	print"<td>";
	HTML::printLink("kuenstlerbearbeiten.php?id=". $kuenstler->getId() .
	                "&kuenstler=". urlencode($kuenstler->getName()),
									"Bearbeiten");
	print"</td><td>";
	HTML::printLink("kuenstlerloeschen.php?id=". $kuenstler->getId() .
	                "&kuenstler=". urlencode($kuenstler->getName()),
									"L&ouml;schen");
	print"</td></tr>";
}
HTML::printTableEnd();

echo"<p>";
if($from > 0)
{
	HTML::printLink($_SERVER['PHP_SELF'].
	                "?sort=".request("sort")."&direction=backward&oldvalue=$from&letter=".request("letter"),
									"Zur&uuml;ck");
	HTML::printBlanks(2);
}
HTML::printLink($_SERVER['PHP_SELF'].
								"?show=all&sort=".request("sort","byid"),
								"Alle");
HTML::printBlanks(2);
echo"Buchstabe: ";
for($i = 0; $i <= 26; $i++)
{
	HTML::printLink($_SERVER['PHP_SELF'].
										"?sort=".request("sort")."&letter=".alphabet($i,1),alphabet($i,1));
	HTML::printBlanks(2);
}

if($from + $rows < $max)
{
	HTML::printLink($_SERVER['PHP_SELF'].
	                "?sort=".request("sort")."&direction=forward&oldvalue=$from&letter=".request("letter"),
									"Vorw&auml;rts");
}
echo"<p>";
HTML::printPageFoot();
?>