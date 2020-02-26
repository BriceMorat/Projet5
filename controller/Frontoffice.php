<?php

use Projet5\Model\PostManager;
use Projet5\Model\ImageManager;
use Projet5\Model\MemberManager;
use Projet5\Model\CommentManager;
use Projet5\Model\ReportManager;
use Projet5\Model\Pagination;
use Projet5\Model\latLngManager;

require_once('Controller.php');


/** 

* Class FrontofficeController

* Used to recover model classes data to send it into front office views

**/

class FrontofficeController {

	public function listPosts() {
		$pagination = new Pagination();
		$postManager = new PostManager();
		
		$postsPerPage = 3;

		$postsNb = $pagination->getPostsPagination();
		$pageNb = $pagination->getPostsPages($postsNb, $postsPerPage);

		if (!isset($_GET['page'])):
			$currentPage = 0;
		elseif (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageNb):
			$currentPage = (intval($_GET['page']) - 1) * $postsPerPage;
		endif;

		$posts = $postManager->getPosts($currentPage, $postsPerPage);

		require('view/frontoffice/homeView.php');
	}


	public function listPost() {
		$postManager = new PostManager();
		$imageManager = new ImageManager();

		$commentManager = new CommentManager();
		$reportManager = new ReportManager();

		$post = $postManager->getPost($_GET['id']);


		if ($post):
			$postImages = $imageManager->getPostImages($_GET['id']);

			$comments = $commentManager->getComments($_GET['id']);

			$recentPosts = $postManager->getRecentPosts();


			if (!empty($_SESSION)):
				$idComment = $reportManager->getIdReport($_SESSION['id']);
			endif;

		else:
			header('Location: index.php');

		endif;
		
		require('view/frontoffice/postView.php');
	}

	public function listUserPostImages() {
		$imageManager = new ImageManager();
		$memberManager = new MemberManager();

		$userPostImages = $imageManager->getUserPostImages($_GET['authorId']);

		$member = $memberManager->getMember($_GET['authorId']);

		if ($userPostImages):
			$userPostImages = $imageManager->getUserPostImages($_GET['authorId']);

		else:
			header('Location: index.php');

		endif;

		require('view/frontoffice/userPostImagesView.php');
	}

	public function displayMap() {
		$latLngManager = new latLngManager;
		$imageManager = new ImageManager;

		$latLngList = $latLngManager->getLatLng();
		$markerImages = $imageManager->getMarkerImages();
		$autoSliderMapImages = $imageManager->getAutoSliderMapImages();
		$sliderMapImages = $imageManager->getSliderMapImages();

		$nbImgLikes = $imageManager->getNbImgLikes();
		

		require('view/frontoffice/mapView.php');	
	}

	public function displayRegistration() {
		require('view/frontoffice/registrationView.php');
	}

	/**

	* @param $pseudo string

	* @param $password string

	* @param $email string

	**/
	public function addMember(string $pseudo, string $password, string $email) {
		$memberManager = new MemberManager();

		$reCaptcha = $memberManager->getReCaptcha($_POST['g-recaptcha-response']);

		if ($reCaptcha->success == true) {
			$usernameValidity = $memberManager->checkPseudo($pseudo);
			$emailValidity = $memberManager->checkEmail($email);

			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
				if ($_POST['password'] === $_POST['password_confirm']):

					if (!$usernameValidity && !$emailValidity):
						Controller::valid_data($pseudo);
						Controller::valid_data($password);
						Controller::valid_data($email);

						$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

						$newMember = $memberManager->createMember($pseudo, $password, $email);

						header('Location: index.php?account-status=account-successfully-created');

					elseif ($usernameValidity):
						header('Location: index.php?action=registration&error=invalidUsername');

					elseif ($emailValidity):
						header('Location: index.php?action=registration&error=invalidEmail');

					endif;
						
				else:
					throw new Exception('Les deux mots de passe ne correspondent pas.');

				endif;

			else:
				throw new Exception('Adresse email non valide.');

			endif;

		} else {
			header('Location: index.php?action=registration&error=google-recaptcha');
		}
	}


	public function displayLogin() {
		require('view/frontoffice/loginView.php');
	}


	/**

	* @param $pseudo string

	* @param $password string

	**/
	public function loginSubmit(string $pseudo, string $password) {
		$memberManager = new MemberManager();

		$member = $memberManager->loginMember($pseudo);

		Controller::valid_data($pseudo);
		Controller::valid_data($password);

		$isPasswordCorrect = password_verify($_POST['password'], $member['password']);

		if (!$member):
			header('Location: index.php?action=login&account-status=unsuccess-login');
		elseif ($isPasswordCorrect):
			$_SESSION['id'] = $member['id'];
			$_SESSION['pseudo'] = ucfirst(strtolower($pseudo));
			$_SESSION['role'] = $member['role'];
			$_SESSION['email'] = $member['email'];
			header('Location: index.php');
		else:
			header('Location: index.php?action=login&account-status=unsuccess-login');

		endif;
	}

	/**

	* @param $postId integer

	* @param $author string

	* @param $content string

	**/
	public function addComment(int $postId, string $author, string $content) {
		$commentManager = new CommentManager();

		Controller::valid_data($_POST['content']);

		$affectedLines = $commentManager->addComments($postId, $author, $content);

		if ($affectedLines === false):
			throw new Exception("Impossible d'ajouter le commentaire !");
		else:
			header('Location: index.php?action=post&id=' . $postId);
		
		endif;
	}

	/**

	* @param $postId integer

	* @param $commentId integer

	* @param $memberId integer

	**/
	public function report(int $postId, int $commentId, int $memberId) {
		$reportManager = new ReportManager();

		$reported = $reportManager->reports($commentId, $memberId);

		header('Location: index.php?action=post&id=' . $postId . '&report=success');

		require('view/frontoffice/postView.php');
	}


	public function logout() {
		$_SESSION = array();
		setcookie(session_name(), '', time() - 42000);
		session_destroy();

		header('Location: index.php?logout=success');
	}


	public function displayAbout() {
		require('view/frontoffice/aboutView.php');
	}


	public function displayPrivacy() {
		require('view/frontoffice/privacyView.php');
	}
}



