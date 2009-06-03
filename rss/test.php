<?

if ( condition )
{
// Permanent redirection
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://www.somacon.com/");
exit();
}
?>