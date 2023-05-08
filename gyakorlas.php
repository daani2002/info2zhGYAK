<!DOCTYPE html>
<html>
<head>
<title>Ételek</title>
</head>
<h1>NEV: Papp Dániel, NEPTUN: AAIW8N</h1>


<?php
//if(!isset($_GET["ok"])){
	//die("Nincs még lekérdezés!");
//}
$link = mysqli_connect("localhost:3307", "root", "")
	or die("Kapcsolódási hiba:". mysqli_error());
mysqli_select_db($link, "minta_zh");
mysqli_query($link, "set character_set_results='utf8'");

$escaped_fajta = mysqli_real_escape_string($link, $_GET["fajta"]);

$query = "select etel.nev as etel, count(*) as darabszam
from fajta f
	inner join allat on f.id = allat.fajtaId
	inner join kedvencetel on allat.id = kedvencetel.allatId
    inner join etel on kedvencetel.etelId = etel.id
where f.id = ".$escaped_fajta."
group by etel.nev
order by etel.nev;";

$result = mysqli_query($link, $query) or die(mysqli_error($link));

echo "  fajta kedvenc étlei: {$escaped_fajta}";

echo "<table border=1>";
echo "<tr><th>"."étel"."</th><th>"."hány állat kedvence"."</th></tr>";
for($i =0; $row = mysqli_fetch_assoc($result); $i++) { 
 $background = ($i % 2 == 0) ? '' : "style='background-color:grey' "; 
 echo "<tr ".$background."><td>".$row["etel"]."</td><td>".$row["darabszam"]."</td></tr>"; 
} 
echo "</table>";
mysqli_free_result($result);
mysqli_close($link);
?>
</body>
</html>