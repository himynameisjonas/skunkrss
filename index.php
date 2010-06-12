<?


if ( $_GET["do"] == "rss" )
{
	include("skunkrss.php");
//	header("Location: skunkrss.php");
	exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?
	if ( $_GET["do"] == "fixa" )
	{?>
<link rel="alternate" type="application/rss+xml" title="skunkdagbok" href="http://skunk.himynameisjonas.net/rss/?do=rss&id=<?=$_POST["skunkid"];?>"/>  <?
}
?>
	<title>skunkrss - gör rss av skunkdagböcker</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="script.js"></script>
</head>

<body>
	<div id="content">
		<h1><a href="./" title="skunkrss">skunkrss</a></h1> 
	<?
	
	switch ( $_GET["do"] )
	{
		case "fixa":
			if ( !isset($_POST['skunkid']) || $_POST['skunkid'] == "skunkid" )
			{
				echo "<p>något blev fel, du måste fylla i ett skunkid!</p>itt";
			} else {
					$file = "txt/".$_POST['skunkid'];
					echo "<h2>gör rss av skunkdagböcker</h2>";
					if ( !file_exists($file) )
					{
						echo "<p>Vad spännande, du är den första som vill ha just den här skunkdagboken som rss!</p>
						<p class='alert'>Eller så har du skrivit in fel skunkid, kom ihåg det är inte skunknamnet utan talet som bland annat står i högerspalten på skunksidan.</p>";
					} else {
						echo "<p>Du är minsann inte den första som vill ha den här skunkdagboken som rss!</p>";
					}

					echo "<p>Ok, nu är det bara att lägga till adressen nedan i valfri rss-läsare för att börja följa skunkdagboken.</p>";
					echo "<p><a href='http://skunk.himynameisjonas.net/rss/?do=rss&id=".$_POST["skunkid"]."'>http://skunk.himynameisjonas.net/rss/?do=rss&id=".$_POST["skunkid"]."</a></p>
					
					<h2>skapa en ny rss</h2>
					<form id='form1' name='form1' action='?do=fixa' method='post'>
						<input type='text' name='skunkid' value='skunkid' id='skunkid'/><br/>
						<div id='noDigits' style='display:none'>
							Endast siffror!
						</div>
						<input type='submit' name='submit' value='skapa rss' id='submit'/>
					</form>
					";?>
					<h2>Donationer</h2>
					<p>jag tar tacksamt emot donationer för att hålla sidan levande.</p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="2406759" />
					<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="" />
					<img alt="" border="0" src="https://www.paypal.com/sv_SE/i/scr/pixel.gif" width="1" height="1" />
					</form>
					
					<?
			}

		break;
		
		case 'om':
			echo "<h2>om</h2>";
			?>
			<p>Den här tjänsten är baserad på Skunkrss som är kodat av <a href="http://jesper.indie.nu">Jesper Frisk</a>. Och då han släppte scriptet under GNU så kommer jag släppa källkoden här. Är det något så skicka bara iväg ett mail. ps. det finns även en <a href="?do=todo">todo-lista</a>.</p>
			<h2>källkoden</h2>
			<p>hej kommer alldeles strax, har mycket på universitetet just nu och vill inte lägga upp en kod som inte är kommenterad och typ är oläsbar. Vill någon verkligen ha koden så är det bara skicka ett mail.</p>
			<?	
		break;
		
		case 'todo':
			echo "<h2>todo-lista</h2>";
	?>
			<ul>
				<li>fixa så att det blir rätt med tidzonen i tiden på inläggen</li>
				<li>koda något som kontrollerar skunkid innan dagboken hämtas</li>
				<li>fixa statistik över hur många som prenumererar på varje dagbok</li>
				<li><strike>lägga till id till inläggen så man slipper dubletter om det skrivs flera gånger/dag</strike></li>
				<li><strike>Tacklista över de som varit snälla och donerat</strike></li>

			</ul>
			<p>Kom gärna med fler förslag!</p>
	<?
		break;
				
		default:
	?>				
	

	
	
	<h2>gör rss av skunkdagböcker</h2>

					<p>Ok, här kan du fixa en rss av valfri skunkdagbok, det enda du behöver är att ta reda på rätt <abbr title="typ det långa talet du ser i adresssen om du går in på en skunksida">skunkid</abbr> för den person du vill följa.</p>
					<p>Perfekt om ni är trött på att behöva logga in på skunk för att läsa några dagböcker, om ni har för många att hålla koll på eller inte vill visa att ni besöker personen ifråga.
						<br/>Lägg bara till de dagböcker du vill följa i valfri rss-läsare (förslagsvis <a href="http://reader.google.com">google reader</a>) så sköts allt automatiskt!	</p>
					<p class="alert">Bäst blir det om ni skriver in ett korrekt skunkid (<strong>inga bokstäver, bara siffor!</strong>) för jag har inte kodat något som kontrollerar det, ännu.</p>
					<form id="form1" name="form1" action="?do=fixa" method="post">
						<input type="text" name="skunkid" value="skunkid-nummer" id="skunkid"/><br/>
						<div id="noDigits" style="display:none">
							Endast siffror!
						</div>
						<input type="submit" name="submit" value="skapa rss" id="submit"/>

					</form>


			<p>Jag gör fortfarande en del ändringar (<a href="?do=todo">todo-lista</a>) så det kan hända att det dyker upp dubletter av en del inlägg men hellre det än inga inlägg alls.</p>
			
			

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick" />
			<input type="hidden" name="hosted_button_id" value="2406759" />
			<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="" />
			<img alt="" border="0" src="https://www.paypal.com/sv_SE/i/scr/pixel.gif" width="1" height="1" />
			</form>
			<p><small>
				<strong>Tack för donationer</strong><br/>
				<a href="http://skunk.spray.se/visaskunk.jsp?id=2331245">skorpinjon</a>, <a href="http://skunk.spray.se/visaskunk.jsp?id=2460226">Joni</a>
			</small></p>
<?		break;
	}
	?>
<div id="footer">Prova även <a href="http://skunk.himynameisjonas.net">skunkloggen</a>, en räknare till din skunksida.<br/>
	jonas forsberg | <a href="http://himynameisjonas.net">himynameisjonas.net</a> | <a href="?do=om">mer info</a> | <a href="?do=todo">todo-lista</a>
</div>
</div>

<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://himynameisjonas.net/piwik/" : "http://himynameisjonas.net/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
<?php
if (isset($_GET["do"]) && $_GET["do"] == "fixa" && isset($_POST['skunkid']) || $_POST['skunkid'] != "skunkid") { ?>
piwikTracker.setDocumentTitle("rss för: <?php echo $_POST['skunkid']; ?>");
<?php } ?>

piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://himynameisjonas.net/piwik/piwik.php?idsite=2" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->

<script src="http://static.getclicky.com/3227.js" type="text/javascript"></script>
<noscript><p><img alt="Clicky" src="http://in.getclicky.com/3227ns.gif" /></p></noscript>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-332455-3";
urchinTracker();
</script>
</body>
</html>