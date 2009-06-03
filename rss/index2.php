<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>skunkrss - gör rss av skunkdagböcker</title>
	<?/*?><link rel="stylesheet" href="style.css" type="text/css"/> <?*/?>
	<link rel="stylesheet" href="screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="print.css" type="text/css" media="print">
</head>

<body>
	<div class="container">
		<div class="column span-10 first last header">
			<h1><a href="./" title="skunkrss">skunkrss</a></h1> 
		</div>
		<div class="column span-10 first last">	
			<h2>gör rss av skunkdagböcker</h2>

			<p>Ok, här kan du fixa en rss av valfri skunkdagbok, det enda du behöver är att ta reda på rätt <abbr title="typ det långa talet du ser i adresssen om du går in på en skunksida">skunkid</abbr> för den person du vill följa.</p>
			<p class="alert">Bäst att ni skriver in ett korrekt skunkid nu för jag har inte kodat något som kontrollerar det, ännu. (blir tråkigt om jag är tvungen att stänga av den här tjänsten)</p>
		</div>
		<div class="column span-10 first last">			
				<form id="form1" name="form1" action="?do=fixa" method="post">
					<input type="text" name="skunkid" value="skunkid" class="button positive" id="skunkid">
					<button type="submit" class="button positive">
					<img src="lib/img/icons/tick.png" alt=""/> skapa rss
					</button>
				</form>
		</div>
		<div class="span-10 first last">
			<p>Jag gör fortfarande en del ändringar (<a href="?do=todo">todo-lista</a>) så det kan hända att det dyker upp dubletter av en del inlägg men hellre det än inga inlägg alls...</p>
		</div>
		
			<p class="small quiet">
				Prova även <a href="http://skunk.himynameisjonas.net">skunkloggen</a>, en räknare till din skunksida.<br/>
				Baserat på skunkrss-scriptet gjort av Jesper Frisk, för att inte bryta licensen kommer jag ladda upp källkoden imorgon!
			</p>
		</div>
	</div>
	
</body>
</html>
