<?php

	namespace App\Controllers;

	use App\Controllers\BaseController;

	use App\Models\SporranModel;

	class Sporran extends BaseController {

		public function __construct() {
			// Load the model in the constructor
			//$this->outfitsModel = new OutfitsModel();
			$this->sporranModel = new SporranModel();
		}

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
		 * @see https://codeigniter.com/user_guide/general/urls.html
		 */
		public function index() {

		}


		public function get() {

			$sporranCodeDefault = 'S12C15LCEA3SEE';
			$sporranData = '';
			$error = '';

			//$cantledata = $this->model_sporrans->getCantle('all');
			//$skindata = $this->model_sporrans->getSkin('all');
			//$tassledata = $this->model_sporrans->getTassle('all');

			if(strlen($this->request->getUri()->getSegment(3)) > 0):
				$sporranCode = $this->request->getUri()->getSegment(3);
			else:
				$sporranCode = $sporranCodeDefault;
			endif;

			$sporranData = $this->sporranModel->getSporran($sporranCode);

			if($sporranData['status'] == false):
				$error['status'] = false;
				//$error['alert'] = $sporranData['alert'];
				$sporranData['status'] = $error['status'];
				$sporranData['info'] = $this->sporranModel->getSporran($sporranCodeDefault);
				//	print_r($sporranData);
			endif;


			$pagedata['error'] = $error;
			$pagedata['type'] = "builder";

			$pagedata['outputdata'] = $sporranData;

			//$pagedata['sporrancode'] = $sporranCode;

			return view('json', $pagedata);
		}


		public function loadui() {
			$this->load->model('model_sporrans');
			$sporranCodeDefault = 'S09C15LAEA3SCE';
			$error = false;
			$sporranData = '';

			// Get All Data For Interface
			$cantleData = $this->model_sporrans->getCantle('all');
			$cantleLeatherColourData = $this->model_sporrans->getLeatherColours('all');
			$cantleLeatherTypesData = $this->model_sporrans->getLeatherTypes();
			$skinData = $this->model_sporrans->getSkin('all');
			$tassleData = $this->model_sporrans->getTassle('all');

			// Get Sporran info if set, if no load default
			if($this->uri->segment(3) !== null):
				$sporranCode = $this->uri->segment(3);
			else:
				$sporranCode = $sporranCodeDefault;
			endif;

			$sporranData = $this->model_sporrans->getSporran($sporranCode);

			// If error try again with default code
			if($sporranData['status'] == false):
				$error['status'] = true;
				$error['alert'] = $sporranData['alert'];
				$sporranData = $this->model_sporrans->getSporran($sporranCodeDefault);
				//	print_r($sporranData);
			endif;


			$pagedata['type'] = "builder";
			$pagedata['error'] = $error;
			$pagedata['sporrandata'] = $sporranData;
			$pagedata['cantledata'] = $cantleData;
			$pagedata['cantlecolourdata'] = $cantleLeatherColourData;
			$pagedata['cantleatherdata'] = $cantleLeatherTypesData;
			$pagedata['skindata'] = $skinData;
			$pagedata['tassledata'] = $tassleData;
			$pagedata['sporrancode'] = $sporranCode;

			$this->load->view('sporran-interface', $pagedata);


		}


		public function listSkins() {
			$this->load->model('model_sporrans');
			$formdata = $this->model_sporrans->getSkin('all');

			$pagedata['type'] = "skin-list";
			$pagedata['formdata'] = $formdata;
			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}


		public function editSkin() {
			$this->load->model('model_sporrans');
			$formdata = '';

			if($this->uri->segment(3) !== null) {
				$formdata = $this->model_sporrans->getSkin($this->uri->segment(3));
			}

			$pagedata['type'] = "skin-item";
			$pagedata['formdata'] = $formdata;

			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}


		public function listCantles() {
			$this->load->model('model_sporrans');
			$formdata = $this->model_sporrans->getCantle('all');
			$pagedata['type'] = "cantle-list";
			$pagedata['formdata'] = $formdata;
			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}

		public function editCantle() {
			$this->load->model('model_sporrans');
			$formdata = '';

			if($this->uri->segment(3) !== null) {
				$formdata = $this->model_sporrans->getCantle($this->uri->segment(3));
			}


			$pagedata['type'] = "cantle-item";
			$pagedata['formdata'] = $formdata;
			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}


		public function listTassles() {
			$this->load->model('model_sporrans');
			$formdata = $this->model_sporrans->getTassle('all');
			$pagedata['type'] = "tassle-list";
			$pagedata['formdata'] = $formdata;
			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}

		public function editTassle() {
			$this->load->model('model_sporrans');
			$formdata = '';

			if($this->uri->segment(3) !== null) {
				$formdata = $this->model_sporrans->getTassle($this->uri->segment(3));
			}


			$pagedata['type'] = "tassle-item";
			$pagedata['formdata'] = $formdata;
			$this->load->view('adminarea/view_admin_welcome', $pagedata);
		}


		public function builder() {
			$this->load->model('model_sporrans');
			$sporrancode = 'S09C15LAEA3SCE';
			$sporrandata = '';
			$cantledata = $this->model_sporrans->getCantle('all');
			$skindata = $this->model_sporrans->getSkin('all');
			$tassledata = $this->model_sporrans->getTassle('all');

			if($this->uri->segment(3) !== null):
				$sporrancode = $this->uri->segment(3);
			endif;

			$sporrandata = $this->model_sporrans->getSporran($sporrancode);


			$pagedata['type'] = "builder";
			$pagedata['sporrandata'] = $sporrandata;
			$pagedata['cantledata'] = $cantledata;
			$pagedata['skindata'] = $skindata;
			$pagedata['tassledata'] = $tassledata;
			$pagedata['sporrancode'] = $sporrancode;

			$this->load->view('adminarea/view_admin_welcome', $pagedata);

		}


		public function addCompare() {
			$this->load->model('model_sporrans');
			$this->load->library('session');

			if($this->uri->segment(3) !== null):

				$sporranCode = $this->uri->segment(3);
				$sporranData = $this->model_sporrans->getSporran($sporranCode);
				$previousCompare = '';

				//$this->session->unset_userdata('sporranCompare');

				// If no error save
				if($sporranData['status'] != false):

					if($this->session->userdata('sporranCompare')):

						$previousCompare = $this->session->userdata('sporranCompare');

						if(in_array($sporranCode, $previousCompare)):

							//	echo 'this array contains this code';
						else:
							array_unshift($previousCompare, $sporranCode);

							$latestFour = array_splice($previousCompare, 0, 4);
							$this->session->set_userdata('sporranCompare', $latestFour);

							//echo 'this array doesnt contains this code';
							$sporranReturned = $this->model_sporrans->saveCompareSporran($sporranCode);
						endif;

					else:

						$previousCompare[] = $sporranCode;
						$this->session->set_userdata('sporranCompare', $previousCompare);
						$sporranReturned = $this->model_sporrans->saveCompareSporran($sporranCode);

					endif;


				endif;


			//print_r($this->session->userdata('sporranCompare'));


			else: // No url ref to add - show all.

				//if ($this->session->userdata('sporranCompare')):
				//echo json_encode($this->session->userdata('sporranCompare'));
				//endif;
			endif;

			$returnedData = '';
			$sporransInSession = $this->session->userdata('sporranCompare');
			$i = 0;
			if(count($sporransInSession)):
				foreach($sporransInSession as $sporran) {
					$returnedData[$i] = $this->model_sporrans->getSporran($sporran);
					$i++;
				}
			endif;

			$pagedata['sporrandata'] = $returnedData;
			$this->load->view('json', $pagedata);
			//echo json_encode($returnedData);
		}

		public function listLatest() {
			$this->load->model('model_sporrans');
			$sporranReturned = $this->model_sporrans->getLatestSporrans();
			echo json_encode($sporranReturned);
		}
		// Function to generate all variations of cantle colours.
		//generateTassleOptions || generateLeathers
		public function generateLeathers() {

			$this->load->model('model_sporrans');
			$data = $this->model_sporrans->generateCantleLeathers();

		}


		public function generateAllImages() {
			$this->load->model('model_sporrans');
			$this->model_sporrans->generateAllImages();
		}


	}
