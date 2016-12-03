<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['id']) && $_POST['id'] != '') {
			try {
				if (bd_delete_post($_POST['id'])) {
					$resultado['respuesta'] = 'OK';
					$resultado['mensaje'] = 'Post deleted';
				} else {
					$resultado['respuesta'] = 'OK';
					$resultado['mensaje'] = 'No post deleted';
				}
			} catch (Exception $e) {
				$resultado['respuesta'] = 'ERROR';
				$resultado['mensaje'] = $e->getMessage();
			}
		} else {
			$resultado['respuesta'] = 'ERROR';
			$resultado['mensaje'] = 'No post selected';
		}
	} else {
		$resultado['respuesta'] = 'ERROR';
		$resultado['mensaje'] = 'No POST method';
	}
	
	echo json_encode($resultado);
	die();
?>