<?


if (isset($_GET["do"]) && $_GET["do"] == "rss" )
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
	if (isset($_GET["do"]) && $_GET["do"] == "fixa" )
	{?>
<link rel="alternate" type="application/rss+xml" title="skunkdagbok" href="http://skunk.himynameisjonas.net/rss/?do=rss&id=<?=$_POST["skunkid"];?>"/>  <?
}
?>
	<title>skunkdagboksexport - exportera din dagbok på skunk</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="script.js"></script>
</head>

<body>
	<div id="content">
		<h1><a href="./" title="skunkrss">EXPORTERA DIN SKUNKDAGBOK</a></h1> 
	<?
	if (!isset($_GET["do"])) {
	  $_GET['do'] = "";
	}
	switch ( $_GET["do"] )
	{
		case "fixa":
			if ( !isset($_POST['skunkid']) || $_POST['skunkid'] == "skunkid" )
			{
				echo "<p>något blev fel, du måste fylla i ett skunkid!</p>itt";
			} else {
					$file = "txt/".$_POST['skunkid'];
					echo "<h2>exportera skunkdagböcker</h2>";
					echo "<p>Ok, nu är det bara att spara filen från nedanstående länk till din dator. brukar funka bra med typ högerklick och sen \"spara som\" eller motsvarande.</p>";
					echo "<p><a href='http://skunk.himynameisjonas.net/rss/?do=rss&id=".$_POST["skunkid"]."'>http://skunk.himynameisjonas.net/rss/?do=rss&id=".$_POST["skunkid"]."</a></p>
					";?>
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
			<p>Koden är baserad på script som släppts under GNU och sånt, hela skiten (koden är inget jag är stolk över) finns på github</p>
			<?	
		break;
				
		default:
	?>				
	

	
	
	<h2>gör backup på dagböckerna på skunk</h2>
      <p>
         Här kan du exportera hela din skunkdagbok till en stor och fin rss-fil som du sedan kan spara undan eller, kanske med lite tur, importera till någon blogg eller liknande.
      </p>
					<p class="alert">Bäst blir det om ni skriver in ett korrekt skunkid (<strong>inga bokstäver, bara siffor!</strong>)</p>
					<form id="form1" name="form1" action="?do=fixa" method="post">
						<input type="text" name="skunkid" value="skunkid-nummer" id="skunkid"/><br/>
						<div id="noDigits" style="display:none">
							Endast siffror!
						</div>
						<input type="submit" name="submit" value="skapa rss" id="submit"/>

					</form>


			<p>Lovar inte att den här sidan fungerar som den ska då jag hackade ihop detta med jättegammal kod under en kvart typ. Finns på github om ni vill kolla koden själva.</p>
			
			

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick" />
			<input type="hidden" name="hosted_button_id" value="2406759" />
			<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="" />
			<img alt="" border="0" src="https://www.paypal.com/sv_SE/i/scr/pixel.gif" width="1" height="1" />
			</form>
<?		break;
	}
	?>
   <div id="footer">
      jonas forsberg | <a href="http://jonasforsberg.se">jonasforsberg.se</a> | <a href="?do=om">mer info</a>
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