<?php
	$i = 0;
	$data = '';
	foreach($nameslist as $name):
		$data .= '<a href="https://www.mccalls.co.uk/tartanexplorer#' . $name["family_id"] . '">itemid":' . $name["family_id"] . ' - Name: ' . $name["family_name"] . '</a><br/>';
		$i++;
	endforeach;
?>
<?= $data; ?>
