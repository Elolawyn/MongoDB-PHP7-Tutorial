<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['title']) && $_POST['title'] != '') {
			if (isset($_POST['author']) && $_POST['author'] != '') {
				if (isset($_POST['content']) && $_POST['content'] != '') {
					try {
						if (bd_add_post($_POST['title'], $_POST['author'], $_POST['content'])) {
							$resultado['respuesta'] = 'OK';
							$resultado['mensaje'] = 'Post inserted';
						} else {
							$resultado['respuesta'] = 'ERROR';
							$resultado['mensaje'] = 'No post inserted';
						}
					} catch (Exception $e) {
						$resultado['respuesta'] = 'ERROR';
						$resultado['mensaje'] = $e->getMessage();
					}
				} else {
					$resultado['respuesta'] = 'ERROR';
					$resultado['mensaje'] = 'No content';
				}
			} else {
				$resultado['respuesta'] = 'ERROR';
				$resultado['mensaje'] = 'No author';
			}
		} else {
			$resultado['respuesta'] = 'ERROR';
			$resultado['mensaje'] = 'No title';
		}
	} else {
		$resultado['respuesta'] = 'ERROR';
		$resultado['mensaje'] = 'No POST method';
	}
	
	echo json_encode($resultado);
	die();
?>