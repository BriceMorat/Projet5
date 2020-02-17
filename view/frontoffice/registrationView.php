<?php $title = 'Inscrivez-vous'; ?>

<?php ob_start(); ?>

<?php 
	if (isset($_GET['error']) && $_GET['error'] === 'invalidUsername') {
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Pseudo déjà utilisé</p></div>";
	} 
	if (isset($_GET['error']) && $_GET['error'] === 'invalidEmail') {
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Adresse email déjà utilisée</p></div>";
	}
	if (isset($_GET['error']) && $_GET['error'] === 'google-recaptcha') {
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Vous devez cocher la case du captcha</p></div>";
	}
?>

<section id="container" class="jumbotron container border border-dark">
	<h2>Inscription</h2><br/><br/>

	<form action="index.php?action=addMember" method="POST">
  		<div class="form-group">
		    <label for="pseudo">Pseudo</label>
		    <input type="text" name="pseudo" class="form-control" id="pseudo">
  		</div>
		<div class="form-group">
		    <label for="psw">Mot de passe</label>
		    <input type="password" name="password" class="form-control" id="psw">
		</div>
		<div class="form-group">
		    <label for="psw_confirm">Confirmer votre mot de passe</label>
		    <input type="password" name="password_confirm" class="form-control" id="psw_confirm">
		</div>
  		<div class="form-group">
		    <label for="email">Adresse email</label>
		    <input type="email" name="email" class="form-control" id="email">
  		</div><br />
  		<input type="submit" class="btn btn-info" value="S'inscrire">
  		<div class="g-recaptcha" data-sitekey="6Lf7MNIUAAAAAKxnQKIP7uUtObcY9mD8-C9Igoup"></div>
 	</form>		
</section>	

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


