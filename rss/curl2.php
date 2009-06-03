<?php
function hamta ( $id )
{

$ch = curl_init();
$timeout = 0; // set to zero for no timeout
$url = "http://skunk.spray.se/gruppmeddelanden.jsp?id=".$id;
$ref_url = "http://www.yahoo.com/";
$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
//curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

curl_setopt($ch, CURLOPT_REFERER, $ref_url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);

curl_close($ch);

// display file
$filename = "txt/".$id;
$handle = fopen ($filename, "w");

if (fwrite($handle, $file_contents) === FALSE) {
        // felfelfel
        exit;
    }
   
    // DET FUNGERADE
   
    fclose($handle);


}

?>