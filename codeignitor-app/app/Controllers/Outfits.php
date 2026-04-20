<?php

	namespace App\Controllers;

	use App\Models\OutfitsModel;
	use App\Models\TartanModel;

	class Outfits extends BaseController {


		protected $outfitsModel;
		protected $tartanModel;


		public function __construct() {
			$this->outfitsModel = new OutfitsModel();
			$this->tartanModel = new TartanModel();
		}

		public function index() {
		}

		// NOTE ANY CHANGES NEED TO BE REPLICATED IN NAMESEARCH FOR TARTAN LINK
		public function getDefaultOutfit($code = '', $type = '') {
			//$defaultcode = 'KXGROSH2HCZNMRBJELH5H';
			$defaultcode = 'KSMS7SH2HCZNM8BJ2LH9H';
			if($type == 'tartan'):
				$defaultcode = $code . 'G2HCZNZTJJDLH7H';
			endif;
			return $defaultcode;
		}


		public function get() {

			$outfitCodeDefault = $this->getDefaultOutfit('', 'default');
			$outputdata = array();
			$error = '';

			if($this->request->getUri()->getSegment(3) !== ''):
				$outfitCode = $this->request->getUri()->getSegment(3);
			else:
				$outfitCode = $outfitCodeDefault;
			endif;

			$outfitData = $this->outfitsModel->getOutfit($outfitCode);

			$outputdata['error'] = $error;
			$outputdata['type'] = "builder";
			$outputdata['outputdata'] = $outfitData;
			//$pagedata['sporrancode'] = $sporranCode;

			return $this->response
				->setStatusCode(200)
				->setJSON($outputdata);
		}

		public function getTartanList() {
			set_time_limit(300);

			$data = [];
			$outfitData = $this->tartanModel->getTartanList();
			foreach($outfitData as $k => $v) {
				if(count($v['family_tartans'])) {
					array_push($data,
						[
							'item_id' => $v["family_id"],
							'label' => $v["family_name"],
							'name' => $v["family_name"],
							'image' => 'L1102045.jpg'
						]
					);
				}
			}

			$outputdata['type'] = "builder";
			$outputdata['nameslist'] = $data;
			//$pagedata['sporrancode'] = $sporranCode;

			//return view('tartan/json-listavailable', $outputdata);
			return $this->response
				->setJSON($outputdata)
				->setStatusCode(200);
		}

		/**
		 * No in USE
		 */
		public function getTartanList2() {
			set_time_limit(300);

			$outfitData = $this->tartanModel->getTartanList();

			foreach($outfitData as $tartan):
				if(count($tartan['family_tartans'])):
					echo $tartan['family_name'] . ',<br/>';
				endif;
			endforeach;
		}


		/**
		 * Build page data array for a given outfit code
		 */
		private function buildPageData($outfitCodeDefault) {
			$error = false;
			$hireorbuyCode = substr($outfitCodeDefault, 20, 1);
			$hireorbuy = 'hire';
			if($hireorbuyCode == 'B'){
				$hireorbuy = 'buy';
			}

			$pagedata['tartandata'] = $this->outfitsModel->getTartans('all', $hireorbuy);

			$tartancode = substr($outfitCodeDefault, 1, 4);
			$tartansearchdata = $this->tartanModel->getTartanByCode($tartancode);

			$tartandata = '';
			if(isset($tartansearchdata['tartan_parent_id']) && $tartansearchdata['tartan_parent_id'] != 3):
				$tartandata = $this->tartanModel->getName($tartansearchdata['tartan_parent_id']);
			endif;

			$pagedata['outfitCodeDefault'] = $this->getDefaultOutfit('', 'default');
			$pagedata['tartansearchdata'] = $tartandata;

			$pagedata['sporranAntiqueData'] = $this->outfitsModel->getProduct('Sporrans Antique', $hireorbuy);
			$pagedata['sporranChromeData'] = $this->outfitsModel->getProduct('Sporrans Chrome', $hireorbuy);
			$pagedata['sporranCopperData'] = $this->outfitsModel->getProduct('Sporrans Copper', $hireorbuy);
			$pagedata['sporranGoldData'] = $this->outfitsModel->getProduct('Sporrans Gold', $hireorbuy);
			$pagedata['sporranDayData'] = $this->outfitsModel->getProduct('Sporrans Day', $hireorbuy);
			$pagedata['sporranPewterData'] = $this->outfitsModel->getProduct('Sporrans Pewter', $hireorbuy);

			$pagedata['shirtData'] = $this->outfitsModel->getProduct('Shirts', $hireorbuy);
			$pagedata['shoesData'] = $this->outfitsModel->getProduct('Shoes', $hireorbuy);
			$pagedata['neckwearCravatData'] = $this->outfitsModel->getProduct('Cravat', $hireorbuy);
			$pagedata['neckwearSilktieData'] = $this->outfitsModel->getProduct('Silk Tie', $hireorbuy);
			$pagedata['neckwearBowtieData'] = $this->outfitsModel->getProduct('Bow Tie', $hireorbuy);
			$pagedata['neckwearWooltieData'] = $this->outfitsModel->getProduct('Wool Tie', $hireorbuy);

			$pagedata['jacketsData'] = $this->outfitsModel->getProduct('Jackets', $hireorbuy);
			$pagedata['hoseEcruData'] = $this->outfitsModel->getProduct('Hose Ecru', $hireorbuy);
			$pagedata['hoseCharcoalData'] = $this->outfitsModel->getProduct('Hose Charcoal', $hireorbuy);
			$pagedata['hoseBlackData'] = $this->outfitsModel->getProduct('Hose Black', $hireorbuy);
			$pagedata['hoseColourData'] = $this->outfitsModel->getProduct('Hose Colour', $hireorbuy);
			$pagedata['hoseTartanData'] = $this->outfitsModel->getProduct('Hose Tartan', $hireorbuy);

			$pagedata['type'] = "builder";
			$pagedata['error'] = $error;
			$pagedata['outfitcode'] = $outfitCodeDefault;
			$pagedata['book_url'] = 'https://www.mccalls.co.uk/pages/book-your-appointment';
			$pagedata['preview_outfit_url'] = 'Preview URL';

			return $pagedata;
		}

		private function getOutfitCodeFromRequest() {
			$outfitCodeDefault = $this->getDefaultOutfit('', 'default');
			if($this->request->getUri()->getSegment(3) !== null) {
				$code = $this->request->getUri()->getSegment(3);
				if(strpos($code, 'undefined') === false) {
					$outfitCodeDefault = $code;
				}
			}
			return $outfitCodeDefault;
		}

		/**
		 * Outputs left side UI controls (partial — used by AJAX)
		 *
		 * @return string
		 */
		public function loadui() {
			$outfitCodeDefault = $this->getOutfitCodeFromRequest();
			$pagedata = $this->buildPageData($outfitCodeDefault);
			return view('outfits-interface', $pagedata);
		}

		/**
		 * Full standalone page for local development
		 */
		public function localdev() {
			$outfitCodeDefault = $this->getOutfitCodeFromRequest();
			$pagedata = $this->buildPageData($outfitCodeDefault);
			return view('local-page', $pagedata);
		}


		public function addUniqueCodes() {
			$this->outfitsModel->setUniqueCodes();
		}


		public function getElement() {
			$elementType = false;
			$elementCode = false;
			$error = true;

			// Defaults
			//$outfitCode = 'KZ2YZSH2HCZNZJJJELH5B' . '<br/>';

			/*$kiltcode = substr($outfitCode, 1, 4);
			$sporrancode = substr($outfitCode, 5, 3);
			$shirtcode = substr($outfitCode, 9, 2);
			$neckwearcode = substr($outfitCode, 12, 2);
			$shoecode = substr($outfitCode, 14, 1);
			$jacketcode = substr($outfitCode, 15, 2);
			$hosecode = substr($outfitCode, 18, 2);*/

			if($this->request->getVar('type') && $elementCode = $this->request->getVar('code')) {
				$elementType = $this->request->getVar('type');
				$elementCode = $this->request->getVar('code');
			}

			/*if($elementType == "tartan") {
				$kiltcode = $elementCode;
			}*/

			//$outfitCode = $kiltcode . '' . $sporrancode . 'H' . $shirtcode . 'N' . $neckwearcode . '' . $shoecode . '' . $jacketcode . 'L' . $hosecode . 'B';

			//$elementDataFull = $this->outfitsModel->getSingleProductElement($elementType, $elementCode);

			$outputdata['error'] = $error;
			$outputdata['type'] = 'element';
			$outputdata['outputdata'] = $this->outfitsModel->getSingleProductElement($elementType, $elementCode);

			return $this->response
				->setStatusCode(200)
				->setJSON($outputdata);
		}
	}