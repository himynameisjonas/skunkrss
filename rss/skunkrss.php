<?
include_once( "/home/.osiris/himynameisjonas/skunk.himynameisjonas.net/slimstat/inc.stats.php" ); 
$logfil = "log/".	$_GET['id']."-log.txt";
$handle = fopen("$logfil", "a");
$logtxt = "\n ".$_GET['id']." ".$_SERVER['HTTP_USER_AGENT'];
fwrite($handle, $logtxt);
fclose($handle);

/*
 * Projekt:     SkunkRSS: Hämtar en användares dagbok från www.skunk.nu och parsar den till RSS-format
 * Fil:        skunkdagbok.php, huvudfilen för att tolka dagboken
 * Upphovsman:      Jesper Frisk <jesper@indie.nu>
 * Modifierat av:	Jonas Forsberg himynameisjonas.net
 * Licens:		GPL
 *
 * 
 *
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

	// RÄKNAREN
	
	require("functions.php");		// various functions for the text
	include( 'curl.php' );
	header("Content-Type: text/xml");	// we want xml format


	$file = "txt/".$_GET['id'];
	
	if ( !file_exists($file) )
	{
		hamta($_GET['id']);
	}

	if (filemtime($file) < time() - 600) { 
		// kör curl och sånt!!11

		hamta($_GET['id']);

	 } 

if (file_exists($file)) {

	$fp=fopen($file, "r");		// open the temporary file and read
	
	while ($line=fgets($fp,10000))		// all lines
	{
		if( ord( $line[ strlen($line) -1 ] ) == 0x0A ) {
		$line = substr( $line, 0, strlen($line) - 1 );
	}
		
	$alltext.=$line;			// now we have all text in the
						// $alltext variable
	}


	
	fclose($fp);			// close our file

// extract the main part of the html page

	$start = 'Dölj alla</a></font></td>';
	$end = 'start=0;';
	$forsta = get_string($alltext, $start, $end);
	$bigtext=$forsta;

// count the diary posts

	$count_start = "<td width=\"100%\" bgcolor=\"#3167a8\"><font size=\"2\" color=\"#ffffff\" face=\"verdana, arial, sans-serif\"><b>";
	$count = get_count($count_start,$bigtext);
	$counter = 1;

// get the nickname of the person
	$start = '<table width="141" border="0" cellpadding="3" cellspacing="0">';
	$end = '</b> </font> </td>';
	$nick = get_string($alltext,$start, $end);
	$nick = trim(strip_tags($nick));
	
// start printing out the XML document

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
	echo "<rss version=\"2.0\" xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\">\n";
	echo "<channel>\n";
	echo "<title>Skunkdagbok: ".$nick."</title>\n";
	echo "<link>http://skunk.spray.se/visaskunk.jsp?id=".$_GET["id"]."</link>\n";
	echo "<description>dagbok för \"".$nick."\" från skunk.nu</description>\n";
/*	echo "<image>\n";
	echo " <title>Skunk</title>\n";
	echo " <url>http://www.indie.nu/skunk/skunk.jpg</url>\n";
	echo " <link>http://skunk.spray.se/diary_other.jsp?id=".$_GET["id"]."</link>\n";
	echo " <description>dagbok för \"".$nick."\" från skunk.nu </description>\n";
	echo " <width>137</width>\n";
	echo " <height>53</height>\n";
	echo "</image>\n";
*/
	echo "<language>sv</language>\n";
	echo "<generator>skunkrss - http://skunk.himynameisjonas.net/rss/</generator>";


	$content = explode("<font size=\"2\" color=\"#ffffff\" face=\"verdana, arial, sans-serif\"><b>",$bigtext);

	while ($counter <= $count) {

	echo "<item>\n";
	echo "<title>";

	// parse title
		$end = '</b></a></font></td>';
		$title = get_title($content[$counter], $end);
		$content[$counter] = get_rest($content[$counter],$end);
		echo strip_tags($title);
	// end parse

	echo "</title>\n";
	echo "<pubDate>\n";

	// parse date & time
		$start = '<nobr>';
		$end = '</a></nobr></font></td>';
		$datetime = get_string($content[$counter], $start, $end);
		$content[$counter] = get_rest($content[$counter],$end);

	// get date
//		$start = "[";
//		$end = ":";
//		$date = substr(get_string($datetime,$start,$end),0,10);

	// get date & time separately
		$start = "[";
		$end = ".";
		$datetime = get_string($datetime,$start,$end);
		
		$datetime = explode(" ",$datetime);
		
		$date = explode("-",$datetime[0]);
		$time = explode(":",$datetime[1]);
//		echo $time[0]."-".$time[1]."-".$time[2];

// HÄR ÄNDRADE JAG!! G>H
//		$dejt = gmdate ("D, j M Y G:i:s \G\M\T",mktime(0,0,0,1,9,2003);
		echo gmdate ("D, j M Y H:i:s \G\M\T", mktime ($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]));

	// end parse
	
		echo "</pubDate>\n";
		echo "<link>http://skunk.spray.se/diary_other.jsp?id=".$_GET["id"]."</link>\n";
	//	echo "<content>\n";
		echo "<![CDATA[";
	
	// parse content
		$tags_to_strip = Array("td","tr","font");
	
		foreach ($tags_to_strip as $tag) {
			$content[$counter] = preg_replace("/<\/?" . $tag . "(.|\s)*?>/","",$content[$counter]);
		}
	
		if ($counter == $count) {
			$content[$counter] = get_title($content[$counter],"</table>");
		}
		echo trim($content[$counter]);

	// end parse

		echo "]]>\n";
		echo "</content>\n";

		echo
"<description>".tecken($content[$counter])."</description>";
		echo "</item>\n";
		$counter++;
	} 
	
	echo "</channel>\n";
	echo "</rss>\n";
}else {
	echo "felfelfel,  ERROR liksom, kontakta mig!!!!";
}
?>