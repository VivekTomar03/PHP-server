<?php


	namespace App\Models;

	/**
	 * Endpoints used in the Tartan Explorer feature in the Shopify store
	 *
	 * Class ShopifyModel
	 * @package App\Models
	 */
	class ShopifyModel {

		function getTartans() {

			$model = new ShopifyModel();

			$sql = 'SELECT * FROM
					FROM `tartans` AS t					
					WHERE t.tartan_active = 1
					ORDER BY tartan_parent, tartan_variant';

			$result = $this->db->query($sql);
			return $result->getResultArray();
		}


		/**
		 * @return mixed
		 */
		function getTartansByFamily(){

			$sql = 'SELECT fn.family_id,fn.family_name,t.*
					FROM `tartans` AS t
					INNER JOIN `family_names` AS fn
					ON t.tartan_parent=fn.family_id
					WHERE t.tartan_active=1
					ORDER BY fn.family_id';

			$result = $this->db->query($sql);

			return $result->getResultArray();
		}
	}