<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\KithkinModel;
class NameApi extends BaseController{


	public function index()
	{
		echo ':-)';
	}


	public function submitKithKinData()
	{
		//$this->form_validation->set_rules('names', 'Name', 'required');

		$sendData = [];
		$response = [];
		$data = [];
		$responseMessage='';
		 $response["status"]=false;

		$sendData['names']   	= $this->request->getVar('names');
        $sendData['locations']	= $this->request->getVar('locations');
        $sendData['clan']	=     $this->request->getVar('clan');
		$sendData['fromFamily']	= $this->request->getVar('fromFamily');
		$sendData['sameSept']	= $this->request->getVar('sameSept');
		$sendData['seeSept']	= $this->request->getVar('seeSept');
		$sendData['alsoSept']	= $this->request->getVar('alsoSept');
		$sendData['type']	=     $this->request->getVar('type');

		$sendData['markasClan']	= $this->request->getVar('isClan');

		if (strlen($sendData['names'] ) > 2):

			$response = $this->KithkinModel->saveDataLine($sendData);
			$responseMessage = $response['responseMessage'];
		else:
			$responseMessage .= 'Sorry no name found';
		endif;

	    $response["status"] = false;
		$response["message"] = $responseMessage;
		$response["names"] = $sendData['names'];
		$response["locations"] = $sendData['locations'];
		$response["clan"] = $sendData['clan'];
		$response["fromFamily"] = $sendData['fromFamily'];
		$response["seeSept"] = $sendData['seeSept'];
		$response["alsoSept"] = $sendData['alsoSept'];


		$data['response'] = $response;
		//print_r($data);

		//return view('tartan/jsonResponse',$data);

		return $this->response
			->setStatusCode(200)
			->setJSON($data);
	}

}
