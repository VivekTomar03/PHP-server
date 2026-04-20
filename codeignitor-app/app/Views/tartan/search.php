<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$savedSwatch='<div class="headerTartanContainer" data-activeswatch="null"></div>';
	if (isset($savedTartan)):
	 	if (isset($savedTartan['tartan_id']) && strlen($savedTartan['tartan_id']) > 0):
	 	//print_r($savedTartan);
			$tartanId = $savedTartan['tartan_id'];
/*
	$familyName = $savedTartan['tartan_family_name'];
	$tartanId = $savedTartan['tartan_id'];
	$tartanVarient = $savedTartan['tartan_varient'];
	$tartanSwatch = $savedTartan['tartan_swatch'];
*/
			$savedSwatch = '<div class="headerTartanContainer"  data-activeswatch="'.$tartanId.'"></div>';
		endif;
	endif;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<link rel="stylesheet" href="https://www.mccalls.co.uk/assets/css/global.css?v=3.311?">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/global.css?v=<?php echo date("Y-m-d H:i:s");?>">
		
	
   </head>
</head>
<body>
<section id="tartanExplorerIntro">
	<?=$savedSwatch;?>
	<div class="container-fluid p-t-100  p-b-100"> 
		
		<div class="row">
			
			<div class="col-md-4">
				<h2>McCall&#8217;s<br/>Tartan<br/>Explorer</h2>
			</div>
			
			<div class="col-md-5">
				<p>Find the right tartan for you from our extensive database, simply search under family or Clan name or choose a location.</p>
			
				<ul id="searchOptions">
					<li>
						<div id="searchbar">
							<div class="ui-widget">
								<input id="tags" placeholder="Search">
							</div>	
							<div id="searchresults"></div>
						</div>
					</li>
<!--
					<li>
						<select class="select">
							<option value="">Location</option>
							<option value="1">Aberdeen City</option>
							<option value="2">Aberdeenshire</option>
							<option value="3">Angus</option>
							<option value="4">Aryshire</option>
							
						</select>
					</li>
-->
				</ul>
			
			</div>
		
			
		</div>
	</div>	
</section>

<section id="tartanExplorerResults">
	<div class="container-fluid "> 
		
			<main id="content" role="main"  >
				<div id="septdetails"> </div>
				<div id="clandetails" > </div>
				<div id="showproductsdetails" style="display: none;">
					<div class="row">
				 		
			 		</div>
				</div>
				 <div id="mcCallsDetails" >
					 <div class="results">
						 
				 		<div id="pridedetails">
					 		
				 		</div>
				 		
					 	
				 	</div>	
				 </div>	
			</main>
		</div>

				
	</div>

 	</section>	
<section class="advertPanel"><div class="container-fluid"><div class="row"><div class="col-12 col-md-6 offset-md-3"><h2>With Over 130 years of heritage and expertise, McCalls are a name you can trust</h2></div></div></div></section>
		
<section id="iconPanel" class="p-b-100 p-t-100"><div class="container-fluid"><div class="row"><div class="col-4 col-md-2 offset-md-1"><div onclick="document.location='https://www.mccalls.co.uk/build-your-outfit'">
<a href="https://www.mccalls.co.uk/build-your-outfit"><img src="https://www.mccalls.co.uk/assets/img/constants/icon-large-outfit.png" width="90" alt=" " class="img-fluid"></a><h3><a href="https://www.mccalls.co.uk/build-your-outfit">Outfit Designer</a></h3><p><a href="https://www.mccalls.co.uk/build-your-outfit">Design your own outfit to hire or buy</a></p></div></div><div class="col-4 col-md-2 offset-md-2">
<a href="https://www.mccalls.co.uk/build-your-outfit/sporran"><img src="https://www.mccalls.co.uk/assets/img/constants/icon-large-sporran.png" width="90" alt=" " class="img-fluid"></a><h3><a href="https://www.mccalls.co.uk/build-your-outfit/sporran">Sporran Designer</a></h3><p><a href="https://www.mccalls.co.uk/build-your-outfit/sporran">Select your choice of skin, cantle and tassel</a></p></div><div class="col-4 col-md-2 offset-md-2">
<a href="https://www.mccalls.co.uk/products/mens/kilts-trews/machine-stitched-heavyweight-kilts"><img src="https://www.mccalls.co.uk/assets/img/constants/icon-large-swatch.png" width="90" alt=" " class="img-fluid"></a><h3><a href="https://www.mccalls.co.uk/products/mens/kilts-trews/machine-stitched-heavyweight-kilts">Tartan Explorer</a></h3><p><a href="https://www.mccalls.co.uk/products/mens/kilts-trews/machine-stitched-heavyweight-kilts">Find your perfect tartan from our database</a></p></div></div></div></section>


<section id="footer">
		<div class="container-fluid">
			<div class="row">
			
		
				<div class="col-md-12 mb-50">
		

				 <ul>	
				 	<li>
				        	<a href="https://www.mccalls.co.uk/stores">Contact us</a>
				        </li>
<!--
				        	<li>
				        	<a href="https://www.mccalls.co.uk/about-mccalls">About</a>
				        </li>
-->
				         
				        	<li>
				        	<a href="https://www.mccalls.co.uk/account/welcome">Account</a>
				        </li>
				        
				        	<li>
				        	<a href="https://www.mccalls.co.uk/policies/returns-policy">Returns Policy</a>
				        </li>
				        <li>
				        		<a href="https://www.mccalls.co.uk/policies/privacy-t-and-c">Privacy Policy and T&amp;Cs</a>
				        </li>
				        <li>
				        	<a href="https://www.mccalls.co.uk/assets/brochures/PrideBrochure">Pride of Scotland Brochure</a>
				        </li>
				        
				 	</ul>	
			
				
				
			 <a href="https://www.mccalls.co.uk/"><img src="https://www.mccalls.co.uk/assets/img/constants/mccalls-logo.png" width="45" alt="McCalls Highlandwear " class="  logo m-t-100 m-b-50"></a>
			 
			 <ul class="social-icons ">
					<li><a href="https://www.facebook.com/McCallsLtd/" target="_blank" title="Follow us on Twitter"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>				
					<li><a href="https://twitter.com/mccallsltd?lang=en" target="_blank" title="Follow us on Twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
					<li><a href="https://www.pinterest.co.uk/pin/329255422734758525/?lp=true" target="_blank" title="Follow us on Instagram"><span class="fa fa-pinterest" aria-hidden="true"></span></a></li>
					<li><a href="https://www.youtube.com/channel/UC2qP1JjDHXQOpSiAuzTcfPw" target="_blank" title="Watch us on YouTube"><span class="fa  fa-youtube-play" aria-hidden="true"></span></a></li>
				</ul>
			
			<p class="small m-t-100  m-b-50 ">Copyright McCalls Highlandwear 2019</p> 
				 </div>
			</div>
		</div>
	</section>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAUqBHhdUrjrfPEYd5aAQOW8MP5QXr3lQ"></script>
<script type="text/javascript" src="https://www.mccalls.co.uk/assets/js/jquery-3.2.1-min.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="<?=base_url()?>assets/js/min/tartanfinder-min.js?v=<?php echo date("Y-m-d-H-i-s");?>"></script>

</body>
</html>