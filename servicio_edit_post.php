<?php
	require_once 'lib_php/include.php';
	
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['id']) && $_POST['id'] != '') {
			if (isset($_POST['title']) && $_POST['title'] != '') {
				if (isset($_POST['author']) && $_POST['author'] != '') {
					if (isset($_POST['content']) && $_POST['content'] != '') {
						try {
							if (bd_edit_post($_POST['id'], $_POST['title'], $_POST['author'], $_POST['content'])) {
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
			$resultado['mensaje'] = 'No post selected';
		}
	} else {
		$resultado['respuesta'] = 'ERROR';
		$resultado['mensaje'] = 'No POST method';
	}
	
	echo json_encode($resultado);
	die();
?>