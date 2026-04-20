<?php
	//print_r($nameslist);
	$i = 0;
	$data = '';
	foreach($nameslist as $name):
		if($i != 0): $data .= ','; endif;
		$data .= '{ "itemid": "' . $name["family_id"] . '", "label": "' . $name["family_name"] . '", "name": "' . $name["family_name"] . '", "image": "L1102045.jpg" }';
		$i++;
	endforeach;
?>

[
<?= $data; ?>
]