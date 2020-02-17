<?php

namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class Pagination

* Used to get posts pagination according to post number and posts per page

**/

class Pagination extends Manager {

	public function getPostsPagination() {
		$db = $this->dbConnect();
		$totalPosts = $db->query('SELECT COUNT(id) AS posts_nb FROM post');

		return $totalPosts->fetch()['posts_nb'];
	}

	/**

	* @param $postsNb integer 

	* @param $postsPerPage integer 

	* return integer

	**/

	public function getPostsPages($postsNb, $postsPerPage) {
		$pageNb = ceil($postsNb/$postsPerPage);

		return $pageNb;
	}
}