<?php
ob_start();

session_start();

require('controller/Frontoffice.php');
require('controller/Backoffice.php');

$frontofficeController = new FrontofficeController();

$backofficeController = new BackofficeController();

try {
	if (isset($_GET['action'])) {

		switch($_GET['action']) {

			case 'map':
				
				if ($_GET['action'] === 'map'):
				 	if (isset($_GET['image'])):
						if (empty($_SESSION['id'])):
							throw new Exception('Veuillez vous inscrire pour liker les photos.');
						else:
							$backofficeController->addImgLikes($_GET['image'], $_SESSION['id']);
						
						endif;
					
					endif;
					
					$frontofficeController->displayMap();
				
				endif;
				
				break;
				
			case 'post':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0):
					$frontofficeController->listPost();

				else:
					throw new Exception('Aucun identifiant de billet envoyé');
				
				endif;

				break;

			case 'member':
			if (isset($_GET['authorId']) && (int) $_GET['authorId'] > 0):
				$frontofficeController->listUserPostImages();

			else:
				throw new Exception('Aucun identifiant de billet envoyé');
			
			endif;

			break;

			case 'registration':
				$frontofficeController->displayRegistration();

				break;

			case 'addMember':
				if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email'])):
					$frontofficeController->addMember($_POST['pseudo'], $_POST['password'], $_POST['email']);
				
				else:
					throw new Exception('Tous les champs ne sont pas remplis !');
				
				endif;

				break;

			case 'login':
				$frontofficeController->displayLogin();

				break;

			case 'loginSubmit':
				$frontofficeController->loginSubmit($_POST['pseudo'], $_POST['password']);

				break;

			case 'dashBoard':
				$backofficeController->listPostsByUser($_SESSION['id']);

				break;


			case 'updatePassword':
				if (!empty($_POST['psw']) && !empty($_POST['psw_confirm'])):
			
					$backofficeController->updatePassword($_POST['psw']);
				
				else:
					throw new Exception('Tous les champs ne sont pas remplis !');
				
				endif;

				break;

			case 'addComment':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0):
					if (!empty($_SESSION['pseudo']) && !empty($_POST['content'])):
						$frontofficeController->addComment($_GET['id'], $_SESSION['pseudo'], $_POST['content']);
					else:
						throw new Exception('Tous les champs ne sont pas remplis !');
					
					endif;

				else:
					throw new Exception('Aucun identifiant de billet envoyé');
				
				endif;

				break;

			case 'report':
				$frontofficeController->report($_GET['id'], $_GET['comment-id'], $_SESSION['id']);

				break;

			case 'logout':
				$frontofficeController->logout();

				break;

			case 'admin':
				if (isset($_SESSION) && (string) $_SESSION['role'] === 'admin'):
					$backofficeController->displayAdmin();
				else:
					throw new Exception("Administrateur non identifié");
				
				endif;

				break;

			case 'createPost':
				if (isset($_SESSION) && (((string) $_SESSION['role'] === 'admin') || ((string) $_SESSION['role'] === 'user'))):
					$backofficeController->displayCreatePost();
				else:
					throw new Exception("Administrateur ou membre non identifié");
				
				endif;

				break;

			case 'submitPost':
				if (!empty($_POST['title']) && !empty($_POST['country']) && !empty($_POST['city']) && !empty($_POST['content']) && !empty($_FILES["userFiles"]["name"][0])):
					$backofficeController->newPost($_POST['title'], $_POST['country'], $_POST['city'], $_POST['content'], $_SESSION['id'], $_SESSION['pseudo']);
					$backofficeController->newLatLng($_POST['lat'], $_POST['lng']);
					$backofficeController->newImage($_SESSION['id'], $_FILES['userFiles']['name']);
								
				else:
					throw new Exception("Contenu vide !");
				
				endif;

				break;

			case 'updatePost':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0):
					if (isset($_SESSION)):
						$backofficeController->displayUpdatePost();
					else:
						throw new Exception("Membre non identifié");
					
					endif;
				
				endif;

				break;

			case 'submitUpdatePost':

				if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES["userFiles"]["name"][0])):
					$backofficeController->submitUpdatePost($_POST['title'], $_POST['content'], $_GET['id']);
					$backofficeController->submitUpdateImage($_GET['id'], $_SESSION['id'], $_FILES['userFiles']['name']);

				else:
					throw new Exception("Contenu vide !");
				
				endif;
				
				break;

			case 'deletePost':
				$backofficeController->removePost($_GET['id']);

				break;

			case 'deleteImage':
				$backofficeController->removeImage($_GET['id'], $_GET['imageId']);

				break;

			case 'deleteComment':
				$backofficeController->removeComment($_GET['id']);

				break;

			case 'restoreComment':
				$backofficeController->restoreComment($_GET['id']);

				break;

			case 'deleteMember':
				$backofficeController->removeMember($_GET['id']);

				break;

			case 'about':
				$frontofficeController->displayAbout();

				break;

			case 'privacy':
				$frontofficeController->displayPrivacy();

				break;

			default: 
				$frontofficeController->listPosts();
		}

	} else {
		$frontofficeController->listPosts();
	}

}

catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}

