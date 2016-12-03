<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['id_post']) && $_POST['id_post'] != '') {
			if (isset($_POST['id_comment']) && $_POST['id_comment'] != '') {
				try {
					if (bd_delete_comment($_POST['id_post'], $_POST['id_comment'])) {
						$resultado['respuesta'] = 'OK';
						$resultado['mensaje'] = 'Comment deleted';
					} else {
						$resultado['respuesta'] = 'OK';
						$resultado['mensaje'] = 'No comment deleted';
					}
				} catch (Exception $e) {
					$resultado['respuesta'] = 'ERROR';
					$resultado['mensaje'] = $e->getMessage();
				}
			} else {
				$resultado['respuesta'] = 'ERROR';
				$resultado['mensaje'] = 'No comment selected';
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