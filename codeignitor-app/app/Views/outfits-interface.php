<?php
	$url = base_url();//env('app.baseUrl');

	$tartandropdown = '';
	$tartanPrideDropdown = '';
	$tartanPremiumDropdown = '';
	$tartanPrideDropdown2 = '';
	//echo $outfitcode.'<br/>';
	$tartanActive = substr($outfitcode, 1, 4);
	$sporranActive = substr($outfitcode, 5, 3);
	$shirtActive = substr($outfitcode, 9, 2);
	$neckActive = substr($outfitcode, 12, 2);
	$shoesActive = substr($outfitcode, 14, 1);
	$jacketActive = substr($outfitcode, 15, 2);
	$hoseActive = substr($outfitcode, 18, 2);
	$hireorbuy = substr($outfitcode, 20, 1);

	// Default encase swicthing or item discontinued
	//echo $outfitCodeDefault;
	$defaultTartanActive = substr($outfitCodeDefault, 1, 4);
	$defaultSporranActive = substr($outfitCodeDefault, 5, 3);
	$defaultShirtActive = substr($outfitCodeDefault, 9, 2);
	$defaultNeckActive = substr($outfitCodeDefault, 12, 2);
	$defaultShoesActive = substr($outfitCodeDefault, 14, 1);
	$defaultJacketActive = substr($outfitCodeDefault, 15, 2);
	$defaultHoseActive = substr($outfitCodeDefault, 18, 2);

	//$hireorbuy= substr($outfitCodeDefault,20, 1);

	foreach($tartandata as $tartan):
		$tartanDefaultActiveClass = '';
		$tartanActiveClass = '';
		if($tartanActive == $tartan['tartan_id']) {
			$tartanActiveClass = "active";
		}
		if($defaultTartanActive == $tartan['tartan_id']) {
			$tartanDefaultActiveClass = "defaultActive";
		}

		if($tartan['tartan_supplier'] == 'mccalls'):
			$tartanPrideDropdown .= '<li class="swiper-slide   ' . $tartanActiveClass . ' ' . $tartanDefaultActiveClass . '"  data-code="' . $tartan['tartan_id'] . '"  data-family="' . $tartan['tartan_family_name'] . '">';
			if($tartan['tartan_id'] == "Z2YZ"):
				// $tartanPrideDropdown .=  '<div class="newOverlay"></div>';
			endif;

			$image = '<img src="' . $tartan['tartan_swatch'] . '"  alt="Tartan ' . $tartan['tartan_name'] . '"  ><div style="text-align:center; padding:5px;">' . $tartan['tartan_name'] . '</div>';
			$tartanPrideDropdown .= $image;

			$tartanPrideDropdown .= '</li>';
			$tartanPrideDropdown2 .= '</div>';
		elseif($tartan['tartan_supplier'] == 'premium'):
			$tartanPremiumDropdown .= '<li  class="swiper-slide ' . $tartanActiveClass . ' ' . $tartanDefaultActiveClass . '"  data-code="' . $tartan['tartan_id'] . '"  data-family="' . $tartan['tartan_family_name'] . '">';
			if($tartan['tartan_id'] == "SMS7"):
				//	$tartanPremiumDropdown .=  '<div class="newOverlay"></div>';
			endif;
			$tartanPremiumDropdown .= '<img src="' . $tartan['tartan_swatch'] . '"  alt="Tartan ' . $tartan['tartan_name'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $tartan['tartan_name'] . '" width="50"><div style="text-align:center; padding:5px;">' . $tartan['tartan_name'] . '</div></li>';

		else:
			$tartandropdown .= '<li  class="swiper-slide ' . $tartanActiveClass . ' ' . $tartanDefaultActiveClass . '"  data-code="' . $tartan['tartan_id'] . '"  data-family="' . $tartan['tartan_family_name'] . '"><img src="' . $tartan['tartan_swatch'] . '"  alt="Tartan ' . $tartan['tartan_name'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $tartan['tartan_name'] . '" width="50"><div style="text-align:center; padding:5px;">' . $tartan['tartan_name'] . '</div></li>';

		endif;
	endforeach;

	$cantleactivefinish = 'Chrome';
	// CHROME CANTLES
	$cantlelistChrome = '';
	foreach($sporranChromeData as $sporran):
		$sporranDefaultActiveClass = '';
		$sporranActiveClass = '';

		if($sporranActive == $sporran['pref']) {
			$sporranActiveClass = "active";
		}
		if($defaultSporranActive == $sporran['pref']) {
			$sporranDefaultActiveClass = "defaultActive";
		}
		$cantlelistChrome .= '<li class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '" data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
	endforeach;

	// ANTIQUE CANTLES
	$sporranDefaultActiveClass = '';
	$sporranActiveClass = '';
	$cantlelistAntique = '';
	if($sporranAntiqueData):
		foreach($sporranAntiqueData as $sporran):
			$sporranActiveClass = '';
			if($sporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}
			if($defaultSporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}

			$cantlelistAntique .= '<li class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '" data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
		endforeach;
	endif;

	// COPPER CANTLES
	$cantlelistCopperGold = '';
	if($sporranCopperData):
		foreach($sporranCopperData as $sporran):
			$sporranActiveClass = '';
			$sporranDefaultActiveClass = '';
			if($sporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}
			if($defaultSporranActive == $sporran['pref']) {
				$sporranDefaultActiveClass = "active";
			}

			$cantlelistCopperGold .= '<li class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '" data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
		endforeach;
	endif;

	// GOLD CANTLES
	$cantlelistCopperGold = '';
	if($sporranGoldData):
		foreach($sporranGoldData as $sporran):
			$sporranActiveClass = '';
			$sporranDefaultActiveClass = '';
			if($sporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}
			if($defaultSporranActive == $sporran['pref']) {
				$sporranDefaultActiveClass = "active";
			}

			$cantlelistCopperGold .= '<li  class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '" data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
		endforeach;
	endif;
	// DAY
	$cantlelistDay = '';
	if($sporranDayData):
		foreach($sporranDayData as $sporran):
			$sporranActiveClass = '';
			$sporranDefaultActiveClass = '';
			if($sporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}
			if($defaultSporranActive == $sporran['pref']) {
				$sporranDefaultActiveClass = "active";
			}
			$cantlelistDay .= '<li  class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '"  data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
		endforeach;
	endif;

	// DAY
	$cantlelistPewter = '';
	if($sporranPewterData):
		foreach($sporranPewterData as $sporran):
			$sporranActiveClass = '';
			$sporranDefaultActiveClass = '';
			if($sporranActive == $sporran['pref']) {
				$sporranActiveClass = "active";
			}
			if($defaultSporranActive == $sporran['pref']) {
				$sporranDefaultActiveClass = "active";
			}
			$cantlelistPewter .= '<li class="swiper-slide ' . $sporranActiveClass . ' ' . $sporranDefaultActiveClass . '"  data-code="' . $sporran['pref'] . '"><img src="' . $sporran['ptn'] . '"  alt="Sporran Skin ' . $sporran['pname'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $sporran['pname'] . '" width="50"><div>'.$sporran['pname'].'</div></li>';
		endforeach;
	endif;


	// SHIRTS
	$shirtList = '';
	//print_r($shirtData);
	foreach($shirtData as $element):
		$shirtActiveClass = '';
		$shirtDefaultActiveClass = '';
		//	echo $shirtActive;
		if($shirtActive == $element['pref']) {
			$shirtActiveClass = "active";
		}

		if($defaultShirtActive == $element['pref']) {
			$shirtDefaultActiveClass = "active";
		}
		$shirtList .= '<li  class="swiper-slide ' . $shirtActiveClass . ' ' . $shirtDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	// NECKWEAR

	$neckwearCravatList = '';
	//echo $neckActive;
	foreach($neckwearCravatData as $element):
		$neckwearActiveClass = '';
		$neckwearDefaultActiveClass = '';
		if($neckActive == $element['pref']) {
			$neckwearActiveClass = "active";
		}

		if($defaultShirtActive == $element['pref']) {
			$neckwearDefaultActiveClass = "active";
		}

		$neckwearCravatList .= '<li  class="swiper-slide ' . $neckwearActiveClass . ' ' . $neckwearDefaultActiveClass . '" data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$neckwearSilktieList = '';
	foreach($neckwearSilktieData as $element):
		$neckwearActiveClass = '';
		$neckwearDefaultActiveClass = '';
		if($neckActive == $element['pref']) {
			$neckwearActiveClass = "active";
		}
		if($defaultShirtActive == $element['pref']) {
			$neckwearDefaultActiveClass = "active";
		}

		$neckwearSilktieList .= '<li  class="swiper-slide ' . $neckwearActiveClass . ' ' . $neckwearDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$neckwearBowtieList = '';
	//	print_r($neckwearBowtieData);
	foreach($neckwearBowtieData as $element):
		$neckwearActiveClass = '';
		$neckwearDefaultActiveClass = '';
		if($neckActive == $element['pref']) {
			$neckwearActiveClass = "active";
		}
		if($defaultShirtActive == $element['pref']) {
			$neckwearDefaultActiveClass = "active";
		}
		$neckwearBowtieList .= '<li  class="swiper-slide ' . $neckwearActiveClass . ' ' . $neckwearDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$neckwearWooltieList = '';
	foreach($neckwearWooltieData as $element):
		$neckwearActiveClass = '';
		$neckwearActiveClass = '';
		if($neckActive == $element['pref']) {
			$neckwearActiveClass = "active";
		}
		if($defaultShirtActive == $element['pref']) {
			$neckwearDefaultActiveClass = "active";
		}
		$neckwearWooltieList .= '<li class="swiper-slide ' . $neckwearActiveClass . ' ' . $neckwearDefaultActiveClass . '"   data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	// JACKETS

	$jacketList = '';
	// print_r($jacketsData);
	foreach($jacketsData as $element):
		$jacketsActiveClass = '';
		$jacketsDefaultActiveClass = '';
		if($jacketActive == $element['pref']) {
			$jacketsActiveClass = "active";
		}
		if($defaultJacketActive == $element['pref']) {
			$jacketsDefaultActiveClass = "active";
		}

		$jacketList .= '<li class="swiper-slide ' . $jacketsActiveClass . ' ' . $jacketsDefaultActiveClass . '"   data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Jackets" class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	// HOSE
	$hoseEcruList = '';
	//echo $hoseActive;
	foreach($hoseEcruData as $element):
		$hoseEcruActiveClass = '';
		$hoseEcruDefaultActiveClass = '';
		if($hoseActive == $element['pref']) {
			$hoseEcruActiveClass = "active";
		}
		if($defaultHoseActive == $element['pref']) {
			$hoseEcruDefaultActiveClass = "active";
		}

		$hoseEcruList .= '<li class="swiper-slide ' . $hoseEcruActiveClass . ' ' . $hoseEcruDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"   alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$hoseCharcoalList = '';
	foreach($hoseCharcoalData as $element):
		$hoseCharcoalActiveClass = '';
		$hoseDefaultActiveClass = '';
		if($hoseActive == $element['pref']) {
			$hoseCharcoalActiveClass = "active";
		}
		if($defaultHoseActive == $element['pref']) {
			$hoseDefaultActiveClass = "active";
		}
		$hoseCharcoalList .= '<li  class="swiper-slide ' . $hoseCharcoalActiveClass . ' ' . $hoseDefaultActiveClass . '"   data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"   alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$hoseBlackList = '';
	foreach($hoseBlackData as $element):
		$hoseBlackActiveClass = '';
		$hoseDefaultActiveClass = '';
		if($hoseActive == $element['pref']) {
			$hoseBlackActiveClass = "active";
		}
		if($defaultHoseActive == $element['pref']) {
			$hoseDefaultActiveClass = "active";
		}
		$hoseBlackList .= '<li class="swiper-slide ' . $hoseBlackActiveClass . ' ' . $hoseDefaultActiveClass . '"   data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"   alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$hoseColourList = '';
	foreach($hoseColourData as $element):
		$hoseColourActiveClass = '';
		$hoseDefaultActiveClass = '';
		if($hoseActive == $element['pref']) {
			$hoseColourActiveClass = "active";
		}
		if($defaultHoseActive == $element['pref']) {
			$hoseDefaultActiveClass = "active";
		}
		$hoseColourList .= '<li  class="swiper-slide ' . $hoseColourActiveClass . ' ' . $hoseDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;

	$hoseTartanList = '';
	if($hoseTartanData):
		foreach($hoseTartanData as $element):
			$hoseTartanActiveClass = '';
			$hoseDefaultActiveClass = '';
			if($hoseActive == $element['pref']) {
				$hoseTartanActiveClass = "active";
			}
			if($defaultHoseActive == $element['pref']) {
				$hoseDefaultActiveClass = "active";
			}
			$hoseTartanList .= '<li  class="swiper-slide ' . $hoseTartanActiveClass . ' ' . $hoseDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
		endforeach;
	endif;


	// SHOES
	$shoesList = '';
	//print_r($shirtData);
	foreach($shoesData as $element):
		$shoesActiveClass = '';
		$shoesDefaultActiveClass = '';

		if($shoesActive == $element['pref']) {
			$shoesActiveClass = "active";
		}

		if($defaultShoesActive == $element['pref']) {
			$shoesDefaultActiveClass = "active";
		}
		$shoesList .= '<li  class="swiper-slide ' . $shoesActiveClass . ' ' . $shoesDefaultActiveClass . '"  data-code="' . $element['pref'] . '"><img src="' . $element['ptn'] . '"  alt="Sporran Skin " class="quicktip" data-toggle="tooltip" data-placement="top" title="' . $element['pname'] . '" width="50"><div>'.$element['pname'].'</div></li>';
	endforeach;
?>
<div class="introduction m-b-50 d-block">
	<h1>Build your own outfit</h1>
	<p>Use the tabs below to browse through our huge range of tartans, sporrans, jackets and ties to build your perfect
		outfit to buy. Then, when you're done, you can save and share it with your family and friends or add it to your
		bag to purchase.</p>
</div>

<?php
	$buyclass = $hireclass = '';
	if($hireorbuy == 'B'):$buyclass = 'active';endif;
	if($hireorbuy == 'H'):$hireclass = 'active';endif;
?>

<ul id="hirebuytoggle" data-type="<?= $hireorbuy; ?>" data-loadcode="<?= $outfitcode; ?>">
	<li class="hiretype <?= $hireclass; ?>"><span>To Hire</span></li>
	<!--<li class="buytype <?/*= $buyclass; */?>"><a href="#">To Buy</a></li>-->
</ul>


<div class="col-12 d-block d-md-none text-center">
	<div id="previewWrapperMobile">
		<div class="preview_container">
			<div class="info-toggle active"></div>
			<div class="info-container">
				<div class="icon-info"></div>
				<div class="outfit-info"></div>
				<div class="zoomout d-none"></div>
			</div>
			<div id="previewimageMobile"></div>
		</div>
	</div>
</div>

<div class="outfit-element-menu swiperOptions swiper">
	<ul class="swiper-wrapper">
		<li data-option="kilt" class="swiper-slide active">
			<div class="arrow"></div>
			<a href="#" title="Kilt">
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-kilt.svg" width="50" height="50">
				<span class="label">Kilt</span>
			</a>
		</li>
		<li data-option="jackets" class="swiper-slide"><a href="#" title="Jacket">
				<div class="arrow"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-jacket.svg" width="50" height="50">
				<span class="label">Jacket</span></a></li>
		<li data-option="neckwear" class="swiper-slide"><a href="#">
				<div class="arrow"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-neck.svg" width="50" height="50">
				<span class="label">Neck</span></a></li>
		<li data-option="sporran" class="swiper-slide"><a href="#" title="Sporran">
				<div class="arrow"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-sporran.svg" width="50" height="50">
				<span class="label">Sporran</span></a></li>
		<li data-option="shoes" class="swiper-slide"><a href="#" title="Shoes">
				<div class="arrow d-none"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-shoe.svg" width="50" height="50">
				<span class="label">Shoes</span></a>
		</li>
		<li data-option="hose" class="swiper-slide"><a href="#" title="Hose">
				<div class="arrow d-none"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-hose.svg" width="50" height="50">
				<span class="label">Hose</span></a>
		</li>
		<li data-option="shirt" class="swiper-slide"><a href="#" title="Shirt">
				<div class="arrow"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-shirt.svg" width="50" height="50">
				<span class="label">Shirt</span></a>
		</li>
		<?php if($hireorbuy == 'B'): ?>
		<li data-option="details" class="swiper-slide">
			<a href="#" title="Details">
				<div class="arrow"></div>
				<img src="<?= $url; ?>assets/img/outfitdesigner/interface/icon-details.svg" width="50" height="50">
				<span class="label">Details</span>
			</a>
		</li>
		<?php endif; ?>
	</ul>
	<div class="swiper-button-options-next"></div>
	<div class="swiper-button-options-prev"></div>
</div>

<div class="options">

	<div class="options-kilt option-group active">
		<?php
			$familyname = '';
			$loaded = '';
			if(isset($tartansearchdata['family_tartans'])):
				$loaded = '<ul class="menu_options tartanlist">';
				$tartanActiveClass = '';

				foreach($tartansearchdata['family_tartans'] as $familytartan):
					//print_r($familytartan);
					if($tartanActive == $familytartan['tartan_uniquecode']) {
						$tartanActiveClass = "active";
					} else {
						$tartanActiveClass = "";
					}

					$familyname = $familytartan['tartan_family_name'];
					$loaded .= '<li class="quicktip ' . $tartanActiveClass . '" data-code="' . $familytartan['tartan_uniquecode'] . '" ><img src="' . $familytartan['tartan_thumbnail'] . '" alt="' . $familytartan['tartan_family_name'] . ' ' . $familytartan['tartan_varient'] . '" class="quicktip" data-toggle="tooltip" data-placement="top" title="" width="50" data-original-title="' . $familytartan['tartan_family_name'] . ' ' . $familytartan['tartan_varient'] . '" aria-describedby="tooltip' . $familytartan['tartan_uniquecode'] . '"></li>';
				endforeach;
				$loaded .= '</ul>';
			endif;
			echo '<ul class="menu_suboption optionTitle menu_options_parent">
					<li>
						<div class="stepno">STEP 1 of 7</div>
						<h3>Select a Tartan</h3>
					</li>
				  </ul>';

			if($hireorbuy == 'B'):
				echo '<div class="ui-widget">
								
								  <input id="tags"  value="' . $familyname . '" placeholder="Start typing tartan name&hellip;">
								</div>	<div id="searchswatches" >' . $loaded . '</div>
								<ul class="menu_suboption optionTitle menu_options_parent"><li>Or select a swatch</li></ul>';
			endif;
		?>

		<h4 class="panel-title">
			<a class="collapsed colapseLink currentlyActive" data-toggle="collapse"
			   href="#collapsePride" aria-expanded="false" aria-controls="collapsePride"
			   style="display:inline-block; margin-right:25px;">Pride</a>
			<a class="collapsed colapseLink" data-toggle="collapse"
			   href="#collapsePremium" aria-expanded="false" aria-controls="collapsePremium"
			   style="display:inline-block; margin-right:25px;">Premium</a>
			<a class="collapsed colapseLink" data-toggle="collapse"
			   href="#collapseStandard" aria-expanded="false" aria-controls="collapseStandard"
			   style="display:inline-block; margin-right:25px;">Standard</a>
		</h4>

		<div id="accordionTartan" role="tablist" aria-multiselectable="false">
			<?php
				if($tartanPrideDropdown != ''):
					echo "<div data-parent='#accordionTartan' id='collapsePride' class='accordion-item panel-collapse collapse show' role='tabpanel' aria-labelledby='headingOne'><div  class=\"swiper optionSlider\" ><ul class=\"menu_options tartanlist  swiper-wrapper \">$tartanPrideDropdown</ul>
							<div class=\"swiper-button-next2\"></div>
							<div class=\"swiper-button-prev2\"></div></div></div>";
				endif;

				if($tartanPremiumDropdown != ''):
					echo "<div data-parent='#accordionTartan' id='collapsePremium' class='accordion-item panel-collapse collapse hide' role='tabpanel' aria-labelledby='headingOne'><div  class=\"swiper optionSlider\" ><ul class='menu_options tartanlist swiper-wrapper'>$tartanPremiumDropdown</ul>	<div class=\"swiper-button-next2\"></div>
							<div class=\"swiper-button-prev2\"></div></div></div>";
				endif;

				if($tartandropdown != ''):

					echo "<div data-parent='#accordionTartan' id='collapseStandard' class='accordion-item panel-collapse collapse hide' role='tabpanel' aria-labelledby='headingOne'><div  class=\"swiper optionSlider\" ><ul class='menu_options tartanlist swiper-wrapper'>$tartandropdown</ul>	<div class=\"swiper-button-next2\"></div>
							<div class=\"swiper-button-prev2\"></div></div></div>";
				endif;
			?>
		</div>
	</div>

	<div class="options-sporran option-group ">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">STEP 2 of 7</div>
				<h3>Select a Sporran</h3>
			</li>
		</ul>

		<div id='cantletypes' class='menu_options_parent'>
			<h4 class="panel-title">
				<?php if(strlen($cantlelistAntique) > 0): ?>
					<a class="collapsed colapseLink" data-toggle="collapse"
															   data-parent="#accordion" href="#collapseOne"
															   aria-expanded="true"
															   aria-controls="collapseOne">Antique
					</a>
				<?php endif; ?>
				<?php if(strlen($cantlelistChrome) > 0): ?>
					<a class="collapsed colapseLink currentlyActive" style="display:inline-block; margin-right:25px;"
					   data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true"
					   aria-controls="collapseTwo">Chrome</a>
				<?php endif; ?>
				<?php if(strlen($cantlelistPewter) > 0): ?>
					<a class="collapsesd colapseLink" data-toggle="collapse" data-parent="#accordion"
					   href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Pewter
						<div class="icontoggle"></div>
					</a>
				<?php endif; ?>
				<?php if(strlen($cantlelistDay) > 0): ?>
					<a class="collapsed colapseLink" style="display:inline-block; margin-right:25px;"
					   data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true"
					   aria-controls="collapseFour">Day</a>
				<?php endif; ?>
			</h4>

			<div id="accordion" role="tablist" aria-multiselectable="false">
				<?php if(strlen($cantlelistAntique) > 0): ?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
								   aria-expanded="false" aria-controls="collapseOne">Antique
									<div class="icontoggle"></div>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel"
							 aria-labelledby="headingOne">
							<div class="swiper optionSlider">
								<ul class='menu_options sporranlist swiper-wrapper'><?= $cantlelistAntique; ?></ul>
								<div class="swiper-button-next2"></div>
								<div class="swiper-button-prev2"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="panel panel-default">

					<div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel"
						 aria-labelledby="headingTwo">
						<div class="swiper optionSlider">
							<ul class='menu_options sporranlist swiper-wrapper'><?= $cantlelistChrome; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>

				<?php if(strlen($cantlelistPewter) > 0): ?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingFive">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#accordion"
								   href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Pewter
									<div class="icontoggle"></div>
								</a>
							</h4>
						</div>
						<div id="collapseFive" class="panel-collapse collapse show" role="tabpanel"
							 aria-labelledby="headingFive">
							<div class="swiper optionSlider">
								<ul class='menu_options sporranlist swiper-wrapper'><?= $cantlelistPewter; ?></ul>
								<div class="swiper-button-next2"></div>
								<div class="swiper-button-prev2"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>


				<?php if(strlen($cantlelistCopperGold) > 0): ?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#accordion"
								   href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Copper &
									Gold
									<div class="icontoggle"></div>
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse show" role="tabpanel"
							 aria-labelledby="headingThree">
							<div class="swiper optionSlider">
								<ul class='menu_options sporranlist swiper-wrapper'><?= $cantlelistCopperGold; ?></ul>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="panel panel-default">
					<div id="collapseFour" class="panel-collapse collapse " role="tabpanel"
						 aria-labelledby="headingFour">
						<div class="swiper optionSlider">
							<ul class='menu_options sporranlist swiper-wrapper'><?= $cantlelistDay; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="options-shirt option-group ">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">STEP 3 of 7</div>
				<h3>Select a
					Shirt</h3> <?php if($hireorbuy == "H"): ?> (not included in the hire package and can be purchased separately - &pound;17.50 white/&pound;21 black) <?php endif; ?>
			</li>
		</ul>

		<?php
			if($shirtList != ''):
				echo "<div  class=\"swiper optionSlider\" ><ul class='menu_options shirtlist swiper-wrapper'>$shirtList</ul></div>";
			endif;
		?>
	</div>

	<div class="options-neckwear option-group ">

		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">STEP 4 of 7</div>
				<h3>Neckwear</h3>
			</li>
		</ul>
		<div id='neckweartypes' class='menu_options_parent'>
			<div class="panel-heading" role="tab" id="headingBow">
				<h4 class="panel-title">
					<a class="collapsed colapseLink currentlyActive" data-toggle="collapse"
					   href="#collapseBow" aria-expanded="true" aria-controls="collapseBow"
					   style="display:inline-block; margin-right:25px;">Bow</a>
					<a class="collapsed colapseLink" data-toggle="collapse" href="#collapseCravat" aria-expanded="true" aria-controls="collapseCravat"
					   style="display:inline-block; margin-right:25px;">Cravat</a>
					<a class="collapsed colapseLink" data-toggle="collapse"
					   href="#collapseSilktie" aria-expanded="true" aria-controls="collapseSilktie"
					   style="display:inline-block; margin-right:25px;">Silk</a>
					<a class="collapsed colapseLink" data-toggle="collapse"
					   href="#collapseWooltie" aria-expanded="true" aria-controls="collapseWooltie"
					   style="display:inline-block; margin-right:25px;">Wool</a>

				</h4>
			</div>
			<div id="accordion" role="tablist" aria-multiselectable="false">

				<div class="panel panel-default">

					<div id="collapseBow" class="panel-collapse collapse show " role="tabpanel" aria-labelledby="headingBow" data-parent="#accordion">
						<div class="swiper optionSlider">
							<ul class='menu_options necklist swiper-wrapper'><?= $neckwearBowtieList; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">

					<div id="collapseCravat" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingCravat" data-parent="#accordion">
						<div class="swiper optionSlider">
							<ul class="menu_options necklist  swiper-wrapper"> <?= $neckwearCravatList; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>


				<div class="panel panel-default">

					<div id="collapseSilktie" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingSilktie" data-parent="#accordion">
						<div class="swiper optionSlider">
							<ul class="menu_options necklist  swiper-wrapper"> <?= $neckwearSilktieList; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>


				<div class="panel panel-default">

					<div id="collapseWooltie" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingWooltie" data-parent="#accordion">
						<div class="swiper optionSlider">
							<ul class="menu_options necklist  swiper-wrapper"> <?= $neckwearWooltieList; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="options-jackets option-group  ">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">STEP 5 of 7</div>
				<h3>Select a Jacket</h3></li>
		</ul>
		<?php
			if($jacketList != ''):
				echo "<div  class=\"swiper optionSlider\" ><ul class='menu_options swiper-wrapper'>$jacketList</ul><div class=\"swiper-button-next2\"></div>
										   <div class=\"swiper-button-prev2\"></div></div>";
			endif;
		?>
	</div>

	<div class="options-shoes option-group  ">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">STEP 7 of 7</div>
				<h3>Select Shoes</h3>
			</li>
		</ul>
		<?php
			if($shoesList != ''):
				echo "<div  class=\"swiper optionSlider\" ><ul class='menu_options swiper-wrapper'>$shoesList</ul></div>";
			endif;
		?>
	</div>


	<div class="options-hose option-group">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>
				<div class="stepno">Step 6 of 7</div>
				<h3>Select Hose</h3>
				<?php if($hireorbuy == "H"): ?>
					(not included in the hire package and can be purchased separately from &pound;17.50)
				<?php endif; ?>
			</li>
		</ul>
		<div id='hosetypes' class='menu_options_parent'>

			<div id="accordion" role="tablist" aria-multiselectable="true">

				<div class="panel panel-default">

					<div id="collapseHoseEcru" class="panel-collapse  collapse show " role="tabpanel"
						 aria-labelledby="headingHoseEcru">
						<div class="swiper optionSlider">
							<ul class="menu_options hoselist swiper-wrapper"> <?= $hoseEcruList; ?><?= $hoseCharcoalList; ?><?= $hoseBlackList; ?><?= $hoseColourList; ?><?= $hoseTartanList; ?></ul>
							<div class="swiper-button-next2"></div>
							<div class="swiper-button-prev2"></div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	<div class="options-details option-group ">
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li><h3>YOUR DETAILS</h3></li>
		</ul>
		<ul class="menu_suboption optionTitle menu_options_parent">
			<li>KILT</li>
		</ul>
		<div class="container-fluid p-0">
			<form method="get" id="outfitSizes">
				<div class="row">
					<div class="col-md-6">
						<select name="options[Waist Size]" class="select hidden hiddenWaistSize" tabindex="-1" required=""
								aria-required="true" style="">
							<option value="" data-pricechange="0">Waist Size</option>
							<option value="28&quot; (71 cm)" data-pricechange="0">28" (71 cm)</option>
							<option value="29&quot; (73 cm)" data-pricechange="0">29" (73 cm)</option>
							<option value="30&quot; (76 cm)" data-pricechange="0">30" (76 cm)</option>
							<option value="31&quot; (78 cm)" data-pricechange="0">31" (78 cm)</option>
							<option value="32&quot; (81 cm)" data-pricechange="0">32" (81 cm)</option>
							<option value="33&quot; (83 cm)" data-pricechange="0">33" (83 cm)</option>
							<option value="34&quot; (86 cm)" data-pricechange="0">34" (86 cm)</option>
							<option value="35&quot; (88 cm)" data-pricechange="0">35" (88 cm)</option>
							<option value="36&quot; (92 cm)" data-pricechange="0">36" (92 cm)</option>
							<option value="37&quot; (94 cm)" data-pricechange="0">37" (94 cm)</option>
							<option value="38&quot; (96 cm)" data-pricechange="0">38" (96 cm)</option>
							<option value="39&quot; (99 cm)" data-pricechange="0">39" (99 cm)</option>
							<option value="40&quot; (101 cm)" data-pricechange="0">40" (101 cm)</option>
							<option value="41&quot; (104 cm)" data-pricechange="0">41" (104 cm)</option>
							<option value="42&quot; (106 cm)" data-pricechange="0">42" (106 cm)</option>
							<option value="43&quot; (109 cm)" data-pricechange="0">43" (109 cm)</option>
							<option value="44&quot; (111 cm)" data-pricechange="0">44" (111 cm)</option>
							<option value="45&quot; (114 cm)" data-pricechange="0">45" (114 cm)</option>
							<option value="46&quot; (116 cm)" data-pricechange="0">46" (116 cm)</option>
							<option value="47&quot; (119 cm)" data-pricechange="0">47" (119 cm)</option>
							<option value="48&quot; (122 cm)" data-pricechange="0">48" (122 cm)</option>
							<option value="49&quot; (124 cm)" data-pricechange="0">49" (124 cm)</option>
							<option value="50&quot; (127 cm)" data-pricechange="0">50" (127 cm)</option>
						</select>
					</div>
					<div class="col-md-6">
						<select name="options[Seat Size]" class="select hidden hiddenSeatSize" tabindex="-1" required=""
								aria-required="true" style="">
							<option value="" data-pricechange="0">Seat Size</option>
							<option value="29&quot; (71 cm)" data-pricechange="0">29" (71 cm)</option>
							<option value="30&quot; (76 cm)" data-pricechange="0">30" (76 cm)</option>
							<option value="31&quot; (78 cm)" data-pricechange="0">31" (78 cm)</option>
							<option value="32&quot; (81 cm)" data-pricechange="0">32" (81 cm)</option>
							<option value="33&quot; (83 cm)" data-pricechange="0">33" (83 cm)</option>
							<option value="34&quot; (86 cm)" data-pricechange="0">34" (86 cm)</option>
							<option value="35&quot; (88 cm)" data-pricechange="0">35" (88 cm)</option>
							<option value="36&quot; (91 cm)" data-pricechange="0">36" (91 cm)</option>
							<option value="37&quot; (94 cm)" data-pricechange="0">37" (94 cm)</option>
							<option value="38&quot; (96 cm)" data-pricechange="0">38" (96 cm)</option>
							<option value="39&quot; (99 cm)" data-pricechange="0">39" (99 cm)</option>
							<option value="40&quot; (101 cm)" data-pricechange="0">40" (101 cm)</option>
							<option value="41&quot; (104 cm)" data-pricechange="0">41" (104 cm)</option>
							<option value="42&quot; (106 cm)" data-pricechange="0">42" (106 cm)</option>
							<option value="43&quot; (109 cm)" data-pricechange="0">43" (109 cm)</option>
							<option value="44&quot; (111 cm)" data-pricechange="0">44" (111 cm)</option>
							<option value="45&quot; (114 cm) (+ £50)" data-pricechange="50">45" (114 cm) (+ £50)</option>
							<option value="46&quot; (116 cm) (+ £50)" data-pricechange="50">46" (116 cm) (+ £50)</option>
							<option value="47&quot; (119 cm) (+ £50)" data-pricechange="50">47" (119 cm) (+ £50)</option>
							<option value="48&quot; (122 cm) (+ £50)" data-pricechange="50">48" (122 cm) (+ £50)</option>
							<option value="49&quot; (124 cm) (+ £50)" data-pricechange="50">49" (124 cm) (+ £50)</option>
							<option value="50&quot; (127 cm) (+ £50)" data-pricechange="50">50" (127 cm) (+ £50)</option>
							<option value="51&quot; (129 cm) (+ £50)" data-pricechange="50">51" (129 cm) (+ £50)</option>
							<option value="52&quot; (132 cm) (+ £50)" data-pricechange="50">52" (132 cm) (+ £50)</option>
							<option value="53&quot; (134 cm) (+ £50)" data-pricechange="50">53" (134 cm) (+ £50)</option>
							<option value="54&quot; (137 cm) (+ £50)" data-pricechange="50">54" (137 cm) (+ £50)</option>
							<option value="55&quot; (139 cm) (+ £50)" data-pricechange="50">55" (139 cm) (+ £50)</option>
							<option value="56&quot; (142 cm) (+ £50)" data-pricechange="50">56" (142 cm) (+ £50)</option>
						</select>
					</div>
					<div class="col-md-6">
						<select name="options[Height]" class="select hidden hiddenHeightSize" tabindex="-1" required=""
								aria-required="true" style="">
							<option value="" data-pricechange="0">Height</option>
							<option value="5' 0&quot; (152 cm)" data-pricechange="0">5' 0" (152 cm)</option>
							<option value="5' 1&quot; (155 cm)" data-pricechange="0">5' 1" (155 cm)</option>
							<option value="5' 2&quot; (157 cm)" data-pricechange="0">5' 2" (157 cm)</option>
							<option value="5' 3&quot; (160 cm)" data-pricechange="0">5' 3" (160 cm)</option>
							<option value="5' 4&quot; (163 cm)" data-pricechange="0">5' 4" (163 cm)</option>
							<option value="5' 5 (165 cm)" data-pricechange="0">5' 5 (165 cm)</option>
							<option value="5' 6&quot; (168 cm)" data-pricechange="0">5' 6" (168 cm)</option>
							<option value="5' 7&quot; (170 cm)" data-pricechange="0">5' 7" (170 cm)</option>
							<option value="5' 8&quot; (173 cm)" data-pricechange="0">5' 8" (173 cm)</option>
							<option value="5' 9&quot; (175 cm)" data-pricechange="0">5' 9" (175 cm)</option>
							<option value="5' 10&quot; (178 cm)" data-pricechange="0">5' 10" (178 cm)</option>
							<option value="5' 11&quot; (180 cm)" data-pricechange="0">5' 11" (180 cm)</option>
							<option value="6' 0&quot; (183 cm)" data-pricechange="0">6' 0" (183 cm)</option>
							<option value="6' 1&quot; (185 cm)" data-pricechange="0">6' 1" (185 cm)</option>
							<option value="6' 2&quot; (188 cm)" data-pricechange="0">6' 2" (188 cm)</option>
							<option value="6' 3&quot; (191 cm)" data-pricechange="0">6' 3" (191 cm)</option>
							<option value="6' 4&quot; (193 cm)" data-pricechange="0">6' 4" (193 cm)</option>
							<option value="6' 5&quot; (196 cm)" data-pricechange="0">6' 5" (196 cm)</option>
							<option value="6' 6&quot; (198 cm)" data-pricechange="0">6' 6" (198 cm)</option>
							<option value="6' 7&quot; (199 cm)" data-pricechange="0">6' 7" (199 cm)</option>
							<option value="6' 8&quot; (200 cm)" data-pricechange="0">6' 8" (200 cm)</option>
						</select>
					</div>
					<div class="col-md-6">
						<select name="options[Kilt Length]" class="select hidden hiddenKiltLength" tabindex="-1" required=""
								aria-required="true" style="">
							<option value="" data-pricechange="0">Kilt Length</option>
							<option value="20&quot; (50 cm)" data-pricechange="0">20" (50 cm)</option>
							<option value="20.5&quot; (52 cm)" data-pricechange="0">20.5" (52 cm)</option>
							<option value="24.5&quot; (62 cm)" data-pricechange="0">24.5" (62 cm)</option>
							<option value="25&quot; (63 cm)" data-pricechange="0">25" (63 cm)</option>
							<option value="25.5&quot; (64 cm)" data-pricechange="0">25.5" (64 cm)</option>
							<option value="26&quot; (66 cm)" data-pricechange="0">26" (66 cm)</option>
							<option value="26.5&quot; (67 cm)" data-pricechange="0">26.5" (67 cm)</option>
							<option value="27&quot; (68 cm)" data-pricechange="0">27" (68 cm)</option>
							<option value="21&quot; (53 cm)" data-pricechange="0">21" (53 cm)</option>
							<option value="21.5&quot; (54 cm)" data-pricechange="0">21.5" (54 cm)</option>
							<option value="22&quot; (56 cm)" data-pricechange="0">22" (56 cm)</option>
							<option value="22.5&quot; (57 cm)" data-pricechange="0">22.5" (57 cm)</option>
							<option value="23&quot; (58 cm)" data-pricechange="0">23" (58 cm)</option>
							<option value="23.5&quot; (59 cm)" data-pricechange="0">23.5" (59 cm)</option>
							<option value="24&quot; (61 cm)" data-pricechange="0">24" (61 cm)</option>
						</select>
					</div>
					<div class="col-md-6">
						<ul class="menu_suboption optionTitle menu_options_parent">
							<li>SHIRT</li>
						</ul>
						<select name="options[Collar Size]" class="select hidden hiddenShirtSize" tabindex="-1" style="">
							<option value="" data-pricechange="0">Select collar size</option>
							<option value="15&quot;" data-pricechange="0">15"</option>
							<option value="15.5&quot;" data-pricechange="0">15.5"</option>
							<option value="16&quot;" data-pricechange="0">16"</option>
							<option value="16.5&quot;" data-pricechange="0">16.5"</option>
							<option value="17&quot;" data-pricechange="0">17"</option>
							<option value="17.5&quot;" data-pricechange="0">17.5"</option>
							<option value="18&quot;" data-pricechange="0">18"</option>
						</select>
					</div>
					<div class="col-12"></div>

					<div class="col-md-6">
						<ul class="menu_suboption optionTitle menu_options_parent">
							<li>JACKET</li>
						</ul>
						<select name="options[Chest size]" class="select hidden hiddenChestSize" required=""
								aria-required="true" tabindex="-1" style="">
							<option value="" data-pricechange="0">Select chest size</option>
							<?php
								for($j = 36; $j <= 52; $j++) {
									echo '<option value="' . $j . '&quot; Short" data-pricechange="0">' . $j . '" Short</option>';
									echo '<option value="' . $j . '&quot; Regular" data-pricechange="0">' . $j . '" Regular</option>';
									echo '<option value="' . $j . '&quot; Long" data-pricechange="0">' . $j . '" Long</option>';
									$j++;
								}
							?>
						</select>
					</div>
					<div class="col-12"></div>

					<div class="col-md-6">
						<ul class="menu_suboption optionTitle menu_options_parent">
							<li>SHOES</li>
						</ul>
						<select name="options[Shoe Size]" class="select hidden hiddenShoeSize" tabindex="-1" style="">

							<option value="" data-pricechange="0">Select a shoe size</option>
							<option value="6" data-pricechange="0">6</option>
							<option value="6.5" data-pricechange="0">6.5</option>
							<option value="7" data-pricechange="0">7</option>
							<option value="8" data-pricechange="0">8</option>
							<option value="8.5" data-pricechange="0">8.5</option>
							<option value="9" data-pricechange="0">9</option>
							<option value="9.5" data-pricechange="0">9.5</option>
							<option value="10" data-pricechange="0">10</option>
							<option value="10.5" data-pricechange="0">10.5</option>
							<option value="11" data-pricechange="0">11</option>
							<option value="12" data-pricechange="0">12</option>
							<option value="13" data-pricechange="0">13</option>
							<option value="14" data-pricechange="0">14</option>

						</select>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-12  ">
			<?php
				if($hireorbuy == "B"):?>
					<!--<div class="constant-options price">&pound;<span class="total-price"></span></div>-->
					<div class="constant-options price">
						Buy this outfit from &pound;<span class="total-price"></span>
					</div>
					Based on a 3-4 day hire (eg. collect Friday return Monday). Extra days charged at &pound;17 per day. Shirt and Hose are not included and can be purchased separately if required. Individual hired items also available.
					<div class="availabilityWarning">
						<?php
							if($tartanActive == "A6O9") {
								echo 'This tartan is also available as trews';
							}
							if($tartanActive == "SMS7") {
								// echo 'Please note: This tartan is available to book now & hire from August.';
							}
						?>
					</div>
					<a href="https://www.mccalls.co.uk/pages/outfits-enquiry-to-mccalls" target="_blank" class="sendEnquiry sendBuyEnquiry sendEnquiryOutfit">Send Buy Enquiry</a>
				<?php else:
					?>

					<div class="constant-options price">
						Hire this outfit from &pound;<span class="total-price"></span>
					</div>
					Based on a 3-4 day hire (eg. collect Friday return Monday). Extra days charged at &pound;17 per day. Shirt and Hose are not included and can be purchased separately if required. Individual hired items also available.
					<div class="availabilityWarning">
						<?php
							if($tartanActive == "A6O9") {
								echo 'This tartan is also available as trews';
							}
							if($tartanActive == "SMS7") {
								// echo 'Please note: This tartan is available to book now & hire from August.';
							}
						?>
					</div>
					<a href="https://www.mccalls.co.uk/pages/outfits-enquiry-to-mccalls" target="_blank" class="sendEnquiry sendEnquiryOutfit">Send Hire Enquiry</a>
				<?php
				endif;
			?>
			<br/>
			<a href="<?php echo $book_url ?>" target="_blank" class="sendEnquiry">
				Book An Appointment
			</a>

			<div class="col-12">
				<div class="d-block  d-md-none">
					<div class="mt-25 text-left customcodeWrapper">
						<strong>This outfit's code is:</strong>
						<br/>
						<span class="customcode"></span>
					</div>
					<div class="codeContainer">
						<input type="text" name="savecode" class="savecode2" placeholder="Got a code? Enter here">
						<button type="button" class="submitcode2">Load</button>
					</div>
				</div>
			</div>
			<div class="errorAlert d-inline-block"></div>
		</div>
	</div>
</div>