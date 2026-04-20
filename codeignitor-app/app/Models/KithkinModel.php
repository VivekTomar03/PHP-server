<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class KithkinModel extends Model
{	
	
		
		
		
		public function saveDataLine($linedata){
			
			$namesIds = [];
			if (strlen($linedata['names'])):
			
			$namesData = explode(",",$linedata['names']);
		
			
				foreach ($namesData as $name):
	
				
					$name = str_replace(' ', '', $name);
					$isClan = false;
					if ($linedata['markasClan']):
						$isClan = true;
					endif;
					$namesIds[] = $this->getFamilyByName($name,$isClan);
					
					// OK HAVE NAME ID
					
					
				endforeach;
				
			endif;
		
			// PROCESS THE LOCATIONS
			$locationIds = [];
			if (strlen($linedata['locations'])):
			$locationData = explode(",",$linedata['locations']);
			//print_r($locationData);
				foreach ($locationData as $location):
					$location = str_replace(' ', '', $location);
					$locationIds[] = $this->getLocationByName($location);
				endforeach;
				
			
			endif;
			
			
			
			// PROCESS THE Parent Clans
			$clanIds = [];
			if (strlen($linedata['clan'])):
		
				$clanData = explode(",",$linedata['clan']);
				
				foreach ($clanData as $clan):
					$clanIds[] = $this->getFamilyByName($clan,true);
				endforeach;

			endif;
			
			
				// PROCESS THE FROM Septs
			$relatedIds = [];
			if (strlen($linedata['fromFamily'])):
		
				$relatedData = explode(",",$linedata['fromFamily']);
				
				foreach ($relatedData as $related):
					$relatedIds[] = $this->getFamilyByName($related,false);
				endforeach;

			endif;
			
			
				// PROCESS THE SAME AS
			$sameasIds = [];
			if (strlen($linedata['sameSept'])):
		
				$sameasData = explode(",",$linedata['sameSept']);
				
				foreach ($sameasData as $same):
					$sameasIds[] = $this->getFamilyByName($same,false);
				endforeach;

			endif;
			
			// PROCESS THE SEEs
			$seeIds = [];
			if (strlen($linedata['seeSept'])):
		
				$seeData = explode(",",$linedata['seeSept']);
				
				foreach ($seeData as $see):
					$seeIds[] = $this->getFamilyByName($see,false);
				endforeach;

			endif;
			
			
			// PROCESS THE alsoSept
			$alsoIds = [];
			if (strlen($linedata['alsoSept'])):
		
				$alsoData = explode(",",$linedata['alsoSept']);
				
				foreach ($alsoData as $also):
					$alsoIds[] = $this->getFamilyByName($also,false);
				endforeach;

			endif;
			
			
			
			//markasClan

	//	print_r($namesIds);		
	//	print_r($locationIds);
		//print_r($clanIds);
	//	print_r($relatedIds);
	//	print_r($sameasIds);
		//print_r($seeIds);
		//print_r($alsoIds);
			
		$sameasCombined = array_merge($namesIds,$sameasIds);
		foreach ($namesIds as $name):
			$relatedIDclone = $relatedIds;
			
			// Update name id with related info removing current array id;
			//unset($myArray['city']);
			
			
			if (count($relatedIDclone)):
				foreach (array_keys($relatedIDclone, $name, true) as $key):	
					unset($relatedIDclone[$key]);
				endforeach;
			endif;
			$sameasCombinedClone = $sameasCombined;
			if (count($sameasCombinedClone)):
				foreach (array_keys($sameasCombinedClone, $name, true) as $key):	
					unset($sameasCombinedClone[$key]);
				endforeach;
			endif;	
			
			$type = $linedata['type'];
			$clanIdsDB = implode(', ', $clanIds);
			$locationIdsDB = implode(', ', $locationIds);
			$relatedIdsDB = implode(', ', $relatedIDclone);
			$sameasIds = implode(', ', $sameasCombinedClone);
			
			$seeIdsDB = implode(', ', $seeIds);
			$alsoIdsDB = implode(', ', $alsoIds);
			
		//	print_r($sameasIds);
			 $query ="UPDATE `family_names` SET `parentclan_id` = '$clanIdsDB',`location_id` = '$locationIdsDB',`related_id` = '$relatedIdsDB' ,`sameas_id` = '$sameasIds',`see_id` = '$seeIdsDB',`also_id` = '$alsoIdsDB',`type` =  '$type' WHERE `family_names`.`family_id` = '$name';";
		$q1 = $this->db->query($query);
			
		endforeach;	
// 	UPDATE `family_names` SET `family_shortdescription` = '<p>With the ancient name Nechtan, borne by four Pictish kings, the MacNaughtons claim as progenitor a chief of one of the powerful Moray tribes transplanted by Malcolm IV\r\n</p>' WHERE `family_names`.`family_id` = 1;

			$names['responseMessage']="DB Updated";
			return $names;
		}
	
	
	
	
	
	
	// This will return the ID of the family name
	function getFamilyByName($name,$clan){
		$query = "SELECT * FROM `family_names` WHERE (family_name = '$name')";
		$q1 = $this->db->query($query);
		
		// Not found so create
		if($q1->num_rows() == 0):	
			if ($clan):
				$queryInsert = "INSERT INTO `family_names` (`family_name`,`isclan`) VALUES ('$name',$clan)";
			else:
				$queryInsert = "INSERT INTO `family_names` (`family_name`) VALUES ('$name')";
			endif;		 	
			
			$q2 = $this->db->query($queryInsert);
				
			$id = $this->db->insert_id();;
			
		elseif ($q1->num_rows() == 1):	
			$elementrow = $q1->row();
			$id = $elementrow->family_id;
		
		else:
		echo 'Eek multiple rows found - delete one'.$name;	
		endif;
		
		
		return $id;		
					
	}
	
	
	
	// This will return the ID of the location by name
	function getLocationByName($name){
		$id = false;
		if (strlen($name) > 1):
			$q1 = $this->db->query("SELECT * FROM `family_locations` WHERE (location_name ='$name')");
						
			// Not found so create
			if($q1->num_rows() == 0):	
				$queryInsert = "INSERT INTO `family_locations` (`location_name`) VALUES ('$name')";
				$q2 = $this->db->query($queryInsert);
							 
				$id = $this->db->insert_id();; 
				
			elseif ($q1->num_rows() == 1):	
				$elementrow = $q1->row();
				$id = $elementrow->locations_id;
						 
			endif;
		endif;
		return $id;		
					
	}
	
	
	
	


	
	
	
	
	}
	
	?>