<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($sporrandata);
header('Content-Type: application/json');

echo json_encode($outputdata,JSON_UNESCAPED_SLASHES);

?>