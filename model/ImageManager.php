<?php
namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class PostManager

* Used to get, create, update and delete posts

**/

class ImageManager extends Manager {

	/**

	* @param $authorId integer

	* @param $filename string

	* return string

	**/ 
	public function addImage(int $authorId, string $filename) {
		$db = $this->dbConnect();
		
		$req = $db->prepare('INSERT INTO image(post_id, author_id, file_name) VALUES ((SELECT MAX(id) FROM post), ?, ?)');

		$newImage = $req->execute([$authorId, $filename]);

		return $newImage;
	}

	/**

	* @param $imageId integer

	* @param $userId integer

	* return integer

	**/ 
	public function recordImageLikes($imageId, $userId) {
		$db = $this->dbConnect();
		
		$req = $db->prepare('INSERT INTO liked_img(image_id, user_id) VALUES (?, ?)');

		$nbLikedImg = $req->execute([$imageId, $userId]);

		return $nbLikedImg;
	}

	public function getNbImgLikes() {
		$db = $this->dbConnect();

		$nbImgLikes = $db->query('SELECT COUNT(image_id) AS img_likes, file_name FROM liked_img INNER JOIN image ON liked_img.image_id = image.id GROUP BY image_id ORDER BY img_likes DESC LIMIT 10');

		return $nbImgLikes;
	}

	/**

	* @param $postId integer

	* @param $authorId integer

	* @param $filename string

	* return string

	**/ 
	public function updateImage(int $postId, int $authorId, string $filename) {
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO image(post_id, author_id, file_name) VALUES (?, ?, ?)');
		$updatedImage = $req->execute([$postId, $authorId, $filename]);

		return $updatedImage;
	}


	/**

	* @param $postId integer 

	* return string

	**/
	public function getPostImages(int $postId) {
		$db = $this->dbConnect();
		$postImages = $db->prepare('SELECT * FROM image INNER JOIN post ON image.post_id = post.id WHERE post_id = ?');
		$postImages->execute([$postId]);

		return $postImages;
	}

	/**

	* @param $authorId integer 

	* return string

	**/
	public function getUserPostImages(int $authorId) {
	$db = $this->dbConnect();
	$userPostImages = $db->prepare('SELECT * FROM image INNER JOIN post ON image.post_id = post.id WHERE image.author_id = ?');
	$userPostImages->execute([$authorId]);

	return $userPostImages;
	}

	public function getUserImages(int $postId) {
		$db = $this->dbConnect();
		$userImages = $db->prepare('SELECT * FROM image WHERE image.post_id = ?');
		$userImages->execute([$postId]);

		return $userImages;
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

	/**
	
	* @param $imageId integer

	* return string

	**/
	public function deleteImage(int $imageId) {
		$db = $this->dbConnect();

		$request = $db->prepare('SELECT file_name FROM image WHERE id = ?');

		$request->execute([$imageId]);
		$fileNames = $request->fetch(\PDO::FETCH_ASSOC);

		foreach ($fileNames as $fileName):
			unlink("public/upload_img/".$fileName);
		endforeach;

		$req = $db->prepare('DELETE FROM image WHERE id = ?');
		$deletedImage = $req->execute([$imageId]);

		return $deletedImage;
	}

}


