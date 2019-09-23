<?php
require_once("environment.php");

HTML::printPageHeader("Test der Klasse DB");

$db = DB::getInstance();
$db2 = DB::getInstance();

if($db === $db2){
	print "Beides das gleiche Objekt";
}
else{
	print "unterschiedliche Objekte";
}
$kg = new KuenstlerGateway();
echo"<pre>";
print_r($kg->findALL());
echo"</pre>";

HTML::printPageFoot();
?>