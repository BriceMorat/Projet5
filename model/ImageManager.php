<?php
namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class PostManager

* Used to get, create, update and delete posts

**/

class ImageManager extends Manager {

	/**

	* @param $author_id integer

	* @param $filename string

	* return string

	**/ 
	public function addImage(int $author_id, $filename) {
		$db = $this->dbConnect();
		
		$req = $db->prepare('INSERT INTO image(post_id, author_id, file_name) VALUES ((SELECT MAX(id) FROM post), ?, ?)');

		$newImage = $req->execute([$author_id, $filename]);

		return $newImage;
	}

	public function recordImageLikes($imageId, $userId) {
		$db = $this->dbConnect();
		
		$req = $db->prepare('INSERT INTO liked_img(image_id, user_id) VALUES (?, ?)');

		$nbLikedImg = $req->execute([$imageId, $userId]);

		return $nbLikedImg;
	}

	public function getNbImgLikes() {
		$db = $this->dbConnect();

		$nbImgLikes = $db->query('SELECT COUNT(image_id) AS img_likes, file_name FROM liked_img INNER JOIN image ON liked_img.image_id = image.id GROUP BY image_id ASC LIMIT 10');

		return $nbImgLikes;
	}

	public function updateImage($filename, $postId) {
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE image SET file_name = ? WHERE post_id = ?');
		$updatedImage = $req->execute([$filename, $postId]);

		return $updatedImage;
	}


	/**

	* @param $postId integer 

	* return string

	**/
	public function getPostImages($postId) {
		$db = $this->dbConnect();
		$postImages = $db->prepare('SELECT * FROM image INNER JOIN post ON image.post_id = post.id WHERE post_id = ?');
		$postImages->execute([$postId]);

		return $postImages;
	}

	/**

	* @param $authorId integer 

	* return string

	**/
	public function getUserPostImages($authorId) {
	$db = $this->dbConnect();
	$userPostImages = $db->prepare('SELECT * FROM image INNER JOIN post ON image.post_id = post.id WHERE image.author_id = ?');
	$userPostImages->execute([$authorId]);

	return $userPostImages;
	}

	public function getImages() {
		$db = $this->dbConnect();
		$images = $db->query('SELECT COUNT(*) AS images_nb, file_name FROM image INNER JOIN post ON image.post_id = post.id GROUP BY post_id ORDER BY images_nb DESC');

		return $images;
	}

	public function getMarkerImages() {
		$db = $this->dbConnect();
		$markerImages = $db->query('SELECT image.id, post_id, file_name, title, country, city, author FROM image INNER JOIN post ON image.post_id = post.id');
		
		return $markerImages;
	}

	public function getAutoSliderMapImages() {
		$db = $this->dbConnect();
		$autoSliderMapImages = $db->query('SELECT post_id, file_name, title, country, city, author FROM image INNER JOIN post ON image.post_id = post.id LIMIT 20');
	
		return $autoSliderMapImages;
	}

	public function getSliderMapImages() {
		$db = $this->dbConnect();
		$sliderMapImages = $db->query('SELECT image.id, post_id, file_name, title, country, city, author, date_creation FROM image INNER JOIN post ON image.post_id = post.id LIMIT 20');
	
		return $sliderMapImages;
	}

}


