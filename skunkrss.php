<?
putenv("TZ=Europe/Stockholm");

	// RÄKNAREN
	
	require("functions.php");		// various functions for the text
	include( 'curl.php' );
	header("Content-Type: text/xml");	// we want xml format

	
	$page = 0;
   $next_count = 1;
   echo '<?xml version="1.0" encoding="ISO-8859-1" ?>';
	echo "<rss version=\"2.0\" xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\">\n";
	echo "<channel>\n";
	echo "<title>Skunkdagbok för: ".$_GET['id']."</title>\n";
	echo "<link>http://skunk.spray.se/visaskunk.jsp?id=".$_GET["id"]."</link>\n";
	echo "<description>dagbok för \"".$_GET['id']."\" från skunk.nu</description>\n";
	echo "<language>sv</language>\n";
	echo "<generator>skunkrss - http://skunk.himynameisjonas.net/rss/</generator>";
   while ($next_count > 0) {
      
      hamta($_GET['id'], $page);
      $file = "txt/".$_GET['id']."-".$page;
      $page++;
      $alltext = "";

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

   // KOLLA EFTER NÄSTA LÄNK
      $next_start = "&raquo;</A> </td>";
      $next_count = get_count($next_start, $bigtext);


   // get the nickname of the person
   	$start = '<table width="141" border="0" cellpadding="3" cellspacing="0">';
   	$end = '</b> </font> </td>';
   	$nick = get_string($alltext,$start, $end);
   	$nick = trim(strip_tags($nick));

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
      	//	echo "<content>\n";
      	//	echo "<![CDATA[";

      	// parse content
      		$tags_to_strip = Array("td","tr","font");

      		foreach ($tags_to_strip as $tag) {
      			$content[$counter] = preg_replace("/<\/?" . $tag . "(.|\s)*?>/","",$content[$counter]);
      		}

      		if ($counter == $count) {
      			$content[$counter] = get_title($content[$counter],"</table>");
      		}
      	//	echo trim($content[$counter]);

      	// end parse

      	//	echo "]]>\n";
      		//echo "</content>\n";

      		echo "<description>[CDATA[".tecken($content[$counter]);
      		echo "]]</description></item>\n";
      		$counter++;
   	}
      
      
      
      
      
   } // end while next_count
	echo "</channel>\n";
	echo "</rss>\n";
?>