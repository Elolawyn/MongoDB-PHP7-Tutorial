<?php
	// Return post HTML
	function generate_post($post) {
		$post_id = $post["_id"]['$oid'];
		$post_title = $post["title"];
		$post_author = $post["author"];
		$post_content = $post["content"];
		$post_comments = $post["comments"];
		
		$html = "";
		$html = $html . "<div class='post' data-id='" . $post_id . "'>";
		$html = $html . "<h1 class='title'>" . $post_title . "</h1>";
		$html = $html . "<p class='bold'>Author: <span class='author'>" . $post_author . "</span></p>";
		$html = $html . "<p class='content'>" . $post_content . "</p>";
		$html = $html . "<div class='row'>";
		$html = $html . "<div class='col-md-3'>";
		$html = $html . "<button type='button' class='btn btn-info btn-block edit_post'>Edit post</button></p>";
		$html = $html . "</div>";
		$html = $html . "<div class='col-md-3'>";
		$html = $html . "<button type='button' class='btn btn-danger btn-block delete_post'>Delete post</button></p>";
		$html = $html . "</div>";
		$html = $html . "<div class='col-md-6'>";
		$html = $html . "<button type='button' class='btn btn-primary btn-block add_comment'>Add comment</button></p>";
		$html = $html . "</div>";
		$html = $html . "</div>";
		$html = $html . "<br>";
		$html = $html . "<div class='row comments'>";
		$html = $html . generate_comments($post_comments);
		$html = $html . "</div>";
		$html = $html . "<hr>";
		$html = $html . "</div>";
		
		return $html;
	}
	
	// Return comment HTML
	function generate_comment($comment) {
		$comment_id = $comment['_id']['$oid'];
		$comment_content = $comment['comment'];
		
		$html = "";
		$html = $html . "<div class='row comment' data-id='" . $comment_id . "'>";
		$html = $html . "<div class='col-md-2 col-md-offset-2'>";
		$html = $html . "<img src='img/user.png' alt='User' class='img-thumbnail'>";
		$html = $html . "</div>";
		$html = $html . "<div class='col-md-8'>";
		$html = $html . "<div class='row row-comment-content'>";
		$html = $html . "<p class='comment_content'>" . $comment_content . "</p>";
		$html = $html . "</div>";
		$html = $html . "<div class='row'>";
		$html = $html . "<div class='col-md-6'>";
		$html = $html . "<p><button type='button' class='btn btn-danger btn-block delete_comment'>Delete comment</button></p>";
		$html = $html . "</div>";
		$html = $html . "<div class='col-md-6'>";
		$html = $html . "<p><button type='button' class='btn btn-info btn-block edit_comment'>Edit comment</button></p>";
		$html = $html . "</div>";
		$html = $html . "</div>";
		$html = $html . "</div>";
		$html = $html . "</div>";
		
		return $html;
	}
	
	// Return comments HTML
	function generate_comments($comments) {
		$html = "";
		foreach ($comments as $comment) {
			$html = $html . generate_comment($comment);
		}
		return $html;
	}
	
	// Return blog HTML
	function generate_posts($posts) {
		$html = "";
		foreach ($posts as $post) {
			$html = $html . generate_post($post);
		}
		return $html;
	}
?>