<html>
<head>
<META HTTP-EQUIV="Content-Type" Content="text/html; Charset=iso-8859-2">
<META HTTP-EQUIV="Content-Language" Content="hu">

</head>
<body>

<?php 

  $cim = 'Partnereink, Cégek amelyekkel együttműködünk';
  $leiras = 'A Futball Világ Kft.-vel együttműködő cégek, szervezetek, egyesületek linkjei, bannerei.';
  $kulcsszavak = 'Partnereink';
  $mappa="Application/Images/partnerek/";
  $connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
$sql = "SELECT * FROM partnerek ORDER BY id";
					$result = mysql_query( $sql, $connect2 );
					
    $html .= '
  
<h2>Partnereink</h2>
   
<p>
  <a href="http://www.buzasborok.hu/" target="_blank">
    <img alt="Buzás Borok" class="pyro-image alignment-none" src="Application/Images/buzas-borok.png" />
  </a> 
  <a href="http://www.facebook.com/TomPub?ref=ts&fref=ts" target="_blank">
    <img alt="Tom Pub" class="pyro-image alignment-none" height="79" src="Application/Images/tom.jpg" width="119" />
  </a>
  <a href="http://www.hegyvidekliga.com/" target="_blank">
    <img alt="Hegyvidék Liga" class="pyro-image alignment-none" src="Application/Images/hl_logo kicsi.jpg" />
<a href="http://www.eurobarca.hu/" target="_blank">
    <img alt="Eurobarca" class="pyro-image alignment-none" src="Application/Images/Eurobarca2.jpg" />

<a href="http://meccsjegyek.hu//" target="_blank">
    <img alt="Meccsjegyek.hu" class="pyro-image alignment-none" height="90" src="Application/Images/Meccsjegyek.hu.jpg" width="150" />


  </a>
  
  <br/>
<a href="http://www.forevercup.hu/" target="_blank">
    <img alt="Forever Cup" class="pyro-image alignment-none" height="150"
src="Application/Images/Banner Forever Cup.gif" width="500" />

  </a>

<br/>

<a href="http://www.peachesandcream.hu/" target="_blank">
    <img alt="Peaches and Cream"  src="Application/Images/peachesn-cream 233.jpg" />

  </a>
';
    while($row = mysql_fetch_assoc($result)) {
$id = $row["id"];
		$name = $row["name"];
		$width = $row["width"];
		$height = $row["height"];
		$link = $row["link"];
		$img = $mappa . $name;
		$html .= "
		<a href='$link' target='_blank'><img src='$img' class='pyro-image alignment-none' width='$width' height='$height' /></a>		
		";
	}

$html .= '</p>';
?>
</body>
</html>
