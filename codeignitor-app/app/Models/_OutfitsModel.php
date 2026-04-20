<?php

	namespace App\Models;

	use CodeIgniter\Model;
	use Config\CloudinaryConfig;
	use Cloudinary\Transformation\Resize;
	use Cloudinary\Transformation\Gravity;
	use App\Models\TartansearchModel;

	class OutfitsModel extends Model {


		function getTartans($code, $hireorbuy) {
			// $db = \Config\Database::connect();
			// $this->load->model('model_tartansearch');
			$this->tartanSearch = new TartansearchModel();
			$hireorbuyfilter = '';

			// FIlter out the cat we dont want
			if($hireorbuy == 'buy'):
				$hireorbuyfilter = 'Hire';
			elseif($hireorbuy == 'hire'):
				$hireorbuyfilter = 'Buy';
			endif;

			if($code != 'all'):
				// 				$q1 = $this->db->query("SELECT * FROM `sporran-skins` WHERE (skin_code ='$code')");
			else:
				if($hireorbuy == 'buy'):
					$query = $this->db->query("SELECT * FROM `tartans` WHERE (`tartan_active` = 1 && `tartan_parent`=3)  AND ( `tartan_hirebuy` != 'Buy' ) ORDER BY `tartan_parent` ASC,`tartan_varient` ASC");
				else:
					$q1 = "SELECT * 
						   FROM `tartans` 
						   RIGHT JOIN `family_names`
						   ON tartans.tartan_parent = family_names.family_id
						   WHERE (`tartan_active` = 1)  AND ( `tartan_hirebuy` != 'Buy' ) 
						   ORDER BY `family_names`.`family_name` ASC, `tartan_varient` ASC";

					// Execute the query
					$query = $this->db->query($q1);
					//	$query = $db->query($q1);
					// $results = $query->getResult();
				endif;
			endif;

			$tartan = array();

			if($query->getNumRows() > 0) {
				$i = 0;

				foreach($query->getResult() as $row1) {
					$q2 = "SELECT * FROM `family_names` WHERE `family_id` = '$row1->tartan_parent'";
					$query2 = $this->db->query($q2);
					$row2 = $query2->getRow();
					// $q2 = $this->db->query("SELECT * FROM `family_names` WHERE `family_id` = '$row1->tartan_parent'");
					//   $row2 = $query2->getRow();

					$tartan[$i]['tartan_family_name'] = $row2->family_name;
					$tartan[$i]['tartan_supplier'] = $row1->tartan_supplier;
					$tartan[$i]['tartan_id'] = $row1->tartan_uniquecode;
					$tartan[$i]['tartan_swatch'] = $this->tartanSearch->getCloudinaryImages($row1->tartan_swatch, 'thumb');
					$familyname = 'test';
					$familyname = strtolower($row2->family_name);
					$familyname = str_replace(" fc", " FC", $familyname);
					if(strpos($familyname, 'mac') !== false) {
						$position = stripos($familyname, "mac");  // case insensitive
						$familyname[$position + 3] = strtoupper($familyname[$position + 3]);

					}

					if($familyname == 'general'):$familyname = ''; endif;
					$tartan[$i]['tartan_name'] = ucwords($familyname) . ' ' . $row1->tartan_varient;

					$i++;
				}
			}

			return $tartan;
		}


		function getProduct($chosenProduct, $hireorbuy) {
			$hireorbuyfilter = '';

			// FIlter out the cat we dont want
			if($hireorbuy == 'buy'):
				$hireorbuyfilter = 'hire';
			elseif($hireorbuy == 'hire'):
				$hireorbuyfilter = 'buy';
			endif;


			//echo $chosenProduct;
			$q1 = "SELECT * FROM  `outfit_elements` ,  `outfit_products_types` WHERE  (`outfit_products_types`.`product_type_id` =  `outfit_elements`.`product_type` && active = 1  && `outfit_elements`.`product_hirebuy` != '$hireorbuyfilter') AND  (`product_type_name` =  '$chosenProduct' ) ORDER BY `product_sortno`";
			$query = $this->db->query($q1);
			$pdata = false;

			if($query->getNumRows() > 0) {
				$i = 0;
				foreach($query->getResult() as $row) {
					$pdata[$i]['pid'] = $row->product_id;
					$pdata[$i]['pname'] = $row->product_name;
					$pdata[$i]['pref'] = $row->product_ref;
					$pdata[$i]['ptn'] = $this->getCloudinaryImages($chosenProduct, $row->product_image_large, 'tn');
					$pdata[$i]['pimage'] = $this->getCloudinaryImages($chosenProduct, $row->product_image_large, 'full');
					$pdata[$i]['pfolder'] = $row->product_type_imgfolder;
					$pdata[$i]['options'] = $row->product_option_group;
					$i++;
				}
			}

			return $pdata;
		}


		/**
		 * @param $elementType
		 * @param $elementCode
		 * @return false
		 */
		function getSingleProductElement($elementType, $elementCode) {

			// 	 $this->db->select('*');
			// 	 $this->db->from('outfit_elements , outfit_products_types');
			// 	 $this->db->where('active', 1);
			// 	 $this->db->where("(`outfit_products_types`.`product_type_id` =  `outfit_elements`.`product_type` )", NULL, FALSE);
			//
			// Create a query builder instance

			$builder = $this->db->table('outfit_elements');

			// Join with the second table
			$builder->join('outfit_products_types', 'outfit_products_types.product_type_id = outfit_elements.product_type');
			$builder->where('active', 1);

			// $builder = $db->table('outfit_elements, outfit_products_types');

			// // Select columns
			// $builder->select('*');
			//
			// // Define WHERE conditions
			// $builder->where('active', 1);
			// $builder->where('outfit_products_types.product_type_id = outfit_elements.product_type', NULL, FALSE);

			// Execute the query and get results


			if($elementType == 'Jackets'):
				$builder->where('product_type', 22);
			endif;

			if($elementType == 'Shirts'):
				$builder->where('product_type', 21);
			endif;

			if($elementType == 'Sporrans'):
				$builder->where("(`product_type`=12 OR `product_type`=13 OR `product_type`=14  )", null, false);
			endif;

			if($elementType == 'Shoes'):
				$builder->where('product_type', 28);
			endif;

			if($elementType == 'Neckwear'):
				$builder->where("(`product_type`=4 OR `product_type`=9 OR `product_type`=10 OR `product_type`=24   )", null, false);
			endif;

			if($elementType == 'Hose'):
				$builder->where("(`product_type`=15 OR `product_type`=17 OR `product_type`=18 OR `product_type`=19 OR `product_type`=20  )", null, false);

			endif;

			$builder->where('product_ref', $elementCode);
			$query = $builder->get();

			// echo $this->db->last_query();
			//$q1  = $this->db->get();
			//	$row =  $q1->getRow()
			//echo $chosenProduct;
			//$q1 = "SELECT * FROM  `outfit_elements` ,  `outfit_products_types` WHERE  (`outfit_products_types`.`product_type_id` =  `outfit_elements`.`product_type` && active = 1  && `outfit_elements`.`product_ref` = '$elementCode') AND  (`product_type_name` =  '$elementType' ) ORDER BY `product_sortno`";

			$pdata = false;

			if($query->getNumRows() > 0) {
				$i = 0;
				foreach($query->getResult() as $row) {
					$pdata[$i]['pid'] = $row->product_id;
					$pdata[$i]['pname'] = $row->product_name;
					$pdata[$i]['pref'] = $row->product_ref;
					$pdata[$i]['ptn'] = $this->getCloudinaryImages($elementType, $row->product_image_large, 'tn');
					$pdata[$i]['pimage'] = $this->getCloudinaryImages($elementType, $row->product_image_large, 'full');
					$pdata[$i]['pfolder'] = $row->product_type_imgfolder;
					$pdata[$i]['options'] = $row->product_option_group;
					$i++;
				}
			}

			return $pdata;
		}


		function getOutfit($outfitCode) {

			// Initialize Cloudinary
			$cloudinary = CloudinaryConfig::initialize();

			// KAAASAAHAANXXJAAR
			// KXXX SXX HXX NXX JXX - Buy or Rent
			$outfitElements = $this->getOutfitElements($outfitCode);
			$status = false;
			$image = '';
			$desc = null;
			$price = null;
			$upgradeCost = null;
			$descHtml = null;
			if($outfitElements['error'] == false):
				//print_r($outfitElements);
				///print_r($outfitElements);
				$imageKilt = $outfitElements['tartan']['tartan_swatch'];
				$imageSporran = $outfitElements['sporran']['swatch'];
				$imageShirt = $outfitElements['shirt']['swatch'];
				$imageNeckwear = $outfitElements['neckwear']['swatch'];
				$imageJacket = $outfitElements['jacket']['swatch'];
				$imageHose = $outfitElements['hose']['swatch'];
				$outfit = $outfitElements['tartan']['tartan_swatch'];
				$desc = $outfitElements['outfitDesc'];
				$descHtml = $outfitElements['outfitDescHtml'];
				$price = $outfitElements['outfitPrice'];
				$upgradeCost = $outfitElements['upgradeCost'];
				$imageShoe = $outfitElements['shoe']['swatch']; // 'shoe-black.png';
				// $imageKilt = 'kilt_SilverPride';
				// $imageSporran = 'sporran_3641';
				// $imageShirt = 'shirt-whitewing';
				// $imageNeckwear= 'test-neck';
				// $imageJacket= 'jacket_3861';

				$outfit = array();

				$image = $cloudinary->image('outfitdesigner/elements/base/mccallsCustomOutfit.jpg')
					->overlay("outfitdesigner/elements/hose/$imageHose")
					->overlay("outfitdesigner/elements/kilts/$imageKilt")
					->overlay("outfitdesigner/elements/sporrans/$imageSporran")
					->overlay("outfitdesigner/elements/shirts/$imageShirt")
					->overlay("outfitdesigner/elements/neckwear/$imageNeckwear")
					->overlay("outfitdesigner/elements/jackets/$imageJacket")
					->overlay("outfitdesigner/elements/shoes/$imageShoe")
					->resize(Resize::scale()->width(740))
					->toUrl();


				//  $image = "<img src='".cloudinary_url('outfitdesigner/elements/base/mccallsCustomOutfit.jpg',
				//
				//
				//  array("transformation"=>array(
				// 	 array("overlay"=>"outfitdesigner:elements:hose:$imageHose"),
				// 	 array("overlay"=>"outfitdesigner:elements:kilts:$imageKilt"),
				// 	 array("overlay"=>"outfitdesigner:elements:sporrans:$imageSporran"),
				// 	 array("overlay"=>"outfitdesigner:elements:shirts:$imageShirt"),
				// 	 array("overlay"=>"outfitdesigner:elements:neckwear:$imageNeckwear"),
				// 	 array("overlay"=>"outfitdesigner:elements:jackets:$imageJacket"),
				// 	 array("overlay"=>"outfitdesigner:elements:shoes:$imageShoe"),
				// 	 array("width"=>740, "height"=>1570, "crop"=>"scale"),
				// 	 array("quality"=>"auto:good")
				// 	 )
				// 	 )
				//  )."'>";

				$status = true;
			else:

			endif;

			$outfit['status'] = $status;
			$outfit['alert'] = '';
			$outfit['code'] = $outfitCode;
			$outfit['image'] = '<img src=' . $image . ' >';
			$outfit['desc'] = $desc;
			$outfit['descHtml'] = $descHtml;
			$outfit['price'] = $price;
			$outfit['upgradeCost'] = $upgradeCost;
			$outfit['elements'] = $outfitElements;

			return $outfit;
		}


		private function getOutfitElements($outfitCode) {
			//

			//echo $outfitCode.'<br/>';
			//http://martin.local/mccalls.co.uk/designers/outfits/get/KA6O9SK1HCDNN1J332L278B
			//KA6O9_SK1H_CD_NN_BJ_JEL278B
			$kiltcode = substr($outfitCode, 1, 4);
			$sporrancode = substr($outfitCode, 5, 3);
			$shirtcode = substr($outfitCode, 9, 2);
			$neckwearcode = substr($outfitCode, 12, 2);
			$shoecode = substr($outfitCode, 14, 1);
			$jacketcode = substr($outfitCode, 15, 2);
			$hosecode = substr($outfitCode, 18, 2);

			$hireorbuyCode = substr($outfitCode, 20, 1);

			$hireorbuy = 'hire';
			if($hireorbuyCode == 'B'):
				$hireorbuy = 'buy';
			endif;

			$extracost = 0;

			$error = false;
			$errorMessage = '';
			//$this->db = $this->load->database('tartan', TRUE);

			// Get Tartan Details
			$tartanElements = array();
			$q1 = $this->db->query("SELECT * FROM `tartans` WHERE (`tartan_uniquecode` = '$kiltcode')");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();
				$familyID = $q1Result->tartan_parent;
				$q2 = $this->db->query("SELECT * FROM `family_names` WHERE (`family_id` = '$familyID')");
				$familyName = '';
				if($q2->getNumRows() == 1) {
					$q2Result = $q2->getRow();
					$familyName = $q2Result->family_name;
				}
				if($familyName == 'general'):$familyName = ''; endif;
				$familyName = strtolower($familyName);
				$familyName = str_replace(" fc", " FC", $familyName);
				if(strpos($familyName, 'mac') !== false) {
					$position = stripos($familyName, "mac");  // case insensitive
					$familyName[$position + 3] = strtoupper($familyName[$position + 3]);

				}

				$tartanElements['tartan_uniquecode'] = $q1Result->tartan_uniquecode;
				$tartanElements['tartan_swatch'] = $q1Result->tartan_swatch;
				$tartanElements['tartan_name'] = ucwords($familyName) . '  ' . ucwords(strtolower($q1Result->tartan_varient));
				$tartanElements['tartan_supplier'] = $q1Result->tartan_supplier;
			} else {
				$error = true;
				$errorMessage .= '<p>No Tartan Found</p>';
			}

			// GET SPORRANS
			$sporranElements = array();
			$q1 = $this->db->query("SELECT * FROM `outfit_elements` WHERE (`product_ref` = '$sporrancode') AND ( `product_hirebuy` = 'both' || `product_hirebuy` = '$hireorbuy')");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();
				$sporranElements['desc'] = $q1Result->product_description;
				$sporranElements['swatch'] = $q1Result->product_image_large;
				$sporranElements['product_name'] = $q1Result->product_name;
				$sporranElements['optionGroup'] = $q1Result->product_option_group;
				if(is_numeric($sporranElements['optionGroup'])) {
					$extracost .= $sporranElements['optionGroup'];
				}
			} else {
				$error = true;
				$errorMessage .= '<p>No Sporran Found</p>';
			}

			// GET SHIRT
			$shirtElements = array();
			$q1 = $this->db->query("SELECT * FROM `outfit_elements` WHERE (`product_ref` = '$shirtcode' && `product_type` = '21' ) AND ( `product_hirebuy` = 'both' || `product_hirebuy` = '$hireorbuy')");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();

				$shirtElements['desc'] = $q1Result->product_description;
				$shirtElements['swatch'] = $q1Result->product_image_large;
				$shirtElements['product_name'] = $q1Result->product_name;
			} else {
				$error = true;
				$errorMessage .= '<p>No Shirt Found</p>';
			}


			// GET NECKWEAR
			$neckwearElements = array();
			$q1 = $this->db->query("SELECT * FROM `outfit_elements`, `outfit_products_types` WHERE ( `product_type` = '4' || `product_type` = '9'  || `product_type` = '10' || `product_type` = '24') AND (`product_ref` = '$neckwearcode' && `outfit_elements`.`product_type` = `outfit_products_types`.`product_type_id`)");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();

				$neckwearElements['desc'] = $q1Result->product_description;
				$neckwearElements['swatch'] = $q1Result->product_image_large;
				$neckwearElements['product_name'] = $q1Result->product_name . ' ' . $q1Result->product_type_name;
			} else {
				$error = true;
				$errorMessage .= '<p>No Neckwear Found</p>';
			}

			// GET Jacket
			$jacketElements = array();
			$q1 = $this->db->query("SELECT * FROM `outfit_elements` WHERE (`product_ref` = '$jacketcode' && `product_type` = '22')");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();
				$jacketElements['desc'] = $q1Result->product_description;
				$jacketElements['swatch'] = $q1Result->product_image_large;
				$jacketElements['optionGroup'] = $q1Result->product_option_group;
				$jacketElements['product_name'] = $q1Result->product_name;
			} else {
				$error = true;
				$errorMessage .= '<p>No Jacket Found</p>';
			}

			// GET Shoes
			$shoeElements = array();
			$q1 = $this->db->query("SELECT * FROM `outfit_elements` WHERE (`product_ref` = '$shoecode' && `product_type` = '28')");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();


				$shoeElements['desc'] = $q1Result->product_description;
				$shoeElements['swatch'] = $q1Result->product_image_large;
				$shoeElements['optionGroup'] = $q1Result->product_option_group;
				$shoeElements['product_name'] = $q1Result->product_name;
			} else {
				$error = true;
				$errorMessage .= '<p>No Jacket Found</p>';
			}

			// GET Hose
			$hoseElements = array();

			$q1 = $this->db->query("SELECT * FROM `outfit_elements` WHERE ( `product_type` = '15'  || `product_type` = '17'  || `product_type` = '18' || `product_type` = '19' || `product_type` = '20' ) AND `product_ref` = '$hosecode'");
			if($q1->getNumRows() == 1) {
				$q1Result = $q1->getRow();
				$hoseElements['desc'] = $q1Result->product_description;
				$hoseElements['swatch'] = $q1Result->product_image_large;
				$hoseElements['product_name'] = $q1Result->product_name;
				$hoseElements['optionGroup'] = $q1Result->product_option_group;
				if(is_numeric($hoseElements['optionGroup'])) {
					$extracost .= $hoseElements['optionGroup'];
				}
			} else {
				$error = true;
				$errorMessage .= '<p>No Hose Found</p>';
			}

			$returnData = array();

			// PULL TOGETHER DESCRIPTION & PRICE

			$returnData['outfitDesc'] = '';
			$price = 0;
			$upgradeCost = 0;

			if(!$error):
				$returnData['outfitDesc'] = '<h3>My current outfit is&hellip;</h3><ul><li>Kilt: ' . $tartanElements['tartan_name'] . '</li><li>Sporran: ' . $sporranElements['product_name'] . '</li><li>Hose: ' . $hoseElements['product_name'] . '</li><li>Shirt: ' . $shirtElements['product_name'] . '</li><li>Neckwear: ' . $neckwearElements['product_name'] . '</li><li>Jacket: ' . $jacketElements['product_name'] . '</li></ul>';
				$returnData['outfitDescHtml'] = '
					 <div class="outfit-element outfit-kilt">' . $tartanElements['tartan_name'] . ' Kilt</div>
					 <div class="outfit-element outfit-flashes">Matching Tartan Flashes</div>
					 <div class="outfit-element outfit-sporran">' . $sporranElements['product_name'] . ' Sporran</div>
					 <div class="outfit-element outfit-hose">' . $hoseElements['product_name'] . ' Hose</div>
					 <div class="outfit-element outfit-shirt">' . $shirtElements['product_name'] . ' Shirt</div>
					 <div class="outfit-element outfit-neckwear">' . $neckwearElements['product_name'] . '</div>
					 <div class="outfit-element outfit-jacket">' . $jacketElements['product_name'] . ' Jacket</div>
					 <div class="outfit-element outfit-shoes">' . $shoeElements['product_name'] . '</div>';

				// COSTS
				//Purchase
				$kilt = 449; // Medium weight Lochcarron
				$jacketcost = 200; // Medium weight Lochcarron

				//KILTS

				switch($tartanElements['tartan_supplier']):
					case "mccalls":
						$kiltupgrade = 3;
						break;
					case "premium":
						$kiltupgrade = 2;
						break;
					default:
						$kiltupgrade = 0;
				endswitch;


				switch($jacketElements['optionGroup']):
					case "premiumv1":
						$jacketupgrade = 1;
						break;
					case "premiumv2":
						$jacketupgrade = 2;
						break;
					case "premiumv3":
						$jacketupgrade = 3;
						break;
					case "premiumv4":
						$jacketupgrade = 4;
						break;
					case "premiumv5":
						$jacketupgrade = 5;
						break;
					default:
						$jacketupgrade = 0;
				endswitch;

				$purchaseCost = 1449;
				$hireCost = 99;
				$buyPrice = $purchaseCost;
				$hirePrice = $hireCost;

				if($kiltupgrade == 0):
					if($jacketupgrade == 1):
						$buyPrice = $buyPrice;
						$hirePrice = 110;
					endif;
					if($jacketupgrade == 2):
						$buyPrice = $buyPrice + 100;
						$hirePrice = 125;
					endif;
					if($jacketupgrade == 3):
						$buyPrice = $buyPrice + 20; // dont think there is a product assigned this
						$hirePrice = 125;
					endif;
					if($jacketupgrade == 4 || $jacketupgrade == 5):
						$buyPrice = $buyPrice + 125;
						$hirePrice = 125;
					endif;
				endif;


				/*
					if ($kiltupgrade == 1):
						if ($jacketupgrade == 0):
							$buyPrice = $buyPrice + 55;
							$hirePrice = 80;
						endif;

						 if ($jacketupgrade == 1):
							$buyPrice = $buyPrice + 100;
							$hirePrice = 95;
						endif;
						if ($jacketupgrade == 2):
							$buyPrice = $buyPrice + 100;
							$hirePrice = 95;
						endif;
						if ($jacketupgrade == 3):
							$buyPrice = 1039;
							$hirePrice = 100;
						endif;
						if ($jacketupgrade == 4 || $jacketupgrade == 5):
							$buyPrice = $buyPrice + 110;
							$hirePrice = 105;
						endif;
					endif;
				*/


				if($kiltupgrade == 2):

					if($jacketupgrade == 0):
						$buyPrice = $buyPrice + 55;
						$hirePrice = 110;
					endif;

					if($jacketupgrade == 1):
						$buyPrice = $buyPrice + 100;
						$hirePrice = 145;
					endif;
					if($jacketupgrade == 2):
						$buyPrice = $buyPrice + 100;
						$hirePrice = 145;
					endif;
					if($jacketupgrade == 3):
						$buyPrice = $buyPrice + 20;
						$hirePrice = 145;
					endif;
					if($jacketupgrade == 4 || $jacketupgrade == 5):
						$buyPrice = $buyPrice + 110;
						$hirePrice = 145;
					endif;
				endif;

				// Pride Tartan
				if($kiltupgrade == 3):
					$buyPrice = 1449;
					if($jacketupgrade == 0):
						$buyPrice = 1449;
						$hirePrice = 125;
					endif;

					if($jacketupgrade == 1):
						$buyPrice = $buyPrice + 20;
						$hirePrice = 140;
					endif;
					if($jacketupgrade == 2):
						$buyPrice = $buyPrice + 45;
						$hirePrice = 155;
					endif;
					if($jacketupgrade == 3):
						$buyPrice = $buyPrice + 50;
						$hirePrice = 155;
					endif;
					if($jacketupgrade == 4 || $jacketupgrade == 5):
						$buyPrice = $buyPrice + 100;
						$hirePrice = 155;
					endif;
				endif;

				$price = $buyPrice + $extracost;
				$upgradeCost = $buyPrice - $purchaseCost;
				if($hireorbuy == 'hire'):
					$price = $hirePrice;
					$upgradeCost = $hirePrice - $hireCost;
				endif;

			else:
				$tartanElements = '';
				$sporranElements = '';
				$shirtElements = '';
				$neckwearElements = '';
				$jacketElements = '';
				$hoseElements = '';
				$hireorbuy = '';
			endif;


			// Add on extras
			$returnData['outfitPrice'] = $price;
			$returnData['upgradeCost'] = $upgradeCost;

			$returnData['error'] = $error;
			$returnData['message'] = $errorMessage;
			$returnData['tartan'] = $tartanElements;
			$returnData['sporran'] = $sporranElements;
			$returnData['shirt'] = $shirtElements;
			$returnData['neckwear'] = $neckwearElements;
			$returnData['jacket'] = $jacketElements;
			$returnData['hose'] = $hoseElements;
			$returnData['shoe'] = $shoeElements;
			$returnData['outfittype'] = $hireorbuy;
			return $returnData;
		}


		function getCloudinaryImages($chosenProduct, $filename, $size) {
			$cloudinary = CloudinaryConfig::initialize();

			$image = false;

			$filename = str_replace('.png', '', $filename);

			if($size == 'tn'):$size = '_tn';
			else:$size = '';endif;


			if($chosenProduct == 'Sporrans Antique' || $chosenProduct == 'Sporrans Chrome' || $chosenProduct == 'Sporrans Copper' || $chosenProduct == 'Sporrans Gold' || $chosenProduct == 'Sporrans Day' || $chosenProduct == 'Sporrans Pewter' || $chosenProduct == 'Sporrans'):
				$image = $cloudinary->image('outfitdesigner/elements/sporrans/' . $filename . $size)->toUrl();


			endif;

			if($chosenProduct == 'Shirts'):
				$image = $cloudinary->image('outfitdesigner/elements/shirts/' . $filename . $size)->toUrl();
			endif;
			if($chosenProduct == 'Cravat' || $chosenProduct == 'Silk Tie' || $chosenProduct == 'Bow Tie' || $chosenProduct == 'Wool Tie' || $chosenProduct == 'Neckwear'):
				$image = $cloudinary->image('outfitdesigner/elements/neckwear/' . $filename . $size)->toUrl();
			endif;

			if($chosenProduct == 'Jackets'):
				$image = $cloudinary->image('outfitdesigner/elements/jackets/' . $filename . $size)->toUrl();
			endif;

			if($chosenProduct == 'Shoes'):
				$image = $cloudinary->image('outfitdesigner/elements/shoes/' . $filename . $size)->toUrl();
			endif;

			if($chosenProduct == 'Hose Tartan' || $chosenProduct == 'Hose Colour' || $chosenProduct == 'Hose Charcoal' || $chosenProduct == 'Hose Ecru' || $chosenProduct == 'Hose Black' || $chosenProduct == 'Hose'):
				$image = $cloudinary->image('outfitdesigner/elements/hose/' . $filename . $size)->toUrl();


			endif;


			return $image;

		}


		// This adds the unique codes to the category
		function setUniqueCodes() {
			//echo $this->generateRandomString(4,'tartan');

			// CHECK TARTANS
			echo '<strong>Checking Unique Tartan Codes</strong> ';
			//$this->db = $this->load->database('tartan', TRUE);
			$null = null;
			$q1 = $this->db->query("SELECT * FROM `tartans` WHERE (`tartan_uniquecode` IS NULL)");
			if($q1->getNumRows() > 0) {
				$i = 0;

				foreach($q1->result() as $row) {
					$rowID = $row->tartan_id;
					$loopstop = false;
					$i++;

					while($loopstop != true) {
						$code = $this->generateRandomString(4);
						$qcodehunt = $this->db->query("SELECT * FROM `tartans` WHERE (`tartan_uniquecode` = '$code')");
						if($qcodehunt->getNumRows() == 0) {
							$q2 = $this->db->query("UPDATE `tartans` SET `tartan_uniquecode` = '$code' WHERE (`tartan_id` = '$rowID')");
							$loopstop = true;
						}
					}

					$i++;
				}
				echo $i . ' new codes have been generated.</p>';
			} else {
				echo 'No codes have been generated - all tartans have codes.</p>';
			}

		}


		function generateRandomString($length = 10) {
			$characters = '23456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}


	}