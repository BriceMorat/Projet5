<?php

namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class LatLngManager

* Used to add and get Lat and Lng

**/
class LatLngManager extends Manager {

	/**

	* @param $lat float 

	* @param $lng float 

	* return float

	**/
	public function addLatLng(float $lat, float $lng) {
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO latlng(post_id, lat, lng) VALUES ((SELECT MAX(id) FROM post), ?, ?)');

		$newLatLng = $req->execute([$lat, $lng]);

		return $newLatLng;	
	}

	public function getLatLng() {
		$db = $this->dbConnect();
		$latLngList = $db->query('SELECT * FROM latlng INNER JOIN image ON latlng.post_id = image.post_id');

		return $latLngList;
	}

}