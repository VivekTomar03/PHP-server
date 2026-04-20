<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Config\CloudinaryConfig;
 use Cloudinary\Transformation\Resize;
 use Cloudinary\Transformation\Gravity;
class Home extends BaseController
{
    public function index(): string
    {

        // Initialize Cloudinary
  $cloudinary = CloudinaryConfig::initialize();

    // Generate URL for an image with public ID 'sample'
   // $imageUrl = $cloudinary->image('outfitdesigner/elements/test/test-neck-ruche')->toUrl(); // Replace 'sample' with your image's public ID
    $imageUrl = $cloudinary->image('outfitdesigner/elements/kilts/3-pride-welsh')
    ->overlay('outfitdesigner/elements/test/test-hose') // Overlay th  ->gravity('center') // Position overlay at the center (optional)
    ->overlay('outfitdesigner/elements/test/test-sporran')
    ->overlay('outfitdesigner/elements/test/test-shirt')
    ->overlay('outfitdesigner/elements/test/test-neck-ruche')
    ->overlay('outfitdesigner/elements/test/test-jacket')
    ->resize(Resize::scale()->width(740))
    ->toUrl();

    // Pass the URL to the view
  //  return view('cloudinary_view', ['imageUrl' => $imageUrl]);
    //     array("transformation"=>array(
    //
    //             array("overlay"=>"outfitdesigner:elements:kilts:3-pride-welsh"),
    //
    //
    // array("overlay"=>"outfitdesigner:elements:test:test-hose"),
    //
    // //		array("overlay"=>"outfitdesigner:elements:test:test-sporran"),
    //     //	array("overlay"=>"outfitdesigner:elements:test:test-shirt"),
    //         array("overlay"=>"outfitdesigner:elements:test:test-neck-ruche"),
    // //	array("overlay"=>"outfitdesigner:elements:test:test-jacket"),
    //         array("width"=>740, "height"=>1570, "crop"=>"scale"),
    //         array("quality"=>70)


// Configuration::instance('cloudinary://126435147783647:ENhbi5VczEyRR2UNF7NIowM784I@mccalls?secure=true');
       // Create the image tag with the transformed image
       // $imgtag = ((new ImageTag('outfitdesigner:elements:test:test-hose'))
       //         ->resize(Resize::fill()->width(740)
       //     ->height(1570)
       //
       //   )
       // );
   //     $imageUrl = $cloudinary->image('outfitdesigner:elements:test:test-hose')->toUrl();
   //


        $data = array();
        $data['test'] = $imageUrl;



        return view('cloudinary_test',$data);

    }

    public function test(): string
    {
      $data = array();
      $data['test'] = 'hidden';
       return view('cloudinary_test', $data);
    }


}
