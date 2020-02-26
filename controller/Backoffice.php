<?php 

use Projet5\Model\Manager;
use Projet5\Model\PostManager;
use Projet5\Model\ImageManager;
use Projet5\Model\MemberManager;
use Projet5\Model\CommentManager;
use Projet5\Model\ReportManager;
use Projet5\Model\Pagination;
use Projet5\Model\LatLngManager;

require_once('Controller.php');


/** 

* Class BackofficeController

* Used to recover model classes data to send it into back office views

**/

class BackofficeController extends Controller {

	/**

	* @param $authorId integer

	**/
	public function listPostsByUser(int $authorId) {
		$postManager = new PostManager();

		$postsByUser = $postManager->getPostsByUser($authorId);
		
		require('view/backoffice/dashBoardView.php');
	}

	public function displayCreatePost() {
		require('view/backoffice/createPostView.php');
	}

	public function displayAdmin() {
		$postManager = new PostManager();
		$reportManager = new ReportManager();
		$memberManager = new MemberManager();
		$pagination = new Pagination();

		$postsPerPage = 3;

		$postsNb = $pagination->getPostsPagination();
		$pageNb = $pagination->getPostsPages($postsNb, $postsPerPage);

		if (!isset($_GET['page'])):
			$currentPage = 0;
		elseif (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageNb):
			$currentPage = (intval($_GET['page']) - 1) * $postsPerPage;
		
		endif;

		$posts = $postManager->getPosts($currentPage, $postsPerPage);

		$reports = $reportManager->getReports();

		$members = $memberManager->getMembers();
		
		require('view/backoffice/adminView.php');
	}

	/**

	* @param $title string

	* @param $country string
	
	* @param $city string

	* @param $content string

	* @param $authorId integer

	* @param $author string

	**/
	public function newPost(string $title, string $country, string $city, string $content, int $authorId, string $author) {
		$postManager = new PostManager();

		Controller::valid_data($_POST['title']);
		Controller::valid_data($_POST['country']);
		Controller::valid_data($_POST['city']);
		Controller::valid_data($_POST['content']);

		$newPost = $postManager->createPost($title, $country, $city, $content, $authorId, $author);

		header('Location: index.php?action=dashBoard&new-post=success');
	}


	/**

	* @param $authorId integer

	* @param $filenames array

	**/
	public function newImage(int $authorId, array $filenames) {

		$imageManager = new ImageManager();

 		$countFiles = count($filenames);

 		for ($i=0; $i<$countFiles; $i++):
  			$filename = $filenames[$i];

			$imageFileType = strtolower(pathinfo('public/upload_img/'.$filename, PATHINFO_EXTENSION));

  			$extensions = ["jpg","jpeg","png"];

  			if (in_array($imageFileType, $extensions)):

  				move_uploaded_file($_FILES['userFiles']['tmp_name'][$i], 'public/upload_img/'.$filename);

  				$newImage = $imageManager->addImage($authorId, $filename);

  			endif;

 		endfor;
  	}

	/**

	* @param $lat float

	* @param $lng float

	**/
  	public function newLatLng(float $lat, float $lng) {
  		$latLngManager = new LatLngManager();

  		$newLatLng = $latLngManager->addLatLng($lat, $lng);
  	}

	/**

	* @param $psw string

	**/
  	public function updatePassword(string $psw) {
		$memberManager = new MemberManager();

		if ($_POST['psw'] === $_POST['psw_confirm']):

			Controller::valid_data($_POST['psw']);
			$psw = password_hash($_POST['psw'], PASSWORD_DEFAULT);

			$updatedPsw = $memberManager->updateMemberPsw($psw);

			header('Location: index.php?action=dashBoard&password-successfully-updated');

		else:
			throw new Exception('Les deux mots de passe ne correspondent pas.');
					
		endif;
	}

	public function displayUpdatePost() {
		$postManager = new PostManager();
		$imageManager = new ImageManager();

		$post = $postManager->getPost($_GET['id']);
		$postImages = $imageManager->getPostImages($_GET['id']);
		$userImages = $imageManager->getUserImages($_GET['id']);

		require('view/backoffice/updatePostView.php');
	}

	/**

	* @param $title string

	* @param $content string

	* @param $postId integer

	**/
	public function submitUpdatePost(string $title, string $content, int $postId) {
		$postManager = new PostManager();

		Controller::valid_data($_POST['title']);
		Controller::valid_data($_POST['content']);

		$updatedPost = $postManager->updatePost($title, $content, $postId);

		header('Location: index.php?action=dashBoard&update-post=success');
	}

	/**

	* @param $postId integer

	* @param $authorId integer

	* @param $filenames array

	**/
	public function submitUpdateImage(int $postId, int $authorId, array $filenames) {
		$imageManager = new ImageManager();

 		$countFiles = count($filenames);

 		for ($i=0; $i<$countFiles; $i++):
  			$filename = $filenames[$i];

			$imageFileType = strtolower(pathinfo('public/upload_img/'.$filename, PATHINFO_EXTENSION));

  			$extensions = ["jpg","jpeg","png"];

  			if (in_array($imageFileType, $extensions)):

  				move_uploaded_file($_FILES['userFiles']['tmp_name'][$i], 'public/upload_img/'.$filename);

  				$updatedImage = $imageManager->updateImage($postId, $authorId, $filename);

  			endif;
 		
 		endfor;
	}

	/**

	* @param $imageId integer

	* @param $userId integer

	**/
	public function addImgLikes(int $imageId, int $userId) {
		$imageManager = new ImageManager();
		
		$nbLikedImg = $imageManager->recordImageLikes($imageId, $userId);
	}


	/**

	* @param $postId integer

	**/
	public function removePost(int $postId) {
		$postManager = new PostManager();

		$deletedPost = $postManager->deletePost($postId);

		if ($_SESSION['role'] === admin):
			header('Location: index.php?action=admin&remove-post=success');
		
		else:
			header('Location: index.php?action=dashBoard&remove-post=success');

		endif;
	}

	/**

	* @param $postId integer

	* @param $imageId integer

	**/
	public function removeImage(int $postId, int $imageId) {
		$imageManager = new ImageManager();

		$deletedImage = $imageManager->deleteImage($imageId);

		header('Location: index.php?action=updatePost&id='.$postId.'&imageId='.$imageId.'&remove-image=success');
	}

	/**

	* @param $commentId integer

	**/
	public function removeComment(int $commentId) {
		$commentManager = new CommentManager();

		$deletedComment = $commentManager->deleteComments($commentId);

		header('Location: index.php?action=admin&remove-comment=success');
	}

	/**

	* @param $reportId integer

	**/
	public function restoreComment(int $reportId) {
		$reportManager = new ReportManager();

		$deletedReport = $reportManager->deleteReports($reportId);

		header('Location: index.php?action=admin&restore-comment=success');
	}

	/**

	* @param $memberId integer

	**/
	public function removeMember(int $memberId) {
		$memberManager = new MemberManager();

		$deletedMember = $memberManager->deleteMember($memberId);

		header('Location: index.php?action=admin&remove-member=success');
	}
}

