<?php
 class HTML{
 
 
   public static function printPageHeader($titeltext = "Titel"){
     print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'.
         ' "http://www.w3.org/TR/html4/strict.dtd">';
     print '<html>';
     print '  <head>';
     print '    <meta http-equiv="content-type"'.
               'content="text/html; charset=ISO-8859-1">';
     if ($titeltext != "")
       print '    <title>'.$titeltext.'</title>';
     print "<style type='text/css'>";
     print "  p {font-size: 10.5pt; font-family: Verdana};";
     print "  p1{font-size: 15pt;font-weight: bold};";
     print "  h1{font-size: 13pt;font-weight: bold};";
     print "</style>";
     print '  </head>';
     print '  <body>';
   }
 
   public static function printPageFoot(){
     print '  </body>';
     print '</html>';
   }
	 
	 public static function printNavi()
	 {
		 $style = 'style="float:left; padding: 0 10px 0 0"';
		 print"<div>";
		 print"<div $style ><a href=alle_videos.php>Musikvideos </a></div>";
		 print"<div $style ><a href=alle_kuenstler.php>Alle K&uuml;nstler</a> </div>";
		 print"<div $style ><a href=alle_kategorien.php>Alle Kateorien</a> </div>";
		 print"<div style=clear:both;></div>";
		 print"</div>";
	 }
	 
 
 
   public static function printTableBegin($cellspacing = 0,
                                         $cellpadding = 0,$border = 0){
     print "<table cellspacing=$cellspacing cellpadding = $cellpadding,
            border=$border>";
   }
	 
	 public static function printTableHeader($headers){
		 print"<tr>";
     foreach($headers as $header){
       print "<th>$header</th>";
     }
		 print"</tr>";
   }
	 
	 
	 public static function printTableTd($input){
     print "<td>". $input ."</td>";
   }
 
   public static function printTableEnd(){
     print "</table>";
   }
 
 
 
 
   public static function printCaption($text, $size, $color=""){
     print "<h$size style=\"color:$color\">$text</h$size>";
   }

   public static function printLink($url, $label){
     print "<a href=$url>$label</a>";
   }
 
   public static function printBlanks($numberOfBlanks){
     $blanks = "";
     for ($index = 0; $index < $numberOfBlanks; $index++) {
       $blanks .= "&nbsp;";
     }
     print $blanks;
   }
	 
	 public static function back_button($text = "", $href, $buttonValue)
	 {
		 print '<p>'. $text .' <input type=button onClick="window.location.href=\''.$href.'\'" value="'.$buttonValue.'"><p>';
	 }
	 
	 public static function button($text = "", $href, $buttonValue)
	 {
		 print $text .' <input type=button onClick="window.location.href=\''.$href.'\'" value="'.$buttonValue.'">';
	 }
 }
?>