<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		try {
			$resultado['posts'] = get_posts();
			$resultado['respuesta'] = 'OK';
		} catch (Exception $e) {
			$resultado['respuesta'] = 'ERROR';
			$resultado['mensaje'] = $e->getMessage();
		}
	} else {
		$resultado['respuesta'] = 'ERROR';
		$resultado['mensaje'] = 'No Get method';
	}
	
	echo json_encode($resultado);
	die();
?>