<?php
	$i = 0;
	$data = '';
	foreach($nameslist as $name):
		if(count($name["family_tartans"]) > 0) {
			if($i != 0) {
				$data .= ',';
			}
			$data .= '{ "itemid": "' . $name["family_id"] . '", "label": "' . $name["family_name"] . '", "name": "' . $name["family_name"] . '", "image": "L1102045.jpg" }';
			$i++;
		}
	endforeach;
?>

[
<?= $data; ?>
]