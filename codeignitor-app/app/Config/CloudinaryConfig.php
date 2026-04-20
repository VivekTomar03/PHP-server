<?php

namespace Config;

use Cloudinary\Cloudinary;

class CloudinaryConfig
{
	public static $cloudinary;

	public static function initialize()
	{
		if (self::$cloudinary === null) {
			self::$cloudinary = new Cloudinary([
				'cloud' => [
				'cloud_name' => 'mccalls',
				'api_key'    => '126435147783647',
				'api_secret' => 'ENhbi5VczEyRR2UNF7NIowM784I',
					],
					'url' => [
						'secure' => true  // Ensures the URL is generated over HTTPS
					]
			]);
		}

		return self::$cloudinary;
	}
}


 