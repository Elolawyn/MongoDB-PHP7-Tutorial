<?php 
	require_once 'lib_php/include.php';
	
	try {
		$posts = json_decode(json_encode(get_posts()), true);
		
	} catch (Exception $e) {
		echo $e->getMessage();
		die();
	}
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta name='description' content='Web page to test MongoDB with Apache and PHP'>
		<meta name='author' content='Raúl Arroyo'>
		<link rel='icon' href='../../favicon.ico'>
		<title>MongoDB - Example</title>
		<!-- Bootstrap 3.3.7 -->
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
			<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
		<![endif]-->
		<style type=''>
			body {
				padding-top: 50px;
			}
			
			#blog p {
				text-align: justify;
				text-justify: inter-word;
			}
			
			#blog .bold {
				font-weight: bold;
			}
			
			.comments {
				margin-right: 0px;
				margin-left: 0px;
			}
			
			.row-comment-content {
				margin-right: 0px;
				margin-left: 0px;
			}
		</style>
	</head>
	<body>
		<!-- Header -->
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container'>
				<div class='navbar-header'>
					<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a class='navbar-brand' href='#'>MongoDB - Example</a>
				</div>
				<div id='navbar' class='collapse navbar-collapse'></div>
			</div>
		</nav>
		<!-- End Header -->
		<!-- Content -->
		<div class='container'>
			<div>
				<div class='row'>
					<div class='col-md-8' id='blog'>
						<?php if (count($posts) > 0): ?>
							<?php echo generate_posts($posts) ?>
						<?php else: ?>
							<h1>No posts</h1>
						<?php endif; ?>
					</div>
					<div class='col-md-4'>
						<h1>Add post</h1>
						<div class='form-group'>
							<label for='title_post'>Title</label>
							<input type='text' name='title_post' class='form-control' id='title_post'>
						</div>
						<div class='form-group'>
							<label for='author_post'>Author</label>
							<input type='text' name='author_post' class='form-control' id='author_post'>
						</div>
						<div class='form-group'>
							<label for='content_post'>Content</label>
							<input type='text' name='content_post' class='form-control' id='content_post'>
						</div>
						<button id='add_post' type='button' class='btn btn-primary'>Add post</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
		<!-- Modal Add Comment -->
		<div class="modal fade" id='modal_add_comment' role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add comment</h4>
					</div>
					<div class="modal-body">
						<div class='form-group'>
							<label for='content_comment'>Content</label>
							<input type='text' name='content_comment' class='form-control' id='content_comment'>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id='add_comment' class="btn btn-primary">Add comment</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Add Comment -->
		<!-- Modal Edit Post -->
		<div class="modal fade" id='modal_edit_post' role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit post</h4>
					</div>
					<div class="modal-body">
						<div class='form-group'>
							<label for='edit_title_post'>Title</label>
							<input type='text' name='edit_title_post' class='form-control' id='edit_title_post'>
						</div>
						<div class='form-group'>
							<label for='edit_author_post'>Author</label>
							<input type='text' name='edit_author_post' class='form-control' id='edit_author_post'>
						</div>
						<div class='form-group'>
							<label for='edit_content_post'>Content</label>
							<input type='text' name='edit_content_post' class='form-control' id='edit_content_post'>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id='edit_post' class="btn btn-primary">Edit post</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Edit Post -->
		<!-- Modal Edit Comment -->
		<div class="modal fade" id='modal_edit_comment' role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit comment</h4>
					</div>
					<div class="modal-body">
						<div class='form-group'>
							<label for='edit_content_comment'>Content</label>
							<input type='text' name='edit_content_comment' class='form-control' id='edit_content_comment'>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id='edit_comment' class="btn btn-primary">Edit comment</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Edit Comment -->
		<!-- jQuery 3.1.1 -->
		<script type='text/javascript' src='js/jquery.min.js'></script>
		<!-- Bootstrap 3.3.7 -->
		<script type='text/javascript' src='js/bootstrap.min.js'></script>
		<script type='text/javascript'>
			$(document).ready(function() {
				// Open add comment modal
				$(document).on('click', '.add_comment', function() {
					var id_post = $(this).parents(".post").attr("data-id");
					$('#add_comment').attr("data-id-post", id_post);
					$('#modal_add_comment').modal('show');
				});
				
				// Open edit post modal
				$(document).on('click', '.edit_post', function() {
					var id_post = $(this).parents(".post").attr("data-id");
					var title_post = $(this).parents(".post").find(".title").text();
					var author_post = $(this).parents(".post").find(".author").text();
					var content_post = $(this).parents(".post").find(".content").text();
					$('#edit_post').attr("data-id-post", id_post);
					$('#edit_title_post').val(title_post);
					$('#edit_author_post').val(author_post);
					$('#edit_content_post').val(content_post);
					$('#modal_edit_post').modal('show');
				});
				
				// Open edit comment modal
				$(document).on('click', '.edit_comment', function() {
					var id_post = $(this).parents(".post").attr("data-id");
					var id_comment = $(this).parents(".comment").attr("data-id");
					var content_comment = $(this).parents(".comment").find(".comment_content").text();
					$('#edit_comment').attr("data-id-post", id_post);
					$('#edit_comment').attr("data-id-comment", id_comment);
					$('#edit_content_comment').val(content_comment);
					$('#modal_edit_comment').modal('show');
				});
				
				// Add post
				$('#add_post').click(function() {
					var title_post = $('#title_post').val();
					var author_post = $('#author_post').val();
					var content_post = $('#content_post').val();
					
					$.post({
						url: "<?php echo Config::SERVICIO_ADD_POST ?>",
						dataType: 'json',
						data: {
							title: title_post,
							author: author_post,
							content: content_post
						},
						timeout: 5000,
						success: function (resultado) {
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
				
				// Add comment to post
				$('#add_comment').click(function() {
					var id_post = $(this).attr("data-id-post");
					var content_comment = $('#content_comment').val();
					
					$.post({
						url: "<?php echo Config::SERVICIO_ADD_COMMENT ?>",
						dataType: 'json',
						data: {
							id: id_post,
							comment: content_comment
						},
						timeout: 5000,
						success: function (resultado) {
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
				
				// Edit post
				$('#edit_post').click(function() {
					var id_post = $(this).attr("data-id-post");
					var title = $('#edit_title_post').val();
					var author = $('#edit_author_post').val();
					var content = $('#edit_content_post').val();
					
					$.post({
						url: "<?php echo Config::SERVICIO_EDIT_POST ?>",
						dataType: 'json',
						data: {
							id: id_post,
							title: title,
							author: author,
							content: content
						},
						timeout: 5000,
						success: function (resultado) {
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
				
				// Edit comment
				$('#edit_comment').click(function() {
					var id_post = $(this).attr("data-id-post");
					var id_comment = $(this).attr("data-id-comment");
					var content = $('#edit_content_comment').val();
					
					$.post({
						url: "<?php echo Config::SERVICIO_EDIT_COMMENT ?>",
						dataType: 'json',
						data: {
							id_post: id_post,
							id_comment: id_comment,
							comment: content
						},
						timeout: 5000,
						success: function (resultado) {
							console.log(resultado);
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
				
				// Delete post
				$(document).on('click', '.delete_post', function() {
					var id_post = $(this).parents(".post").attr("data-id");
					
					$.post({
						url: "<?php echo Config::SERVICIO_DELETE_POST ?>",
						dataType: 'json',
						data: {
							id: id_post
						},
						timeout: 5000,
						success: function (resultado) {
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
				
				// Delete comment from post
				$(document).on('click', '.delete_comment', function() {
					var id_post = $(this).parents(".post").attr("data-id");
					var id_comment = $(this).parents(".comment").attr("data-id");
					
					$.post({
						url: "<?php echo Config::SERVICIO_DELETE_COMMENT ?>",
						dataType: 'json',
						data: {
							id_post: id_post,
							id_comment: id_comment
						},
						timeout: 5000,
						success: function (resultado) {
							if (resultado["respuesta"] === "OK") {
								location.reload();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR);
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
				});
			});
		</script>
	</body>
</html>