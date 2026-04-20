<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	if (isset($chosenClan[0])):
//	print_r($chosenClan[0]);
	$familyName = $chosenClan[0]['family_name'];
		$familyDescription = $chosenClan[0]['family_description'];
	endif;
	$savedSwatch='<div class="chosenTartanContainer" data-activeswatch="null"></div>';
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
			$savedSwatch = '<div class="chosenTartanContainer"  data-activeswatch="'.$tartanId.'"></div>';
		endif;
	endif;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/12e04dd5-e413-450d-aaa8-d69170a546fa.css"/>
		<link rel="stylesheet" href="<?=base_url()?>assets/css/sass/global.css">
		
	
   </head>
</head>
<body>
<div class="bordered">
	<div class="container-fluid"> 
		<?=$savedSwatch;?>
		<div class="col-xs-12">
			
			<div class="col-xs-12">
			
			<h2>McCalls Tartan Finder</h2>
			<div class="col-xs-8 offset-xs-2">
				<p>Find the right tartan for you from our extensive database, simply search under family or Clan name or choose a location.</p>
			</div>
			
			<ul id="searchOptions">
				<li>
					<div id="searchbar">
						<div class="ui-widget">
							<input id="tags" placeholder="Search">
						</div>		
					</div>
				</li>
				<li>
					<select>
						<option value="volvo">Location</option>
						<option value="volvo">Aberdeen City</option>
						<option value="volvo">Aberdeenshire</option>
						<option value="volvo">Angus</option>
						<option value="volvo">Volvo</option>
						<option value="volvo">Volvo</option>     
					</select>
				</li>
			</ul>
		</div>
	<div class="col-xs-8 ">
		<div class="text-left" style="text-align: left; margin-top:100px;">
		<strong><?=$familyName;?></strong>
		<?=$familyDescription;?>
	</div>
	</div>
	<div class="col-xs-4 text-left">
		MAP HERE
	</div>
	<div class="col-xs-12">
			<main id="content" role="main" class="bg-white">
				<div id="septdetails"> </div>
				<div id="clandetails" > </div>
				 <div id="mcCallsDetails" >
					 <div class="container-responsive results">
						<div id="pridedetails"></div>
				 	</div>	
				 </div>	
			</main>
		</div>

				
	</div>

 	</div>	

		

		<footer id="footer">
			
			<div class="container-responsive "> 
				<div class="col-xs-12 col-md-3 ">
					<div class="row">
						<div class="col-xs-6 col-md-12 mg-t-3"></div>
						<div class="col-xs-12 col-md-12 col-md-offset-0"></div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 mg-t-3"></div>		
				<div class="col-xs-12 col-md-3 mg-t-3"></div>
				<div class="col-xs-12 col-md-3 mg-t-3"></div>
				
			</div>	
		</footer>



</div>
	<script src="<?=base_url()?>assets/js/min/tartanfinder-min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</body>
</html>