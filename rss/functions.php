<?

/*
 * Projekt:     SkunkRSS: Hämtar en användares dagbok från www.skunk.nu och parsar den till RSS-format
 * Fil:        functions.php, diverse funktioner för att bearbeta texten
 * Upphovsman:      Jesper Frisk <jesper@indie.nu>
 * Version:		0.1
 * Licens:		GPL
 *
 * Den senaste versionen av SkunkRSS kan hämtas från
 * http://jesper.samsonrourke.com/
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


function get_count($word,$phrase) {
    $word = strtolower($word); # this way,
    $phrase = strtolower($phrase); # case is irrelevant

    $Bits = split($word.'[^[:alnum:]]*', $phrase);

    return (count($Bits)-1);
}

function get_string($h, $s, $e)
{
	$sp = strpos($h, $s, 0) + strlen($s);
	$ep = strpos($h, $e, 0);
	return substr($h, $sp, $ep-$sp);
}

function get_title($h, $e)
{
	$ep = strpos($h, $e, 0);
	return substr($h, 0, $ep);
}

function get_rest($h, $e) {
	
	$sp = strpos($h, $e, 0) + strlen($e);
	return substr($h,$sp,strlen($h));
}

function tecken($text) {
         $text=str_replace("&","&amp;",$text);
         $text=str_replace('"','&quot;',$text);
	 $text=str_replace('<','&lt;',$text);
    	 $text=str_replace('>','&gt;',$text);
         return $text;
}

?>