<?php

	namespace App\Controllers;

	use App\Controllers\BaseController;
	use App\Models\ShopifyModel;


	class Shopify extends BaseController {

		public function __construct() {

		}


		/**
		 * Generate wrapper markup for the Outfit builder
		 */
		public function index(){

			$data = [
				'BASE_URL' => env('app.baseURL'),
				'HOST' => env('app.host')
			];

			return view('outfits-interface-wrapper', $data);
		}

	}