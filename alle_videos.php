<?php 
session_start();
require_once("environment.php");
$videos = new VideosGateway;
$checkbox = null;
$titel = null;

#Default LIMIT und Persönliches LIMIT
if(!isset($_SESSION['limit']))
{
	$_SESSION['limit']['limiter'] = 15;
	$_SESSION['limit']['start'] = 0;
}

$_SESSION['limit']['dbSize'] = $videos->size() - $_SESSION['limit']['limiter'];

if(request("limit"))
{
	$_SESSION['limit']['limiter'] = (int)request("limit");
}

#Vor- und Zurücknavigation berechung
if(request("direction"))
{
	$old = request("old");
	if(request("direction") == "forward")
	{
		$_SESSION['limit']['start'] = $old + $_SESSION['limit']['limiter'];
	}
	
	if(request("direction") == "backward")
	{
		$_SESSION['limit']['start'] = $old - $_SESSION['limit']['limiter'];
	}
	
	if($_SESSION['limit']['start'] < 0) //der Startwert darf nicht unter 0
		$_SESSION['limit']['start'] = 0;
	
}


#Form überprüfungen
if(request("titel"))
{
	$titel = trim(request("titel"));
	$caption = "Sie suchen nach \" $titel \"";
	
	if(request("checkBox") === "on")
	{
		$checkbox = "checked";
		$caption .= " am Anfang des Titels";
	}
	
	if(request("newSearch") == "new") // Bei neuer Suche zum ersten Datensatz springen
		$_SESSION['limit']['start'] = 0;
		
	if(!empty($titel))
	{	
		$videoliste = $videos->findInTitel($_SESSION['limit']['limiter'], $_SESSION['limit']['start'], $titel, $checkbox);
		$_SESSION['limit']['dbSize'] =  $videos->affectedRowsCount($titel, $checkbox) - $_SESSION['limit']['limiter'];
	}
	else
	{
		$videoliste = array();
	}
}
else
{
	$caption = "Liste aller Videos";
	$videoliste = $videos->findAll($_SESSION['limit']['limiter'], $_SESSION['limit']['start']);
}






#Vor- und Zurücknavigation
function forAndBackNavigation()
{
	echo '<p style="font-size: 13px">';
	if($_SESSION['limit']['start'] > $_SESSION['limit']['dbSize'])
	{
		echo "Vorw&auml;ts >> ";
	}
	else
	{
		HTML::printLink( $_SERVER['PHP_SELF'].'?direction=forward&old='.$_SESSION['limit']['start'].
										 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox"),
										 "Vorw&auml;ts >> ");
	}
	echo "&nbsp;&nbsp; ..... &nbsp;&nbsp; ";
	
	if($_SESSION['limit']['start'] == 0)
	{
		echo " << Zur&uuml;ck";
	}
	else
	{
		HTML::printLink( $_SERVER['PHP_SELF'].'?direction=backward&old='.$_SESSION['limit']['start'].
										 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox"),
										 " << Zur&uuml;ck");
	}
	echo '</p>';
}


HTML::printPageHeader("Alle Videos");
HTML::printCaption($caption, 1);
HTML::printNavi();
HTML::printCaption("Suche nach Musikvideos", 4);
printFormTitelSuche($titel , $checkbox);

#Vor- und Zurücknavigation
forAndBackNavigation();

HTML::printTableBegin(2,3,1);
HTML::printTableHeader(array('K&uuml;nstler','Titel','Genre','Dateigr&ouml;sse'));

foreach($videoliste as $video)
{
	echo "<tr>";
	HTML::printTableTd($video->getKuenstler()->getName());
	HTML::printTableTd($video->getTitel());
	HTML::printTableTd($video->getGenre()->getName());
	HTML::printTableTd($video->getDateigroesse());
	echo "</tr>";
}

HTML::printTableEnd();

#Vor- und Zurücknavigation
forAndBackNavigation();



HTML::printPageFoot();
?>