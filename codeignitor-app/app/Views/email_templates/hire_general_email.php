<html>

<head>
<style type="text/css">
<!--
body{font-family: "Cambria",serif ; background: silver; text-align: center;}
table{margin:auto;  font-size: 12pt; color:#606060;  border:0; padding:0; }

.header {
height:5px; background-color:#d1cec4;text-align: center;
}
h1{font-size: 14pt; margin:40px 0 40px 0px; font-weight: normal; color:#404041; text-align: center;}
.logo{margin:20px 0 20px 30px;}
.tag{margin:auto; text-align: center; margin-top:20px;}
.bodycol{background: #d1cec4;}
.bold{font-weight: bold; text-transform: uppercase;}
.italic{font-style: oblique;color:#606060;}
p{text-align: center;}
hr{margin:0;  padding:0; background: #9b9b9b;height: 1px; color: #9b9b9b; border: 0;}
.space{margin-top:60px;}
.footer{color:#fff; margin:30px 0 0 00px; text-align: center;}
.big{font-size: 14pt; margin-bottom:20px;}
.footer a{color:#fff; text-decoration: none;}
-->
</style>
</head>
<body>
<table width="650" style="background-color: #d1cec4;" border="0" cellspacing="0" cellpadding="0">
<tr class="header">
<td ><img src="https://www.mccalls.co.uk/outfitdesigners/assets/images/interface/outfitdesigner-logo-big.png" class="tag"></td>
</tr>

<tr >
<td colspan="2" class="bodycol">

<!------// Start content //------->

<table width="580" align="center"  >
<tr >
	<td colspan="2">
		<h1>You have been sent a McCalls Highlandwear outfit 
		<?php 
			if ($personname){ echo " from $personname.";}else{echo ".";}
		?></h1>
		<p> <?php 
			if ($message){ echo "<p>$message</p>";}else{echo "";}
		?></p>
		<p>To view this outfit, please click the link below.</p>
		<p class=""><a href="<?php echo "https://www.mccalls.co.uk/outfitbuilder/#ref=$outfitcode";?>" title="View outfit"><img src="https://www.mccalls.co.uk/outfitdesigners/assets/images/constants/viewoutfitonline.png"/></a></p>
	
		<p class="big">
		
		<?php 
			if ($outfitcode){ echo "Outfit Code: $outfitcode";}
		?>
		</p>
	</td>
</tr>

<tbody>

<tr>	<td colspan="3">

<p class="space2">&nbsp</p>
</td></tr>

</tbody>
</table>


<!------// END content //------->
</td>

</tr>

<tr  style="background-color: #404041;">
	<td colspan="2">
		<div class="footer"><strong>McCalls Limited<br/>
 Aberdeen ~ Edinburgh ~ Glasgow ~ Elgin ~ Broughty Ferry ~ Tillicoultry</strong>
<p class="big">t +44 (0)1224 405300 <a href="mailto:highlandwear@mccalls.co.uk">highlandwear@mccalls.co.uk</a></p></div>
	</td>
</tr>
</table>

</body>

</html>