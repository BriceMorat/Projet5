<?php
namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class PostManager

* Used to get, create, update and delete posts

**/
class PostManager extends Manager {

	/**

	* @param $title string

	* @param $country string

	* @param $city string

	* @param $content string

	* @param $author_id integer

	* @param $author string

	* return string

	**/
	public function createPost(string $title, string $country, string $city, string $content, int $author_id, string $author) {
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO post(post.title, country, city, content, post.author_id, author, date_creation, date_update) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())');
		$newPost = $req->execute([$title, $country, $city, $content, $author_id, $author]);

		return $newPost;	
	}


	/**

	* @param $title string

	* @param $content string

	* @param $postId integer

	* return string

	**/
	public function updatePost(string $title, string $content, int $postId) {
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE post SET title = ?, content = ?, date_update = NOW() WHERE id = ?');
		$updatedPost = $req->execute([$title, $content, $postId]);

		return $updatedPost;
	}

	/**
	
	* @param $postId integer

	* return string

	**/
	public function deletePost(int $postId) {
		$db = $this->dbConnect();
		$img = $db->prepare('DELETE FROM image WHERE post_id = '.$postId.'');
		$comment = $db->prepare('DELETE FROM comment WHERE post_id = '.$postId.'');
		if ($img->execute() && $comment->execute()) {
			$request = $db->prepare('DELETE FROM post WHERE id = ? LIMIT 1');
			$deletedPost = $request->execute([$postId]);

			return $deletedPost;
		}
	}

	/**

	* @param $id integer 

	* return string

	**/
	public function getPost(int $id) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, country, city, content, post.author_id, author, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr FROM post WHERE id = ?');
		$req->execute([$id]);
		$post = $req->fetch(\PDO::FETCH_ASSOC);

		return $post;
	}
	
	/**

	* @param $currentPage integer 

	* @param $postsPerPage integer 

	* return string

	**/
	public function getPosts(int $currentPage, int $postsPerPage) {
		$db = $this->dbConnect();
		$posts = $db->query('SELECT post.id, title, country, city, content, post.author_id, author, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr, image.file_name FROM post INNER JOIN image ON post.id = image.post_id GROUP BY image.post_id ORDER BY post.date_creation DESC LIMIT '.$currentPage.','.$postsPerPage.'');

		return $posts;
	}

	public function getRecentPosts() {
		$db = $this->dbConnect();
		$recentPosts = $db->query('SELECT post.id, title, country, city, content, post.author_id, author, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr, image.file_name FROM post INNER JOIN image ON post.id = image.post_id GROUP BY image.post_id ORDER BY post.date_creation DESC LIMIT 5');

		return $recentPosts;
	}


	/**

	* @param $id integer 

	* return string

	**/
	public function getPostsByUser(int $id) {
		$db = $this->dbConnect();
		$postsByUser = $db->prepare('SELECT id, title, country, city, content, post.author_id, author, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr FROM post WHERE author_id = ? ORDER BY date_creation DESC');
		$postsByUser->execute([$id]);

		return $postsByUser;
	}
}


