<?php

	namespace App\Controllers;

	use App\Controllers\BaseController;
	use Config\Services;

	class Ajax extends BaseController {

		/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 *        http://example.com/index.php/welcome
		 *    - or -
		 *        http://example.com/index.php/welcome/index
		 *    - or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see http://codeigniter.com/user_guide/general/urls.html
		 */

		public function __construct() {


			//   $this->load->model('model_page_data');


		}


		public function index() {
			$this->load->view('welcome_message');
		}


		public function share() {
			$application = $this->request->getPost('application');
			$usersname = $this->request->getPost('usersname');
			$emailaddress = $this->request->getPost('emailaddress');
			$message = $this->request->getPost('message');
			$outfitcode = $this->request->getPost('outfitcode');
			$checkboxval = $this->request->getPost('checkbox');
			$emailArray = $this->_splitEmails($emailaddress);
			//$email = $this->_splitEmails($emailaddress);
			$response = $this->_sendEmails($emailArray, $usersname, $outfitcode, $message, $application);
			$data['type'] = "share";
			// Display feedback

			return view('email_templates/ajax_responses', $data);


		}

		public function enquire() {
			$data = array();
			$application = $this->request->getPost('application');
			$usersname = $this->request->getPost('usersname');
			$emailaddress = $this->request->getPost('emailaddress');
			$message = $this->request->getPost('message');
			$outfitcode = $this->request->getPost('outfitcode');
			$checkboxval = $this->request->getPost('checkbox');
			$branch = $this->request->getPost('branch');

			$waistSize = $this->request->getPost('waistSize');
			$seatSize = null;
			$height = $this->request->getPost('height');
			$kiltlength = $this->request->getPost('kiltlength');
			$collar = $this->request->getPost('collar');
			$chest = $this->request->getPost('chest');
			$shoe = $this->request->getPost('shoe');

			$address1 = $this->request->getPost('address1');
			$address2 = $this->request->getPost('address2');
			$city = $this->request->getPost('city');
			$postcode = $this->request->getPost('postcode');
			$telno = $this->request->getPost('telno');

			// $emailArray = $this->_splitEmails($emailaddress);
			$data['type'] = "enquire";
			// $emailaddress = 'martin@boundarycreative.co.uk';
			// print_r($email);
			//$emailaddress = $this->_splitEmails($emailaddress);

			$response = $this->_sendMcCallsEmail($emailaddress, $usersname, $outfitcode, $message, $branch, $application, $waistSize, $seatSize, $height, $kiltlength, $collar, $chest, $shoe, $address1, $address2, $city, $postcode, $telno);
			return view('email_templates/ajax_responses', $data);
			// Display feedback
			//echo $application;
			//$this->load->view('email_templates/ajax_responses', $data);
			//	   return view('email_templates/ajax_responses',$data);
			//$this->model_page_data->logemail('enquire', $emailaddress, $outfitcode,$usersname,$message,$application);

		}


		public function _splitEmails($emailaddress) {
			$myArray = explode(',', $emailaddress);
			return $myArray;
		}


		public function _sendEmails($emailArray, $usersname, $outfitcode, $emailMessage, $application) {
			// $config['wordwrap'] = FALSE;
			// $config['mailtype'] = 'html';
			// 	$config['protocol'] = 'smtp';
			// $config['smtp_host'] = 'smtp.converged.co.uk';
			// $config['smtp_users'] = '';
			// $config['smtp_pass'] = '';
			$config = [
				'protocol' => 'smtp',
				'SMTPHost' => 'smtp.converged.co.uk',
				'SMTPUser' => '',
				'SMTPPass' => '',
				'SMTPPort' => 587,
				'mailType' => 'html',
				'charset' => 'utf-8',
				'wordWrap' => true,
			];
			$email = Services::email();
			$email->initialize($config);
			// Load and configure the Email service

			$i = 0;
			$interestedDiscInfo = [];
			$interestedDiscInfo['outfitcode'] = $outfitcode;
			$interestedDiscInfo['personname'] = $usersname;
			$interestedDiscInfo['message'] = $emailMessage;
			foreach($emailArray as $emailaddress) {

				// EMAIL START


				$emailview = "email_templates/hire_general_email";
				$emailsubject = "You have been sent a McCalls Hire Outfit";

				if($application == 'pride') {
					$emailview = "email_templates/pride_general_email";
					$emailsubject = "You have been sent a McCalls Pride Outfit";
				}

				$message = $this->load->view($emailview, $interestedDiscInfo, true);
				$email->setFrom('outfit@mccalls.co.uk', 'McCalls Highlandwear Outfit Builder');
				$email->setTo($emailaddress);
				$email->setSubject($emailsubject);
				$email->setMessage($message);


				$email->setFrom('outfit@mccalls.co.uk', 'McCalls Highlandwear Outfit Builder');
				$email->setTo($emailaddress);
				$email->setSubject($emailsubject);
				$email->setMessage($message);
				$email->send();
				//$this->model_page_data->logemail('share', $email, $outfitcode,$usersname,$emailMessage);
			}

			$this->db->set('enquiry_type', 'Outfit Shared');
			$this->db->set('enquiry_email', $email);
			$this->db->insert('outfit_enquiries');

			//$this->db->insert('outfit_enquiries', $dbdata);
			return true;
		}


		public function _sendMcCallsEmail($emailaddress, $usersname, $outfitcode, $messagePost, $branch, $application, $waistSize = '', $seatSize = '', $height = '', $kiltlength = '', $collar = '', $chest = '', $shoe = '', $address1 = '', $address2 = '', $city = '', $postcode = '', $telno = '') {
			$email = Services::email();
			$config = [
				'protocol' => 'smtp',
				'SMTPHost' => 'smtp.converged.co.uk',
				'SMTPUser' => '',
				'SMTPPass' => '',
				'SMTPPort' => 587,
				'mailType' => 'html',
				'charset' => 'utf-8',
				'wordWrap' => true,
			];
			$email = Services::email();
			$email->initialize($config);


			//	$this->load->library('email',$config);
			$i = 0;
			$branchEmail = 'hire@mccalls.co.uk';
			//if ($branch == 'weave'){$branchEmail='martin@weavedigital.co.uk';}
			if($branch == 'aberdeen') {
				$branchEmail = 'hire@mccalls.co.uk';
			}
			//if ($branch == 'aberdeen'){$branchEmail='martin@boundarycreative.co.uk';}
			if($branch == 'broughty_ferry') {
				$branchEmail = 'b-ferry@mccalls.co.uk';
			}
			if($branch == 'edinburgh') {
				$branchEmail = 'edinburgh@mccalls.co.uk';
			}
			if($branch == 'elgin') {
				$branchEmail = 'elgin@mccalls.co.uk';
			}
			if($branch == 'falkirk') {
				$branchEmail = 'falkirk@mccalls.co.uk';
			}
			if($branch == 'glasgow') {
				$branchEmail = 'glasgow@mccalls.co.uk';
			}
			if($branch == 'tillicoultry') {
				$branchEmail = 'daiglen@mccalls.co.uk';
			}
			if($branch == 'dundee') {
				$branchEmail = 'dundee@mccalls.co.uk';
			}


			// EMAIL START

			$interestedDiscInfo['outfitcode'] = $outfitcode;
			$interestedDiscInfo['personname'] = $usersname;
			$interestedDiscInfo['message'] = $messagePost;
			$interestedDiscInfo['usersEmail'] = $emailaddress;
			$interestedDiscInfo['branchChosen'] = $branch;
			$interestedDiscInfo['branchEmail'] = $branchEmail;
			$interestedDiscInfo['waistSize'] = $waistSize;
			$interestedDiscInfo['seatSize'] = $seatSize;
			$interestedDiscInfo['height'] = $height;
			$interestedDiscInfo['kiltlength'] = $kiltlength;
			$interestedDiscInfo['collar'] = $collar;
			$interestedDiscInfo['chest'] = $chest;
			$interestedDiscInfo['shoe'] = $shoe;
			$interestedDiscInfo['address1'] = $address1;
			$interestedDiscInfo['address2'] = $address2;
			$interestedDiscInfo['city'] = $city;
			$interestedDiscInfo['postcode'] = $postcode;
			$interestedDiscInfo['telno'] = $telno;

			$emailview = "email_templates/hire_enquire_email";
			$emailsubject = "McCalls Hire Outfit Builder - Enquiry";

			if($application == 'pride') {
				$emailview = "email_templates/pride_enquire_email";
				$emailsubject = "McCalls Pride Outfit Builder - Enquiry";
			}
			//$message = $this->load->view($emailview,$interestedDiscInfo,true);
			$message = view($emailview, $interestedDiscInfo);

			//echo $emailsubject;

			// $this->email->from('outfit@mccalls.co.uk', 'McCalls Outfit Builder');
			// $this->email->to($branchEmail);
			// $this->email->cc('neil.rayner@mccalls.co.uk');
			// $this->email->cc('support@boundarycreative.co.uk');
			// $this->email->subject($emailsubject);
			// $this->email->message($message);
			// $this->email->send();
			$email->setFrom('outfit@mccalls.co.uk', 'McCalls Highlandwear Outfit Builder');

			$email->setTo($branchEmail);
			//$email->setCC('dev@boundarycreative.co.uk');

			$email->setSubject($emailsubject);
			$email->setMessage($message);
			$email->send();
			$db = \Config\Database::connect();
			// 	$builder = $db->table('$emailaddress');
			//
			// 	   $builder->db->set('enquiry_type', 'Outfit Enquiry');
			// 	   $builder->db->set('enquiry_email', $emailaddress );
			// 	 $builder->db->insert();
			//
			// 	   $db = \Config\Database::connect(); // Get the database connection
			$builder = $db->table('outfit_enquiries'); // Create a query builder for the 'enquiries' table

			// Insert data into the table
			$data = [
				'enquiry_type' => 'Outfit Enquiry',
				'enquiry_email' => $emailaddress,
			];
			$builder->insert($data);
			//$this->model_page_data->logemail($emailsubject, $emailaddress, $outfitcode,$usersname,$messagePost);
			return true;

		}


		// AJAX LOAD SELECTED PRODUCT

		public function product() {
			$this->load->model('model_page_data');
			$ref = $this->request->getPost('chosenproduct');
			$application = $this->request->getPost('designerType');

			if($application == 'pride') {
				$returnproduct = $this->model_page_data->getOneProduct($ref, 'pride');
			}
			if($application == 'hire') {
				$returnproduct = $this->model_page_data->getOneProduct($ref, 'hire');
			}
			//	print_r($returnproduct);

			$json = json_encode($returnproduct);
			echo $json;

		}


	}

	/* End of file welcome.php */
	/* Location: ./application/controllers/welcome.php */