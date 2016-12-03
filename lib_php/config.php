<?php
	class Config {
		// BD connection
		const MONGODB					= "mongodb://localhost:27017";
		
		// Services
		const SERVICIO_ADD_POST			= "http://192.168.1.36/pruebamongodb/servicio_add_post.php";
		const SERVICIO_EDIT_POST		= "http://192.168.1.36/pruebamongodb/servicio_edit_post.php";
		const SERVICIO_ADD_COMMENT		= "http://192.168.1.36/pruebamongodb/servicio_add_comment.php";
		const SERVICIO_EDIT_COMMENT		= "http://192.168.1.36/pruebamongodb/servicio_edit_comment.php";
		const SERVICIO_DELETE_POST		= "http://192.168.1.36/pruebamongodb/servicio_delete_post.php";
		const SERVICIO_DELETE_COMMENT	= "http://192.168.1.36/pruebamongodb/servicio_delete_comment.php";
		const SERVICIO_RELOAD_POSTS		= "http://192.168.1.36/pruebamongodb/servicio_reload_posts.php";
	}
?>