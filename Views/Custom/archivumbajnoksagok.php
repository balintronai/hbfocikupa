<html>
<head>
<META HTTP-EQUIV="Content-Type" Content="text/html; Charset=iso-8859-2">
<META HTTP-EQUIV="Content-Language" Content="hu">
  <style>
	img{
	height:100px;
	border:1px solid black;
	margin-right:5px;
	position:relative;
	z-index:1;
	cursor:pointer;
}
  </style>
<script>
var a = 0;
function resizeImg(img)
{
if(a==0){
img.style.position="fixed";
img.style.height="600px";
img.style.zIndex="10";
img.style.right="10%";
img.style.top="50px";
a = 1;
} else{
img.style.position="relative";
img.style.height="100px";
img.style.zIndex="1";
img.style.right="0px";
img.style.top="0px";
a = 0;
}

}
</script>
</head>
<body>
<?php 


  $cim = 'Archívum - Bajnoksagok';
  $leiras = 'A Futball Világ Kft. archívuma.';
  $kulcsszavak = 'Archívum';



$mappa="Application/saves/archivumbajnoksagok/";
$news = file_get_contents($mappa . "counter.php");	//A news változó a hírek számát jelöli
$html .= "<h2>Archívum - Bajnokságok</h2>";
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
			if (file_exists($mappa . $counter . "a.jpg"))
				$html .= "<img onClick='resizeImg(this)' src='" . $mappa . $counter . "a.jpg'></img>";
			if (file_exists($mappa . $counter . "b.jpg"))
				$html .= "<img onClick='resizeImg(this)' src='" . $mappa . $counter . "b.jpg'></img>";
			if (file_exists($mappa . $counter . "c.jpg"))
				$html .= "<img onClick='resizeImg(this)' src='" . $mappa . $counter . "c.jpg'></img>";
			$html .= "</div></div>";
			if ($counter != 1)
				$html .= "<hr>";
				}
		};
?>
</body>
</html>