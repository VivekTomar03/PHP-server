<?php

	namespace App\Controllers;

	use App\Controllers\BaseController;
	use App\Models\TartanModel;

	class Namesearch extends BaseController {

		public function __construct() {

			$this->tartanModel = new TartanModel();
		}


		public function index() {
			$data = false;
			if(isset($this->session->tartanId)):
				// Go get the saved tartan data
				$nameId = $this->session->tartanId;
				$data['savedTartan'] = $this->tartanModel->getTartan($nameId);

				$defaultOutfitcode = $this->getDefaultOutfit($data['savedTartan']['tartan_uniquecode'], 'tartan');
				$data['tartanId'] = $nameId;
				$data['tartanCode'] = $defaultOutfitcode;

			endif;
			$this->load->view('tartan/search', $data);
		}

		// NOTE ANY CHANGES NEED TO BE REPLICATED IN NAMESEARCH FOR TARTAN LINK
		public function getDefaultOutfit($code, $type) {
			//$type == 'tartan'
			$defaultcode = $this->tartanModel->getDefaultOutfit($code, $type);

			return $defaultcode;
		}

		/**
		 * @return \CodeIgniter\HTTP\ResponseInterface
		 */
		public function listall() {

			$namelist = $this->tartanModel->getList();
			//return view('tartan/json-listall', $data);
			$data = [];
			foreach($namelist as $v) {
				array_push($data, [
					'item_id' => $v['family_id'],
					'label' => $v['family_name'],
					'name' => $v['family_name'],
					'image' => 'L1102045.jpg',
				]);
			}

			return $this->response
				->setStatusCode(200)
				->setJSON($data);
		}

		/**
		 * @return string
		 */
		public function listallnames() {
			$data['nameslist'] = $this->tartanModel->getList();
			return view('tartan/listallnames', $data);
		}


		public function getname() {
			$nameId = $this->request->getUri()->getSegment(3);
			$data = $this->tartanModel->getName($nameId);
			//$data['nameslist'] = $this->tartanModel->getName($nameId);
			//return view('tartan/json-singlename', $data);
			return $this->response
				->setJSON($data)
				->setStatusCode(200);
		}


		/**
		 * @return string
		 */
		public function admin() {
			$data['surnameData'] = 'test';
			$data['locationsData'] = 'test';
			return view('admin/welcome', $data);

		}

		/**
		 * @return \CodeIgniter\HTTP\ResponseInterface
		 */
		public function loadTartan() {
			$tartanId = $this->request->getUri()->getSegment(3);

			if($tartanId):
				$this->tartanModel->saveTartan($tartanId);
				$data['nameslist'] = $this->tartanModel->getTartan($tartanId);
				$defaultOutfitcode = $this->getDefaultOutfit($data['nameslist']['tartan_uniquecode'], 'tartan');

				$data['nameslist']['outfit_link'] = $defaultOutfitcode;
				//return view('tartan/json-singlename', $data);
				return $this->response
					->setStatusCode(200)
					->setJSON($data);
			else:
				return $this->response
					->setStatusCode(200)
					->setJSON([]);
			endif;
		}

		public function unloadTartan() {
			$data['nameslist'] = $this->tartanModel->unloadSavedTartan();
			//return view('tartan/json-singlename', $data);
			return $this->response
				->setStatusCode(200)
				->setJSON($data);
		}

	}
