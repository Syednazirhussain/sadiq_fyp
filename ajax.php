<?php

require('autoload.php');

$mandatoryParameters = [
	'getProductById'	=> ['product_id']
];


if (isset($_REQUEST['class']) && isset($_REQUEST['method']) && isset($_REQUEST['params'])) {

	$_class = $_REQUEST['class'];
	$_method = $_REQUEST['method'];
	$_params = $_REQUEST['params'];

	if (!is_null($_class) && !is_null($_method) && !empty($_params)) {

		if (is_array($_params)) {

			$flag = true;
			foreach ($mandatoryParameters as $key => $value) {
				if ($key == $_method) {
					foreach ($value as $parameter) {
						if (!array_key_exists($parameter, $_params)) {
							$flag = false;
						}
					}
				}
			}

			if ($flag == true) {

				if ($_class == 'product') {

					$response = (new product)->$_method($_params);
					echo json_encode($response);
				}
			} else {

				echo json_encode([
					'status'	=> 'fail',
					'message'	=> 'something went wrong'
				]);

			}
		} else {

			echo json_encode([
				'status'	=> 'fail',
				'message'	=> 'parameters must be an array'
			]);
		}

	} else {
		echo json_encode([
			'status'	=> 'fail',
			'message'	=> 'invalid request parameter'
		]);
	}
} else {
	echo json_encode([
		'status'	=> 'fail',
		'message'	=> 'invalid request'
	]);
}

?>