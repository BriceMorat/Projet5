<?php
namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class CommentManager

* Used to get, add and delete comments

**/

class CommentManager extends Manager {

	/**

	* @param $postId integer 

	* return string

	**/
	public function getComments(int $postId) {
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(date_comments, \'%d/%m/%Y à %H:%i\') AS date_fra FROM comment WHERE post_id = ? ORDER BY date_comments DESC');
		$comments->execute([$postId]);

		return $comments;
	}

	/**

	* @param $postId integer 

	* @param $author string 

	* @param $content string 

	* return string

	**/
	public function addComments(int $postId, string $author, string $content) {
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comment(post_id, author, content, date_comments) VALUES(?, ?, ?, NOW())');
		$affectedLines = $comments->execute([$postId, $author, $content]);

		return $affectedLines;
	}

	/**

	* @param $commentId integer 

	* return string

	**/
	public function deleteComments(int $commentId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE id = ?');
		$deletedComments = $req->execute([$commentId]);

		return $deletedComments;
	}
}