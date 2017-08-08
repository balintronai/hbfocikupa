<html>
<head>
<META HTTP-EQUIV="Content-Type" Content="text/html; Charset=iso-8859-2">
<META HTTP-EQUIV="Content-Language" Content="hu">
  

</head>
<body>
<?php 


  $cim = 'Sporthírek';
  $leiras = 'A Futball Világ Kft. sporthírei.';
  $kulcsszavak = 'Sporthírek';



$mappa="Application/saves/sporthirek/";
$news = file_get_contents($mappa . "counter.php");	//A news változó a hírek számát jelöli
$html .= "<h2>Sporthírek</h2>";
	for ( $counter = $news; $counter !=0 ; $counter--)	
		{
			if(file_exists($mappa . $counter . "_title.php"))
				{
			$html .= "<div class='post'><h3>";
			$html .= file_get_contents($mappa . $counter . "_title.php");
			$html .= "</h3><div class='date'>Esemény dátuma: ";			
			$html .= file_get_contents($mappa . $counter . "_date.php");
			$html .= "</div><div class='intro'>";
			$html .= file_get_contents($mappa . $counter . ".php");
			if (file_exists($mappa . $counter . ".jpg"))
				$html .= "<img width='100%' src='" . $mappa . $counter . ".jpg'></img>";
			$html .= "</div></div>";
			if ($counter != 1)
				$html .= "<hr>";
				}
		};
?>
</body>
</html>