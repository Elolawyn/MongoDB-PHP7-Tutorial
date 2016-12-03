<?php
	// Get posts list
	function get_posts() {	
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$query = new MongoDB\Driver\Query([], []);

		$cursor = $mongo->executeQuery('db_prueba_blog.posts', $query);

		$posts = [];
		
		foreach ($cursor as $document) {
			array_push($posts, json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($document))));
		}
		
		return $posts;
	}
	
	// Delete post
	function bd_delete_post($id) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$id = new MongoDB\BSON\ObjectID($id);
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->delete(
			['_id'		=> $id],
			['limit'	=> 1]
		);
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getDeletedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// Delete comment
	function bd_delete_comment($id_post, $id_comment) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$id_post = new MongoDB\BSON\ObjectID($id_post);
		$id_comment = new MongoDB\BSON\ObjectID($id_comment);
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update(
			[	'_id'	=> $id_post],
			[	'$pull' => [
					'comments' => [
						'_id' => $id_comment
					]
				]
			],
			[	'multi'		=> false,
				'upsert'	=> false
			]
		);
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getModifiedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// Edit post
	function bd_edit_post($id, $title, $author, $content) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$id = new MongoDB\BSON\ObjectID($id);
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update(
			[	'_id'	=> $id],
			[	'$set'	=> [
					'title'		=> $title,
					'author'	=> $author,
					'content'	=> $content
				]
			],
			[	'multi'		=> false,
				'upsert'	=> false
			]
		);
		
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getModifiedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// Edit comment
	function bd_edit_comment($id_post, $id_comment, $comment) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$id_post = new MongoDB\BSON\ObjectID($id_post);
		$id_comment = new MongoDB\BSON\ObjectID($id_comment);
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update(
			[	'_id'	=> $id_post,
				'comments._id' => $id_comment
			],
			[	'$set'	=> ['comments.$.comment' => $comment]],
			[	'multi'		=> false,
				'upsert'	=> false
			]
		);
		
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getModifiedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}

	// Add post
	function bd_add_post($title, $author, $content) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert([
			'title'		=> $title,
			'author'	=> $author,
			'content'	=> $content,
			'comments'	=> []
		]);
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getInsertedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// Add comment
	function bd_add_comment($id_post, $comment) {
		$mongo = new MongoDB\Driver\Manager(Config::MONGODB);
		
		$id = new MongoDB\BSON\ObjectID($id_post);
		
		$bulk = new MongoDB\Driver\BulkWrite;
		
		$bulk->update(
			[	'_id'	=> $id],
			[	'$push'	=> [
					'comments' => [
						'_id'		=> new MongoDB\BSON\ObjectID,
						'comment'	=> $comment
					]
				]
			],
			[	'multi'		=> false,
				'upsert'	=> false
			]
		);
		
		$result = $mongo->executeBulkWrite('db_prueba_blog.posts', $bulk);
		
		if ($result->getModifiedCount() >= 1) {
			return true;
		} else {
			return false;
		}
	}
?>