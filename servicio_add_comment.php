<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['id']) && $_POST['id'] != '') {
			if (isset($_POST['comment']) && $_POST['comment'] != '') {
				try {
					if (bd_add_comment($_POST['id'], $_POST['comment'])) {
						$resultado['respuesta'] = 'OK';
						$resultado['mensaje'] = 'Post updated';
					} else {
						$resultado['respuesta'] = 'ERROR';
						$resultado['mensaje'] = 'No post updated';
					}
				} catch (Exception $e) {
					$resultado['respuesta'] = 'ERROR';
					$resultado['mensaje'] = $e->getMessage();
				}
			} else {
				$resultado['respuesta'] = 'ERROR';
				$resultado['mensaje'] = 'No comment content';
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