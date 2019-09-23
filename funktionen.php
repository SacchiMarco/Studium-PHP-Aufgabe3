<?php 
function alphabet($start,$end)
{
	$alfa = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	return substr($alfa,$start,$end);
}

function request($id, $default = null)
{
	$result = $default;
	if(isset($_REQUEST[$id]))
	{
		$result = $_REQUEST[$id];
	}
	return $result;
}

function printFormSort($chkid, $chkname, $letter = "")
{
	print "<form action=". $_SERVER['PHP_SELF'] ." method='post'>";
	print "<input type='hidden' name='letter' value=$letter>";
	print "<input type='radio' name='sort' value='byid' $chkid> nach ID";
	print "<input type='radio' name='sort' value='byname' $chkname> nach Name";
	print "<input type='submit' name='sortieren' value='Sortieren'>";
	print "</form>";
	print "<br>";
}

function printFormTitelSuche($titel = "", $checkbox = "")
{
	echo '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">';
	echo '<input type="hidden" name="newSearch" value="new">';
  echo '<input type="text" name="titel" value="'. $titel .'">';
  echo '<input type="checkbox" name="checkBox" '. $checkbox .'>';
  echo 'Suche am anfang des Titels &nbsp;&nbsp;';
  echo '<input type="submit" name="button" id="button" value="Suchen">';
	HTML::button("","alle_videos.php","Suche zur&uuml;cksetzen / alle anzeigen");
	echo '<br><br>';
	echo 'anzahl Titel pro Seite: 
	      <a href="'.$_SERVER['PHP_SELF'].'?limit=15&old='.$_SESSION['limit']['start'].
	                 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox").'">15</a>
	      <a href="'.$_SERVER['PHP_SELF'].'?limit=20&old='.$_SESSION['limit']['start'].
	                 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox").'">20</a>
				<a href="'.$_SERVER['PHP_SELF'].'?limit=25&old='.$_SESSION['limit']['start'].
	                 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox").'">25</a>
				<a href="'.$_SERVER['PHP_SELF'].'?limit=100&old='.$_SESSION['limit']['start'].
	                 '&titel='.urlencode(request("titel")).'&checkBox='.request("checkBox").'">100</a> ';
	echo '</form>';
	echo '<br>';
}
?>