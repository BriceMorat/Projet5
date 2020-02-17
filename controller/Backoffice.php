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

	* @param $author_id integer

	**/
	public function listPostsByUser(int $author_id) {
		$postManager = new PostManager();

		$postsByUser = $postManager->getPostsByUser($author_id);
		
		require('view/backoffice/dashBoardView.php');
	}

	public function displayCreatePost() {
		require('view/backoffice/createPostView.php');
	}

	public function displayAdmin() {
		$postManager = new PostManager();
		$imageManager = new ImageManager();
		$reportManager = new ReportManager();
		$memberManager = new MemberManager();
		$pagination = new Pagination();

		$postsPerPage = 3;

		$postsNb = $pagination->getPostsPagination();
		$pageNb = $pagination->getPostsPages($postsNb, $postsPerPage);

		if (!isset($_GET['page'])) {
			$currentPage = 0;
		} elseif (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageNb) {
			$currentPage = (intval($_GET['page']) - 1) * $postsPerPage;
		}

		$posts = $postManager->getPosts($currentPage, $postsPerPage);

		$images = $imageManager->getImages();

		$reports = $reportManager->getReports();

		$members = $memberManager->getMembers();
		
		require('view/backoffice/adminView.php');
	}

	/**

	* @param $title string

	* @param $country string
	
	* @param $city string

	* @param $content string

	* @param $author_id integer

	* @param $author string

	**/
	public function newPost(string $title, string $country, string $city, string $content, int $author_id, string $author) {
		$postManager = new PostManager();

		$newPost = $postManager->createPost($title, $country, $city, $content, $author_id, $author);

		header('Location: index.php?action=dashBoard&new-post=success');
	}


	/**

	* @param $filename string

	**/
	public function newImage(int $author_id, $filename) {

		$imageManager = new ImageManager();

 		$countfiles = count($_FILES['userFiles']['name']);

 		for ($i=0; $i<$countfiles; $i++) {
  			$filename = $_FILES['userFiles']['name'][$i];

			$imageFileType = strtolower(pathinfo('public/upload_img/'.$filename, PATHINFO_EXTENSION));

  			$extensions_arr = array("jpg","jpeg","png");

  			if (in_array($imageFileType, $extensions_arr)) {

  				$newImage = $imageManager->addImage($author_id, $filename);

  				move_uploaded_file($_FILES['userFiles']['tmp_name'][$i], 'public/upload_img/'.$filename);
  			}
 		}

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

		// $reCaptcha = $memberManager->getReCaptcha($_POST['g-recaptcha-response']);

		// if ($reCaptcha->success == true) {
			
		$psw = password_hash($_POST['psw'], PASSWORD_DEFAULT);

		$updatedPsw = $memberManager->updateMemberPsw($psw);

		header('Location: index.php?action=dashBoard&password-successfully-updated');

		
		// } else {
		// 	header('Location: index.php?action=registration&error=google-recaptcha');
		// }
	}




	public function displayUpdatePost() {
		$postManager = new PostManager();

		$post = $postManager->getPost($_GET['id']);

		require('view/backoffice/updatePostView.php');
	}

	/**

	* @param $title string

	* @param $content string

	* @param $postId integer

	**/
	public function submitUpdatePost(string $title, string $content, int $postId) {
		$postManager = new PostManager();

		$updatedPost = $postManager->updatePost($title, $content, $postId);

		header('Location: index.php?action=dashBoard&update-post=success');
	}

	/**

	* @param $postId integer

	* @param $filename string

	**/
	public function submitUpdateImage($filename, $postId) {
		$imageManager = new ImageManager();

 		$countfiles = count($_FILES['userFiles']['name']);

 		for ($i=0; $i<$countfiles; $i++) {
  			$filename = $_FILES['userFiles']['name'][$i];

			$imageFileType = strtolower(pathinfo('public/img/'.$filename, PATHINFO_EXTENSION));

  			$extensions_arr = array("jpg","jpeg","png","gif");

  			if (in_array($imageFileType, $extensions_arr)) {

  				$updatedImage = $imageManager->updateImage($filename, $postId);

  				move_uploaded_file($_FILES['userFiles']['tmp_name'][$i], 'public/img/'.$filename);
  			}
 		}
	}

	/**

	* @param $imageId integer

	* @param $userId integer

	**/
	public function addImgLikes($imageId, $userId) {
		$imageManager = new ImageManager();
		
		$nbLikedImg = $imageManager->recordImageLikes($imageId, $userId);
	}


	/**

	* @param $postId integer

	**/
	public function removePost(int $postId) {
		$postManager = new PostManager();

		$deletedPost = $postManager->deletePost($postId);

		header('Location: index.php?action=remove-post=success');
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

