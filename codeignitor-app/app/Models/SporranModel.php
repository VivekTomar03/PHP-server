<?php  
	
	namespace App\Models;
	
	use CodeIgniter\Model;
	use Config\CloudinaryConfig;
	use Cloudinary\Api\Admin\AdminApi;
	use Cloudinary\Api\Exception\ApiError;

	class SporranModel extends Model {
	
	
		
		
		
		function getSkin($code){
			if ($code != 'all'):
			$q1 = $this->db->query("SELECT * FROM `sporran-skins` WHERE (skin_code ='$code') ");
			else:
				$q1 = $this->db->query("SELECT * FROM `sporran-skins` WHERE (`skin_active` = 1) ORDER BY `skin_order` ASC");
			endif;
			
			$skin = array();
	
			if($q1->getNumRows()> 0) 
			{	
				$i=0;
			
				foreach($q1->getResult() as $row1) 
				{	
					$skin[$i]['skin_id']  = $row1->skin_id;
					$skin[$i]['skin_code']  = $row1->skin_code;
					$skin[$i]['skin_desc']  = $row1->skin_desc;
					$skin[$i]['skin_price']  = $row1->skin_price;
					$skin[$i]['skin_th']  = $row1->skin_th;
					$skin[$i]['skin_img1']  = $row1->skin_img1;
					$skin[$i]['skin_img2']  = $row1->skin_img2;
					$skin[$i]['skin_img3']  = $row1->skin_img3;
					$skin[$i]['skin_img4']  = $row1->skin_img4;
					$skin[$i]['skin_img5']  = $row1->skin_img5;
					$skin[$i]['skin_active']  = $row1->skin_active;
					$skin[$i]['skin_order']  = $row1->skin_order;
					$skin[$i]['skin_tassle3_img1']  = $row1->skin_tassle3_img1;
					$skin[$i]['skin_tassle3_img2']  = $row1->skin_tassle3_img2;
					$skin[$i]['skin_tassle3_img3']  = $row1->skin_tassle3_img3;
					$skin[$i]['skin_tassle3_img4']  = $row1->skin_tassle3_img4;
					$skin[$i]['skin_tassle3_img5']  = $row1->skin_tassle3_img5;
					$skin[$i]['skin_tassle5_img1']  = $row1->skin_tassle5_img1;
					$skin[$i]['skin_tassle5_img2']  = $row1->skin_tassle5_img2;
					$skin[$i]['skin_tassle5_img3']  = $row1->skin_tassle5_img3;
					$skin[$i]['skin_tassle5_img4']  = $row1->skin_tassle5_img4;
					$skin[$i]['skin_tassle5_img5']  = $row1->skin_tassle5_img5;
					$i++;	
				}
			}
			
			return $skin;
		}
	
	
		function getCantle($code){
			if ($code != 'all'):
			$q1 = $this->db->query("SELECT * FROM `sporran-cantle` WHERE (cantle_code ='$code' ) ");
			else:
			$q1 = $this->db->query("SELECT * FROM `sporran-cantle`  WHERE (cantle_active ='1') ORDER BY `cantle_order` ASC");
			endif;
			
			$cantle = array();
			
			if($q1->getNumRows()> 0) 
			{
				$i=0;
			
				foreach($q1->getResult() as $row1) 
				{	
					$cantle[$i]['cantle_id'] 		= $row1->cantle_id;
					$cantle[$i]['cantle_order'] 	= $row1->cantle_order;
					$cantle[$i]['cantle_finish']  	= $row1->cantle_finish;
					$cantle[$i]['cantle_th'] 		= $row1->cantle_th;
					$cantle[$i]['cantle_image1']  	= $row1->cantle_image1;
					$cantle[$i]['cantle_image2']  	= $row1->cantle_image2;
					$cantle[$i]['cantle_image3']  	= $row1->cantle_image3;
					$cantle[$i]['cantle_image4']  	= $row1->cantle_image4;
					$cantle[$i]['cantle_image5']  	= $row1->cantle_image5;
					$cantle[$i]['cantle_code']  	= $row1->cantle_code;
					$cantle[$i]['cantle_desc']  	= $row1->cantle_desc;
					$cantle[$i]['cantle_price']  	= $row1->cantle_price;
					$cantle[$i]['cantle_active']  	= $row1->cantle_active;
					$cantle[$i]['cantle_shape']  	= $row1->cantle_shape;
					$cantle[$i]['cantle_pride']  	= $row1->cantle_pride;
					$cantle[$i]['cantle_leather_mandatory'] = $row1->cantle_leathermandatory;
				
					$i++;	
				}
			}

			return $cantle;
		}
		
		
		function getTassle($code){
			if ($code != 'all'):
			$q1 = $this->db->query("SELECT * FROM `sporran-tassle-finish` WHERE (finish_code ='$code') ");
			else:
			$q1 = $this->db->query("SELECT * FROM `sporran-tassle-finish` ORDER BY `finish_id` ASC");
			endif;
			
			$tassle = array();
			
			if($q1->getNumRows()> 0) 
			{
				$i=0;
			
				foreach($q1->getResult() as $row1) 
				{	
					$tassle[$i]['finish_id'] 		= $row1->finish_id;
					$tassle[$i]['finish_group'] 	= $row1->finish_group;
					$tassle[$i]['finish_details']  	= $row1->finish_details;
					$tassle[$i]['finish_shape'] 	= $row1->finish_shape;
					$tassle[$i]['finish_design']  	= $row1->finish_design;
					$tassle[$i]['finish_number']  	= $row1->finish_number;
					$tassle[$i]['finish_img1']  	= $row1->finish_img1;
					$tassle[$i]['finish_img2']  	= $row1->finish_img2;
					$tassle[$i]['finish_img3']  	= $row1->finish_img3;
					$tassle[$i]['finish_img4']  	= $row1->finish_img4;
					$tassle[$i]['finish_img5']  	= $row1->finish_img5;
					$tassle[$i]['finish_code']  	= $row1->finish_code;
					$tassle[$i]['finish_price']  	= $row1->finish_price;
					$i++;	
				}
			}

			return $tassle;
		}
	
	
		function getLeather($cantleShape,$leatherTypeCode,$leatherColourCode,$cantleleathermandatory){
			//echo $cantleShape,$leatherTypeCode,$leatherColourCode;
		
			$q1 = $this->db->query("SELECT * FROM `sporran-cantle-leather` WHERE (`leather_shape` ='$cantleShape' && `leather_colour` = '$leatherColourCode'  && `leather_material` = '$leatherTypeCode') ");
			$cantleLeather = array();
			$i=0;
			if($q1->getNumRows()> 0):
			
				
			
				foreach($q1->getResult() as $row1) 
				{	
					$cantleLeather[$i]['leather_id'] 		= $row1->leather_id;
					$cantleLeather[$i]['leather_image_3'] 	= $row1->leather_image_3;
					$cantleLeather[$i]['leather_price']  	= $row1->leather_price;
				}
				
			else:
			
				if($cantleleathermandatory == 1):
					// Requery for black...
				
					$q2 = $this->db->query("SELECT * FROM `sporran-cantle-leather` WHERE (`leather_shape` ='$cantleShape' && `leather_colour` = 'A'  && `leather_material` = 'A') ");
					foreach($q2->getResult() as $row2): 
						$cantleLeather[$i]['leather_id'] 		= $row2->leather_id;
						$cantleLeather[$i]['leather_image_3'] 	= $row2->leather_image_3;
						$cantleLeather[$i]['leather_price']  	= $row2->leather_price;
					endforeach;
				
				else:
					$cantleLeather[0]['leather_id'] 		= 0;
					$cantleLeather[0]['leather_image_3'] 	= 'cantle-leathers/blank.png';
					$cantleLeather[0]['leather_price']  	= 0;
				endif;	
		
		
				
			endif;
//print_r($cantleLeather);
			return $cantleLeather;
			
		}
		
		function getLeatherColours($code){
			if ($code != 'all'):
			$q1 = $this->db->query("SELECT * FROM `sporran-leather-colour` WHERE (colour_code ='$code') ");
			else:
			$q1 = $this->db->query("SELECT * FROM `sporran-leather-colour` ORDER BY `colour_order` ASC");
			endif;
			
			$cantleColour = array();
			
			if($q1->getNumRows()> 0) 
			{
				$i=0;
			
				foreach($q1->getResult() as $row1) 
				{	
					$cantleColour[$i]['colour_id'] 			= $row1->colour_id;
					$cantleColour[$i]['colour_name'] 		= $row1->colour_name;
					$cantleColour[$i]['colour_code']  		= $row1->colour_code;
					$cantleColour[$i]['colour_imageshort']  = $row1->colour_imageshort;
					$cantleColour[$i]['colour_order']  		= $row1->colour_imageshort;
					$i++;
				}
			}
			
			return $cantleColour;

		}	
		
		
		
		function getLeatherTypes(){
			$cantleLeather = array();
			
			$cantleLeather[0]['type_code'] 			= '0';
			$cantleLeather[0]['colour_name'] 		= 'none';
			$cantleLeather[1]['type_code'] 			= 'A';
			$cantleLeather[1]['colour_name'] 		= 'Leather';		
			$cantleLeather[2]['type_code'] 			= 'B';
			$cantleLeather[2]['colour_name'] 		= 'Synthetic Leather';		
			$cantleLeather[3]['type_code'] 			= 'C';
			$cantleLeather[3]['colour_name'] 		= 'Suede';
			
			return $cantleLeather;
		}
		
		
		function getSporran($code){
			// example code S25C01L10T15A;
			
			$sporran['status'] = true;
			$sporran['alert'] = '';
			$sporran['code'] = $code;
			
			$skincode = substr($code,0, 3); 
			$cantlecode = substr($code,3, 3); 
			$leatherTypeCode = substr($code,7, 1);
			$leatherColourCode = substr($code,8, 1);
			$tasslecode = substr($code,9, 4); 
			$tassleAmount = substr($code,10, 1); 
			$liningCode = substr($code,13, 1); 

			
			// SKINS
		 
			// Check if skin exists
			if ($this->getSkin($skincode) != ''):
				
				$sporran['skin'] = $this->getSkin($skincode);
				$skinImage  = $sporran['skin'][0]['skin_img3'];
				//print_r($sporran['skin']);
				if ($tassleAmount == 5):
					$skinTassleImage  =  $sporran['skin'][0]['skin_tassle5_img3'];
				else:	
					$skinTassleImage  =  $sporran['skin'][0]['skin_tassle3_img3']; 
				endif;
				
			else:
				$sporran['skin'] = '';
				$sporran['status'] = false;
				$sporran['alert'] .= '<p>No skin found</p>';
			endif;
			
			
			
			// Cantle
			// Get leather colour
			if ($this->getLeatherColours($leatherColourCode) != ''):
				$sporran['cantlecolour'] = $this->getLeatherColours($leatherColourCode);
				$leatherColourCode = $sporran['cantlecolour'][0]['colour_code'];
			else:
				$leatherColourCode = '';
				$sporran['status'] = false;
				$sporran['alert'] .= '<p>No cantle colour found</p>';

			endif;
			
			// Search for cantle leather type
			$leatherArray = $this->getLeatherTypes();
			foreach($leatherArray as $leatherType):
				if ($leatherType['type_code'] == $leatherTypeCode):
					$sporran['cantleleathermaterial'] = $leatherType['colour_name'];
				endif;
			endforeach;
		
			
			if ($this->getCantle($cantlecode) != ''):
				$sporran['cantle'] = $this->getCantle($cantlecode);
				$cantleImage = $sporran['cantle'][0]['cantle_image3'];
				$cantleShape = $sporran['cantle'][0]['cantle_shape'];
				$cantleleathermandatory  = $sporran['cantle'][0]['cantle_leather_mandatory'];
				//$sporran['cantlecolourcode'] = $leatherColourCode;
				$sporran['cantleleathertypecode'] = $leatherTypeCode;
				$sporran['cantleleather'] = $this->getLeather($cantleShape,$leatherTypeCode,$leatherColourCode,$cantleleathermandatory);
				$leatherImage = $sporran['cantleleather'][0]['leather_image_3'];
			else:
				$sporran['cantle'] = '';
				$sporran['status'] = false;
				$sporran['alert'] .= '<p>No cantle found</p>';
			endif;
			
			
			
			// Tassle
			if ($this->getTassle($tasslecode) != ''):
				$sporran['tassle'] = $this->getTassle($tasslecode);
				$tassleImage = $sporran['tassle'][0]['finish_img3'];
				if ($sporran['tassle'][0]['finish_design'] == 'S'):$tassleShape = 'straight'; else: $tassleShape = 'crossed'; endif;
			else:
				$sporran['tassle'] = '';
				$sporran['status'] = false;
				$sporran['alert'] .= '<p>No tassle found</p>';
			endif;
			
			
			// Get Lining colour
			if ($this->getLeatherColours($liningCode) != ''):
				$sporran['liningcolour'] = $this->getLeatherColours($liningCode);
				$leatherLiningColour = $sporran['liningcolour'][0]['colour_name'];
			else:
				$leatherColourCode = '';
				$sporran['status'] = false;
				$sporran['alert'] .= '<p>No cantle colour found</p>';

			endif;
			
			
			
			if ($sporran['status'] == true):
			 
				$sporran['price'] = 200 + $sporran['skin'][0]['skin_price'] + $sporran['cantle'][0]['cantle_price'] +$sporran['tassle'][0]['finish_price'];
				$sporran['image'] = $this->createSporranImage($code,$skinImage,$skinTassleImage,$cantleImage,$leatherImage,$tassleImage);
				echo $sporran['cantleleathermaterial'];
				
				if ($sporran['cantleleathermaterial'] != 'none'): 
					$cantleLeatherInfo = 'with <strong>'. strtolower($sporran['cantlecolour'][0]['colour_name']).' '.strtolower($sporran['cantleleathermaterial']).'</strong> finish and'; 
				else: 
					$cantleLeatherInfo=' and '; 
				endif;
				
				$sporran['info'] = '<strong>'.$sporran['skin'][0]['skin_desc'].'</strong> with a <strong>'.$sporran['cantle'][0]['cantle_desc'].'</strong> '.$cantleLeatherInfo.' <strong>'.$sporran['tassle'][0]['finish_number'].'  '.$tassleShape.' chains.</strong> Tassles in matching skin and '. strtolower($sporran['tassle'][0]['finish_shape']).' tassle tops.  Sporran is <strong>'. strtolower($leatherLiningColour).'</strong> suede lined with a credit card slip.';
				$sporran['infotext'] = $sporran['skin'][0]['skin_desc'].' with a '.$sporran['cantle'][0]['cantle_desc'].' '.$cantleLeatherInfo.' '.$sporran['tassle'][0]['finish_number'].'  '.$tassleShape.' chains. Tassles in matching skin and '. strtolower($sporran['tassle'][0]['finish_shape']).' tassle tops. Sporran is '. strtolower($leatherLiningColour).' suede lined with a credit card slip.';
					
			
			else:
				// Save Error code for debugging
			endif;
			
			return $sporran;
		}
		
		
		
		
		function createSporranImage($code,$skinImage,$skinTassleImage,$cantleImage,$leatherImage,$tassleImage){
		//$baseurl = base_url();
		$cloudinary = CloudinaryConfig::initialize();
		$baseurl = 'https://mccalls.bndry.co.uk/apps2/';
		
		  $s3 = $baseurl.'assets/img/sporrandesigner/elements/'.$skinImage;
		$st3 = $baseurl.'assets/img/sporrandesigner/elements/'.$skinTassleImage;
		$t3 = $baseurl.'assets/img/sporrandesigner/elements/'.$tassleImage;
		$l3 = $baseurl.'assets/img/sporrandesigner/elements/'.$leatherImage;
		$c3 = $baseurl.'assets/img/sporrandesigner/elements/'.$cantleImage;
		$response='';
		//$baseurl.'assets/img/$s3,$st3,$c3,$l3,$t3
		$background3 = $baseurl.'assets/img/sporrandesigner/elements/previewbackground-1200x1360.png';
	
		ini_set('memory_limit', '500M');		
		$x = 1200;
		$y = 1360;	
	
		//echo $code;
		 // CHECK TOP SEE IF THERE IS A IMAGE ALREADY CREATED
		

		 $statusCode = $this->_validate($baseurl.'assets/img/sporrandesigner/cache/'.$code.'.jpg');
			
			if ($statusCode==200):
				$response = 'existed';
			else:

				// CREATE A NEW IMAGE
				
				// $final_img3 = imagecreatetruecolor($x, $y);
				// 
				// 
				// imagesavealpha($final_img3, true);
				// 
				// $trans_colour = imagecolorallocatealpha($final_img3, 0, 0, 0, 127);
				// imagefill($final_img3, 0, 0, $trans_colour);
					
				// $images = array($background3,$s3,$st3,$t3,$l3,$c3);
				// $image = $cloudinary->image('https://mccalls.bndry.co.uk/apps2/assets/img/sporrandesigner/elements/previewbackground-1200x1360.png');
				  $image =  'https://mccalls.bndry.co.uk/apps2/assets/img/sporrandesigner/elements/previewbackground-1200x1360.png' ;
				// 		
				
				$publicId = 'sporran/elements/sporran_base';  // Replace with your image's public ID
				
			  // Replace with your image's public ID
				 
				 // Generate the image URL
				 $imageUrl = $cloudinary->image($publicId)->toUrl();
				 
				 // Function to check if the URL exists using a HEAD request
				 function checkImageExists($url) {
					 $headers = @get_headers($url, 1);
				 
					 // Check if the headers indicate a successful response
					 return strpos($headers[0], '200') !== false;
				 }
				
				$exists = false;
				// Check if the image exists in Cloudinary
				if (checkImageExists($imageUrl)) {
					echo "Image exists at URL: $imageUrl";
					$exists = true;
				} else {
					echo "Image does not exist or could not be found.";
				}
						
						
						$skinCode = str_replace('skins/', '',$skinImage );
						 $skinCode = str_replace('.png', '',$skinImage );
						 
						 
				if (!$exists):						
				try {
					  $uploadResult = $cloudinary->uploadApi()->upload($image, [
						  'folder' => 'sporran/elements',  // Optional: Specify folder to organize images
						  'public_id' => 'sporran_base',  // Optional: Specify a custom public ID for the image
						  'overwrite' => false,  // Overwrite if an image with the same public ID already exists
						  'resource_type' => 'image',  // Specify resource type as 'image'
					  ]);
				  
					  // Output the uploaded image's URL
					 // echo "Uploaded Image URL: " . $uploadResult['secure_url'];
				  
				  } catch (Exception $e) {
					  echo 'Upload failed: ' . $e->getMessage();
				  }
				 
			
				   try {
					 	$uploadResult = $cloudinary->uploadApi()->upload($s3, [
							'folder' => 'sporran/elements/skin/',  // Optional: Specify folder to organize images
							'public_id' => $skinCode,  // Optional: Specify a custom public ID for the image
							'overwrite' => false,  // Overwrite if an image with the same public ID already exists
							'resource_type' => 'image',  // Specify resource type as 'image'
						]);
					
						// Output the uploaded image's URL
						 echo "Uploaded Image URL: " . $uploadResult['secure_url'];
					
					} catch (Exception $e) {
						echo 'Upload failed: ' . $e->getMessage();
					}
					
				 endif;
				  
				
				   
				   
		
				  
				   $image = $cloudinary->image('sporran/elements/sporran_base')
				  ->overlay('sporran/elements/skin/'.$skinCode)
				//$image = $cloudinary->image('outfitdesigner/elements/hose/brown-hose.png ')
		 
				// outfitdesigner/elements/hose/$imageHose")  brown-hose.png 
				  // ->toUrl();
				// $image = $cloudinary->image($background3)
				//  
				//   ->overlay($s3)   
				//   ->overlay($st3)
				//   ->overlay($t3)
				//   ->overlay($l3)
				//   ->overlay($c3)
				    ->toUrl();
					
					  
					  try {
							   $uploadResult = $cloudinary->uploadApi()->upload($image, [
								  'folder' => 'sporran/cache/',  // Optional: Specify folder to organize images
								  'public_id' => $code,  // Optional: Specify a custom public ID for the image
								  'overwrite' => false,  // Overwrite if an image with the same public ID already exists
								  'resource_type' => 'image',  // Specify resource type as 'image'
							  ]);
						  
							  // Output the uploaded image's URL
							   echo "Uploaded Image URL: " . $uploadResult['secure_url'];
						  
						  } catch (Exception $e) {
							  echo 'Upload failed: ' . $e->getMessage();
						  }
						  
				 
					   
					   $imageUrl = $cloudinary->image('sporran/cache/'.$code)->toUrl();
					   
					   
				  echo '--><img src="'.$imageUrl.'"><--';
				  
				  
				  // try {
					//   $uploadResult = $cloudinary->uploadApi()->upload($image, [
					// 	  'folder' => 'sporran/cache,',  // Optional: Specify folder to organize images
					// 	  'public_id' => 'sporran_'.$code,  // Optional: Specify a custom public ID for the image
					// 	  'overwrite' => false,  // Overwrite if an image with the same public ID already exists
					// 	  'resource_type' => 'image',  // Specify resource type as 'image'
					//   ]);
				  // 
					//   // Output the uploaded image's URL
					//   echo "Uploaded Image URL: " . $uploadResult['secure_url'];
				  // 
				  // } catch (Exception $e) {
					//   echo 'Upload failed: ' . $e->getMessage();
				  // }
				  
				  
				// foreach ($images as $image) {
				//     $image_layer = imagecreatefrompng($image);
				//     imagecopy($final_img3, $image_layer, 0, 0, 0, 0, $x, $y);
				// }
				// 
				// 
				// 
				// imagejpeg($final_img3, "assets/img/sporrandesigner/cache/$code.jpg",50);
				// //imagejpeg($final_img3, "/Volumes/Martin%20Ext%20HDD/processed/$code.jpg",50);
				// $newwidth = 600;
				// $newheight = 680;
				// $thumb = imagecreatetruecolor($newwidth, $newheight);
				// //$source = imagecreatefromjpeg("assets/img/sporrandesigner/cache/$code.jpg");
				// $source = `php -r "imagecreatefrompng('assets/img/sporrandesigner/cache/$code.jpg');" 2>&1`;
				// imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $x, $y);
				// imagejpeg($thumb, "assets/img/sporrandesigner/cache/".$code."_600x680.jpg",90);
				// $response = 'created';

			endif;
		//return $response;
		}
		
		
		public function _validate($url)
		{
			
		  // Initialize the handle
		  $ch = curl_init();
		  // Set the URL to be executed
		  curl_setopt($ch, CURLOPT_URL, $url);
		  // Set the curl option to include the header in the output
		  curl_setopt($ch, CURLOPT_HEADER, true);
		  // Set the curl option NOT to output the body content
		  curl_setopt($ch, CURLOPT_NOBODY, true);
		  /* Set to TRUE to return the transfer
		  as a string of the return value of curl_exec(),
		  instead of outputting it out directly */
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  // Execute it
		  $data = curl_exec($ch);
		  // Finally close the handle
		  curl_close($ch);
		  /* In this case, we?re interested in
		  only the HTTP status code returned, therefore we
		  use preg_match to extract it, so in the second element
		  of the returned array is the status code */
		  preg_match("/HTTP\/1\.[1|0]\s(\d{3})/",$data,$matches);
		  if(isset($matches[1])):
		  	return $matches[1];
		  endif;
		}
	
	
	
	
	
	
	
	function saveCompareSporran($submittedCode){
 
		  $sql = "INSERT INTO `sporran-savedsporrans` (`saved_id`,`saved_code`) VALUES('','$submittedCode')";
		
		if ($this->db->simple_query($sql))
		{
     // echo "Success!";
        $this->db->trans_complete();
		//echo $this->db->insert_id();
		}
		else
		{
      //  echo "Query failed!";
		}

	}
		
	function getLatestSporrans(){
 	
			$q1 = $this->db->query("SELECT * FROM `sporran-savedsporrans` order by	`saved_id` DESC Limit 8");
			$returnedResults = array();
			if($q1->getNumRows()> 0) 
			{
				$i=0;
				$returnedResults['lastid'] = 0;
				foreach($q1->getResult() as $row1) 
				{	
					if ($returnedResults['lastid'] < $row1->saved_id):$returnedResults['lastid']= $row1->saved_id; endif;
					$returnedResults['sporrans'][$i]['code'] = $row1->saved_code;
					$returnedResults['sporrans'][$i]['details'] = $this->getSporran($row1->saved_code);
					
					$i++;
				}
			}
			
			return $returnedResults;

	}
	
	
	
	
	function generateCantleLeathers(){
		
		$leathers = array("A","B","C");

		foreach($leathers as $leather)
		{
			$imagecode='';
	
			//if ($leather == '0'){$imagecode='NON';}
			if ($leather == 'A'){$imagecode='L';}
			if ($leather == 'B'){$imagecode='P';}
			if ($leather == 'C'){$imagecode='S';}
		
			$q1 = $this->db->query("SELECT * FROM `sporran-cantle-shape`");
		
			if($q1->getNumRows()> 0)
			{
				
				foreach($q1->getResult() as $row1)
				{	
					
					$row1->shape_name;
					$q2 = $this->db->query("SELECT * FROM `sporran-leather-colour` ");
						
					
					if($q2->getNumRows()> 0) 
					{	
						foreach($q2->getResult() as $row2) 
						{
							$imageSmall = 'cantle-leathers/'.$row1->shape_code.'-'.$imagecode.'-' .$row2->colour_imageshort.'-3.png';
							//$q3 = $this->db->query("INSERT INTO `sporran-cantle-leather` (`leather_id`, `leather_material`, `leather_image_3`, `leather_price`, `leather_colour`, `leather_shape`) VALUES (NULL, '$leather', '$imageSmall', '0', '$row2->colour_code', '$row1->shape_name');");
							
							echo "<p>INSERT INTO `sporran-cantle-leather` (`leather_id`, `leather_material`, `leather_image_3`, `leather_price`, `leather_colour`, `leather_shape`) VALUES (NULL, '$leather', '$imageSmall', '0', '$row2->colour_code', '$row1->shape_name');</p>";
							
							//echo 'Material: '.$leather.' - Image:'.$row1->shape_code.'-'.$imagecode.'-' .$row2->colour_imageshort.'-3.png Colour:'.$row2->colour_code.' - Shape: '.$row1->shape_name.'<br/>';
						}
					}	
				}
			}

			//return $tassle;
		
		}
	}	
	
	
	
	
	// This is used to create all the tassle entries
	function generateTassleOptions(){
	
		$finish =  array (
            array (
               "three" => "ANT",
               "one" => "A",
               "name" => "Antique"
            ),
            array (
               "three" => "CHR",
               "one" => "C",
               "name" => "Chrome"
            ), 
            array (
               "three" => "PWT",
               "one" => "P",
               "name" =>  "Pewter"
            ),
            array (
               "three" => "CPR",
               "one" => "R",
               "name" => "Copper"
            ),
            array (
               "three" => "GLD",
               "one" => "G",
               "name" => "Gold"
            )
         );
         
       $amounts = array(
			        array (
						"amount" => 3,
						"design"  => "X"
						),
					array (
						"amount" => 3,
						"design"  => "S"
						),
					array (
						"amount" => 5,
						"design"  => "S"
					)
				);
				
       $shape = array( 
            array (
               "one" => 'C',
               "name"  => "CONE"
            ),
            array (
               "one" => 'B',
                "name"  => "BALL"
            ),
           array (
               "one" => 'E',
               "name"  => "BELL"
            ),
			array (
               "one" => "L",
               "name" => "LION"
            )           
         );
      
        echo '<p>INSERT INTO `sporran-tassle-finish` (`finish_group`, `finish_details`, `finish_shape`, `finish_design`, `finish_number`, `finish_img1`, `finish_img2`, `finish_img3`, `finish_img4`, `finish_img5`, `finish_code`) VALUES</p>';
        foreach($shape as $shapeItem)
		{
			//print_r($shapeItem);
			//echo $shapeitem['name'];
			foreach($finish as $finishItem)
			{
				foreach($amounts as $amountItem)
				{
					echo "<p>('".$finishItem['name']."', '', '".$shapeItem['name']."', '".$amountItem['design']."', ".$amountItem['amount'].", 'tassles/".$amountItem['amount']."".$amountItem['design']."-".$shapeItem['name']."-".$finishItem['three']."-1.png', 'tassles/".$amountItem['amount']."".$amountItem['design']."-".$shapeItem['name']."-".$finishItem['three']."-2.png', 'tassles/".$amountItem['amount']."".$amountItem['design']."-".$shapeItem['name']."-".$finishItem['three']."-3.png', 'tassles/".$amountItem['amount']."".$amountItem['design']."-".$shapeItem['name']."-".$finishItem['three']."-4.png', 'tassles/".$amountItem['amount']."".$amountItem['design']."-".$shapeItem['name']."-".$finishItem['three']."-5.png', '".$finishItem['one']."".$amountItem['amount']."".$amountItem['design']."".$shapeItem['one']."'),";
				}
			}
			
		}
	}




	// Loop through all options and generate the images
	function generateAllImages(){
		ini_set('memory_limit', '128M');
	//S30 C15 LAE A3SCE
		$skinsArray = $this->getSkin('all');
		$cantleArray = $this->getCantle('all');
		$cantleLeatherArray = $this->getLeatherTypes();
		$cantleLeatherColourArray = $this->getLeatherColours('all');
		$tassleArray =  $this->getTassle('all');
		$liningColoursArray =  	$this->getLeatherColours('all');
		//print_r($skinsArray);
		//print_r($tassleArray);
		//print_r($leatherColorsArray);
		$count=1;
		// Skins
		$completedcode[]="";
		foreach($skinsArray as $skinsItem){
			$level0 = $level1 =  $level2 =  $level3 = $level4 = $level5 ="";
			$level0 = $skinsItem['skin_code'];
		
		// Cantles	
			foreach($cantleArray as $cantleItem){
				$level1 = $cantleItem['cantle_code'];
				$cantleFinish = $cantleItem['cantle_finish'];
		// CantleLeatherType
				foreach($cantleLeatherArray as $cantleLeatherItem){
					$level2 = "L".$cantleLeatherItem['type_code'];
					
					foreach($cantleLeatherColourArray as $cantleLeatherColourItem){
					
						$level3 = $cantleLeatherColourItem['colour_code'];
						foreach($tassleArray as $tassleItem){
							$level4 = $tassleItem['finish_code'];
							
							if ($tassleItem['finish_group'] == $cantleFinish){
								foreach($liningColoursArray as $liningColoursItem){
									$level5 =  $liningColoursItem['colour_code'];
									$completedcode = "$level0$level1$level2$level3$level4$level5";
									
									$this->generateAllImagesOutput($completedcode,$count);
									$count++;
								
								}
							}
						}
						
					}
				}
			}
		
		}
		
		echo count($completedcode);
				
	}
		
	function generateAllImagesOutput($completedcode,$count){
	
		echo "$count - $completedcode \r\n ";
	
		//echo $completedcode;
	}
		
	}
	
	?>