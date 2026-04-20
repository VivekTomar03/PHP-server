<?php

	namespace App\Models;

	use CodeIgniter\Model;
	use Config\CloudinaryConfig;
	use Cloudinary\Transformation\Crop;

	class TartanModel extends Model {


		function getList() {

			$q1 = $this->db->query("SELECT family_id, family_name, family_description, family_shortdescription FROM `family_names` ORDER BY `family_name` ASC");
			$names = array();

			if($q1->getNumRows() > 0) {
				foreach($q1->getResult() as $i => $row1) {
					$names[$i]['family_id'] = $row1->family_id;
					$names[$i]['family_name'] = $row1->family_name;
					$names[$i]['family_description'] = $row1->family_description;
					$names[$i]['family_shortdescription'] = $row1->family_shortdescription;
				}
			}

			return $names;
		}


		function getTartanList() {

			$q1 = $this->db->query("SELECT family_id, family_name FROM `family_names` ORDER BY `family_id` ASC");
			$names = array();

			if($q1->getNumRows() > 0) {
				$i = 0;

				foreach($q1->getResult() as $row1) {
					$names[$i]['family_id'] = $row1->family_id;
					$names[$i]['family_name'] = $row1->family_name;
					$names[$i]['family_tartans'] = $this->getTartans($row1->family_id);
					/*
						$names[$i]['tartan_varient']  = $row1->tartan_varient;
						$names[$i]['tartan_swatch']  = $row1->tartan_swatch;
					*/
					$i++;
				}
			}

			return $names;
		}


		function getName($nameId) {

			$familyClanArray = [];
			$clanParent = [];
			$relatedName = [];
			$sameAsName = [];
			$related_tartans = [];
			$clan_tartans = [];
			$sameAs_tartans = [];
			$seeName = [];
			$familyLocation = [];
			$mapPolydata = null;
			// GET THE BASIC NAME AND DESCRIPTION
			$name['family_isclan'] = 0;
			$q1 = $this->db->query("SELECT family_id,family_name,family_description,family_shortdescription,family_uri,isclan, related_id,sameas_id,location_id,see_id,parentclan_id
									FROM `family_names` 
									WHERE (`family_id` = '$nameId')"
			);

			if($q1->getNumRows() > 0) {
				$i = 0;
				foreach($q1->getResult() as $row) {
					$name['family_name'] = $row->family_name;
					$name['family_description'] = $row->family_description;
					$name['family_shortdescription'] = $row->family_shortdescription;
					$name['family_uri'] = $row->family_uri;
					$name['family_tartans'] = $this->getTartans($row->family_id);
					$name['related_name'] = null;
					$name['same_as_name'] = null;
					$name['associated_clans'] = null;
					$name['family_isclan'] = 0;
					$name['family_location'] = null;
					$name['family_maparea'] = null;
					$name['see_name'] = null;
					$clan_tartans = $this->getTartans($row->family_id);

					// CLAN DATA
					if($row->isclan == 1):
						$name['family_isclan'] = 1;
					elseif($row->parentclan_id):

						$parentClanArray = explode(',', $row->parentclan_id);
						foreach($parentClanArray as $clan):
							$familyClanArray[] = $this->getClanById($clan);
						endforeach;

					endif;


					// RELATED DATA
					if($row->related_id):
						$relatedIdArray = explode(',', $row->related_id);
						foreach($relatedIdArray as $relatedId):
							$relatedName[] = $this->getClanById($relatedId);
							$related_tartans = $this->getTartans($relatedId);
						endforeach;

					endif;

					// RELATED DATA
					if($row->sameas_id):
						$sameasIdArray = explode(',', $row->sameas_id);
						foreach($sameasIdArray as $sameasId):
							$sameAsName[] = $this->getClanById($sameasId);
							$sameAs_tartans = $this->getTartans($sameasId);
						endforeach;

					endif;

					// SEE DATA
					if($row->see_id):
						$seeIdArray = explode(',', $row->see_id);
						foreach($seeIdArray as $seeId):
							$seeName[] = $this->getClanById($seeId);
							//$seeName_tartans = 	$this->getTartans($seeId);
						endforeach;

					endif;

					// LOCATION DATA
					if(strlen($row->location_id) > 0):
						$familyLocation = array();
						$mapPolydata = null;
						$locationId = $row->location_id;
						$locationIdArray = explode(',', $row->location_id);

						foreach($locationIdArray as $locationId):
							$locationReturndata = $this->getLocationById($locationId);
							$familyLocation[] = $locationReturndata;

							if($locationReturndata[0]['loc_group']):
								$mapPolydata .= $locationReturndata[0]['loc_group'];
							endif;

						endforeach;
					endif;
				}
				$loop_tartans = array_merge($related_tartans, $sameAs_tartans);
			}

			//print_r($familyLocation);
			$name['family_location'] = $familyLocation;
			$name['related_name'] = $relatedName;
			$name['same_as_name'] = $sameAsName;
			$name['see_name'] = $seeName;
			$name['associated_clans'] = $familyClanArray;
			$name['family_tartans'] = $clan_tartans;

			$AreaArray = null;
			$polygonids = '';
			if(strlen($mapPolydata) > 0):
				$mapPolydata = trim($mapPolydata, ",");
				$AreaArray = explode(',', $mapPolydata);
				/*
								$polygonids = '[';
								$count = 0;
								foreach ($AreaArray as $cord):
									if ($count != 0){$polygonids .=",";}
									$polygonids .="'$cord'";
									$count++;
								endforeach;
								$polygonids .= ']';
				*/
			endif;
			$name['family_maparea'] = $AreaArray;

			if(isset($name['family_name'])):
				$description = $this->buildDesc($name);
				$name['short_description'] = $description;
			endif;


			return $name;

		}


		function getLocationById($locationId) {

			$familyLocation = array();
			$q2 = $this->db->query("SELECT location_name, locations_id, location_group FROM `family_locations` WHERE (`locations_id` = '$locationId')");

			if($q2->getNumRows() > 0) {
				$i = 0;

				foreach($q2->getResult() as $location) {
					$familyLocation[$i]['loc_name'] = $location->location_name;
					$familyLocation[$i]['loc_id'] = $location->locations_id;
					$familyLocation[$i]['loc_group'] = $location->location_group;
					$i++;
				}
			}
			return $familyLocation;
		}


		// This function returns the nicely formated short description text
		function buildDesc($name) {

			// Clans
			$clanAmounts = count($name['associated_clans']);
			$clanString = false;

			if($clanAmounts > 0):
				$clannames = '';
				if($clanAmounts == 1):
					$clannames .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['associated_clans'][0][0]['family_id'] . '">' . $name['associated_clans'][0][0]['family_name'] . '</a>';
					$clannames .= ' clan';
				else:
					$loopi = 0;

					foreach($name['associated_clans'] as $clanSingleName):

						if($loopi == $clanAmounts - 1):
							$clannames .= ' and   <a href="https://www.mccalls.co.uk/tartanexplorer#' . $clanSingleName[0]['family_id'] . '">' . $clanSingleName[0]['family_name'] . '</a> ';
						else:
							$clannames .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $clanSingleName[0]['family_id'] . '">' . $clanSingleName[0]['family_name'] . '</a> ';
							if($loopi != $clanAmounts - 2): $clannames .= ', '; endif;

						endif;
						$loopi++;
					endforeach;

					$clannames .= ' clans.';

				endif;

				$clanString = 'associated with the ' . $clannames;
			endif;


			// SAME AS
			$sameAsAmounts = count($name['same_as_name']);
			$sameasString = false;
			$samenames = '';
			if($sameAsAmounts > 0):

				$sameasString = '';
				if($sameAsAmounts == 1):
					//print_r($name['associated_clans'][0][0]);
					$sameasString .= ', ' . $name['same_as_name'][0][0]['family_name'];

				endif;
			endif;


			// RELATED
			$relatedAsAmounts = count($name['related_name']);
			$relatedString = false;
			$relatednames = '';
			if($relatedAsAmounts > 0):

				$relatedString = 'related to  ';
				if($relatedAsAmounts == 1):
					//print_r($name['associated_clans'][0][0]);
					$relatedString .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['related_name'][0][0]['family_id'] . '">' . $name['related_name'][0][0]['family_name'] . '</a>.';

				else:
					$loopi = 0;

					foreach($name['related_name'] as $relatedSingleName):

						if($loopi == $relatedAsAmounts - 1):
							$relatedString .= ' and  <a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['related_name'][0][0]['family_id'] . '">' . $relatedSingleName[0]['family_name'] . '</a> ';
						else:
							$relatedString .= $relatedSingleName[0]['family_name'];
							if($loopi != $relatedAsAmounts - 2): $relatednames .= ', '; endif;

						endif;
						$loopi++;
					endforeach;

					$relatedString .= '.';

				endif;


			endif;


			// RELATED


			$relatedAsAmounts = count($name['related_name']);
			$relatedString = false;
			$relatednames = '';
			if($relatedAsAmounts > 0):

				$relatedString = 'related to  ';
				if($relatedAsAmounts == 1):
					//print_r($name['associated_clans'][0][0]);
					$relatedString .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['related_name'][0][0]['family_id'] . '">' . $name['related_name'][0][0]['family_name'] . '</a>.';

				else:
					$loopi = 0;

					foreach($name['related_name'] as $relatedSingleName):

						if($loopi == $relatedAsAmounts - 1):
							$relatedString .= ' and  <a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['related_name'][0][0]['family_id'] . '">' . $relatedSingleName[0]['family_name'] . '</a> ';
						else:
							$relatedString .= $relatedSingleName[0]['family_name'];
							if($loopi != $relatedAsAmounts - 2): $relatednames .= ', '; endif;

						endif;
						$loopi++;
					endforeach;

					$relatedString .= '.';

				endif;


			endif;


			// SEE


			$seeAmounts = count($name['see_name']);
			$seeString = false;

			if($seeAmounts > 0):

				$seeString = 'also see  ';
				if($seeAmounts == 1):
					//print_r($name['associated_clans'][0][0]);
					$seeString .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['see_name'][0][0]['family_id'] . '">' . $name['see_name'][0][0]['family_name'] . '</a>.';

				else:
					$loopi = 0;

					foreach($name['see_name'] as $seeSingleName):

						if($loopi == $seeAmounts - 1):
							$seeString .= ' and  <a href="https://www.mccalls.co.uk/tartanexplorer#' . $name['see_name'][0][0]['family_id'] . '">' . $seeSingleName[0]['family_name'] . '</a> ';
						else:
							$seeString .= $seeSingleName[0]['family_name'];
							if($loopi != $seeAmounts - 2): $seeString .= ', '; endif;

						endif;
						$loopi++;
					endforeach;

					$seeString .= '.';

				endif;


			endif;


			// LOCATION

			$nameLocationAmount = count($name['family_location']);
			$locationString = false;
			$locationString = '';
			if($nameLocationAmount > 0):

				$locationString = ' from the ';
				if($nameLocationAmount == 1):
					//print_r($name['family_location']);
					$locationString .= $name['family_location'][0][0]['loc_name'] . ' area.';

				else:
					$loopi = 0;

					foreach($name['family_location'] as $locationSingleName):
						//echo $locationSingleName
						if($loopi == $nameLocationAmount - 1):
							$locationString .= ' and  ' . $locationSingleName[0]['loc_name'] . ' ';
						else:
							$locationString .= $locationSingleName[0]['loc_name'];
							if($loopi != $nameLocationAmount - 2): $locationString .= ', '; endif;

						endif;
						$loopi++;
					endforeach;

					$locationString .= ' areas.';

				endif;


			endif;


			//$sameAsAmounts;
			//is has the same origin as AIKEN


			//Name [1]
			//'<p>'+familyName+'  is '+relatedNames+' '+sameNames+' a family name associated with the '+clanword+' '+relatedClans+'.</p>'
			$returnstring = "<p>" . $name['family_name'] . $sameasString . "  &mdash; family name,  " . $clanString . " " . $locationString . " " . $seeString . "</p>";
			/*
						if ( $seeString && $sameasString && $clanString && $relatedString && $locationString):
					//	echo '1';
							$returnstring .= "<p>".$name['family_name'].$sameasString."  &mdash; family name,  ".$clanString.", from the ".$locationString." ".$seeString."</p>1";

						elseif($seeString && $sameasString && $clanString && $relatedString && !$locationString):
						//echo '2';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name  ".$clanString.".(2)</p>";

						elseif($seeString && $sameasString && $clanString && !$relatedString && $locationString):
					//	echo '3';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name,  ".$clanString.", from the ".$locationString." ".$seeString." (3)</p>";

						elseif($seeString && $sameasString && !$clanString && $relatedString && $locationString):
					//	echo '4';

						elseif($seeString && !$sameasString && $clanString && $relatedString && $locationString):
					//	echo '5';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,  ".$clanString.",  from the ".$locationString."  ".$seeString."(4)</p>";

						elseif(!$seeString && $sameasString && $clanString && $relatedString && $locationString):
					//	echo '5';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,  ".$clanString.",  from the ".$locationString."  (4)</p>";

						elseif($seeString && $sameasString && $clanString && !$relatedString && !$locationString):
					//	echo '6';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,  ".$clanString.".  ".$seeString." (5)</p>";

						elseif($seeString && $sameasString && !$clanString && $relatedString && !$locationString):
					//	echo '7';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name,  ".$relatedString."  ".$seeString." (6)</p>";

						elseif($seeString && !$sameasString && $clanString && $relatedString && !$locationString):
					//	echo '8';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,  ".$clanString." and ".$relatedString."  ".$seeString." (7)</p>";


						elseif(!$seeString && $sameasString && $clanString && $relatedString && !$locationString):
					//	echo '8';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,  ".$clanString." and ".$relatedString."   (7)</p>";



						elseif($seeString && $sameasString && !$clanString && !$relatedString && !$locationString):
					//	echo '9';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name,  ".$clanString."   ".$seeString."  ".$seeString." (8)</p>";

						elseif($seeString && !$sameasString && $clanString && !$relatedString && !$locationString):
					//	echo '10';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name,  ".$clanString."  ".$seeString." 9</p>";

						elseif(!$seeString && $sameasString && $clanString && !$relatedString && !$locationString):
					//	echo '11';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name,  ".$clanString." A name that originates from the ".$locationString."  ".$seeString."(9)</p>";

						elseif($seeString && $sameasString && !$clanString && !$relatedString && $locationString):
						//echo '12';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash; family name, from the ".$locationString."  ".$seeString." (10)</p>";

						elseif($seeString && !$sameasString && $clanString && !$relatedString && $locationString):
					//	echo '13';
							$returnstring .= "<p>".$name['family_name'].$sameasString."  &mdash; family name,  ".$clanString.",  from the ".$locationString."  ".$seeString." (11)</p>";

						elseif($seeString && !$sameasString && !$clanString && !$relatedString && $locationString):
					//	echo '14';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name, originates from the ".$locationString."  ".$seeString." (12)</p>";

						elseif( $seeString && !$sameasString && !$clanString && $relatedString && !$locationString):
					//	echo '14';
							$returnstring .= "<p>".$name['family_name'].$sameasString." &mdash;  family name,   ".$relatedString."  ".$seeString." (13)</p>";


						else:
					//	echo '15';
							$returnstring .= "<p>".$name['family_name'].$sameasString.". Currently no data to display about this listing.</p>";

						endif;
			*/


			return $returnstring;
		}


		function getTartan($tartanId) {

			$q1 = $this->db->query("SELECT tartan_id, tartan_parent, tartan_varient, tartan_uniquecode, tartan_swatch FROM `tartans` WHERE `tartan_id` = '$tartanId'");
			$name = array();

			if($q1->getNumRows() > 0) {
				$i = 0;

				$row1 = $q1->getRow();
				$q2 = $this->db->query("SELECT family_name FROM `family_names` WHERE `family_id` = '$row1->tartan_parent'");
				$row2 = $q2->getRow();
				$name['tartan_id'] = $row1->tartan_id;
				$name['tartan_parent_id'] = $row1->tartan_parent;
				$name['tartan_family_name'] = $row2->family_name;
				$name['tartan_varient'] = $row1->tartan_varient;

				$name['tartan_outfitcode'] = $this->getDefaultOutfit($row1->tartan_uniquecode, 'tartan');
				$name['tartan_uniquecode'] = $row1->tartan_uniquecode;
				$name['tartan_thumbnail'] = $this->getCloudinaryImages($row1->tartan_swatch, 'thumb');
				$name['tartan_swatch'] = $this->getCloudinaryImages($row1->tartan_swatch, 'swatch');
			}

			return $name;
		}

		function getTartanByCode($tartancode) {

			$q1 = $this->db->query("SELECT * FROM `tartans` WHERE `tartan_uniquecode` = '$tartancode'");
			$name = array();

			if($q1->getNumRows() > 0) {

				$i = 0;

				$row1 = $q1->getRow();
				$q2 = $this->db->query("SELECT * FROM `family_names` WHERE `family_id` = '$row1->tartan_parent'");
				$row2 = $q2->getRow();
				//	echo "SELECT * FROM `family_names` WHERE `family_id` = '".$row1->tartan_parent;
				$name['tartan_id'] = $row1->tartan_id;
				$name['tartan_parent_id'] = $row1->tartan_parent;
				$name['tartan_family_name'] = $row2->family_name;
				$name['tartan_varient'] = $row1->tartan_varient;

				$name['tartan_outfitcode'] = $this->getDefaultOutfit($row1->tartan_uniquecode, 'tartan');
				$name['tartan_uniquecode'] = $row1->tartan_uniquecode;
				$name['tartan_thumbnail'] = $this->getCloudinaryImages($row1->tartan_swatch, 'thumb');
				$name['tartan_swatch'] = $this->getCloudinaryImages($row1->tartan_swatch, 'swatch');
			}

			return $name;
		}


		/**
		 * @param $clanId
		 * @return array|array[]
		 */
		function getClanById($clanId) {
			$query = $this->db->query("SELECT `family_id`, `family_name`, `family_description`, `family_shortdescription`  FROM `family_names` WHERE `family_id` = '$clanId'");


			return $query->getResultArray();
		}

		/**
		 * @param $clanUri
		 * @return mixed
		 */
		function getClanByUri($clanUri) {
			$q1 = $this->db->query("SELECT * FROM `family_names` WHERE `family_uri` = '$clanUri'");
			$name = '';
			return $q1->result_array();
		}

		/**
		 * @param $parentId
		 * @return array
		 */
		function getTartans($parentId) {

			$q1 = $this->db->query("SELECT tartan_id, tartan_parent, tartan_varient, tartan_uniquecode, tartan_swatch FROM `tartans` WHERE `tartan_parent` = '$parentId'");
			$tartan = array();

			if($q1->getNumRows() > 0) {
				$i = 0;

				foreach($q1->getResult() as $row1) {

					$q2 = $this->db->query("SELECT family_name FROM `family_names` WHERE `family_id` = '$row1->tartan_parent'");
					$row2 = $q2->getRow();

					$tartan[$i]['tartan_family_name'] = $row2->family_name;
					$tartan[$i]['tartan_id'] = $row1->tartan_id;
					$tartan[$i]['tartan_parent'] = $row1->tartan_parent;
					$tartan[$i]['tartan_varient'] = $row1->tartan_varient;
					$tartan[$i]['tartan_uniquecode'] = $row1->tartan_uniquecode;
					$tartan[$i]['tartan_outfitcode'] = $this->getDefaultOutfit($row1->tartan_uniquecode, 'tartan');
					$tartan[$i]['tartan_thumbnail'] = $this->getCloudinaryImages($row1->tartan_swatch, 'thumb');
					$tartan[$i]['tartan_swatch'] = $this->getCloudinaryImages($row1->tartan_swatch, 'swatch');
					/*
							$name['tartan_thumbnail']  	= $tartan_thumbnail;
							$name['tartan_swatch']  = $swatch;
					*/

					$i++;
				}
			}
			return $tartan;

		}

		function getCloudinaryImages($tartanname, $size) {
			$image = false;
			$cloudinary = CloudinaryConfig::initialize();


			if($size == 'thumb'):
				//http://res.cloudinary.com/mccalls/image/upload/w_250,h_250,c_crop,q_70/v1/tartan/swatches/3-pride-gold.png
				/*
								$image = cloudinary_url('tartan/swatches/'.$tartanname.'.png',

									array("flags"=>array("png8"),"fetch_format"=>"png", "transformation"=>array(


									array("width"=>450, "height"=>450,   "crop"=>"crop"),
									array("quality"=>70)
										)
										)
									);
									*/
				$image = $cloudinary->image("tartan/swatches/$tartanname.png")
					->resize(Crop::crop()->width(450)->height(450))
					->toUrl();


				//$image = 'https://res.cloudinary.com/mccalls/image/upload/c_crop,h_450,w_450,fl_png8.strip_profile/v1000000/tartan/swatches/'.$tartanname.'.png';
			endif;


			if($size == 'swatch'):

				/*
								$image = cloudinary_url('tartan/swatches/'.$tartanname.'.png',
								array("flags"=>array("png8", "strip_profile")),
								array("fetch_format"=>"png", "transformation"=>array(

									 array("width"=>3500, "height"=>3500, "crop"=>"scale"),
									 array("quality"=>"auto:low")
								)
										)
									);
				*/ $image = $cloudinary->image("tartan/swatches/$tartanname.png")
				->resize(Crop::crop()->width(3500)->height(3500))
				->toUrl();
				//  $image =  cloudinary_url("tartan/swatches/$tartanname.png", array("height"=>3500, "width"=>3500, "crop"=>"crop"));
				//$image = 'https://res.cloudinary.com/mccalls/image/upload/c_crop,h_3500,w_3500,fl_png8.strip_profile/v1000000/tartan/swatches/'.$tartanname.'.png';
			endif;


			return $image;

		}


		function saveTartan($tartanId) {
			$newdata = array('tartanId' => $tartanId);
			$session = session();
			$session->set($newdata);

		}

		function unloadSavedTartan() {
			$newdata = array('tartanId' => '');
			$session = session();
			$session->remove('userdata');
			// $this->session->set_userdata($newdata);
			// $this->session->unset_userdata($newdata);
			return 'removed';
		}

		function getDefaultOutfit($code, $type) {
			$defaultcode = 'KA6O9SJ1HCZNRDJJALF1B';
			if($type == 'tartan'):
				$defaultcode = 'K' . $code . 'SJ1HCZNRDJJALF1B';
			endif;

			return $defaultcode;

		}


	}