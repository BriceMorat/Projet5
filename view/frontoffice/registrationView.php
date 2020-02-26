<?php $title = 'Inscrivez-vous'; ?>

<?php ob_start(); ?>

<?php 
	if (isset($_GET['error']) && $_GET['error'] === 'invalidUsername'):
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Pseudo déjà utilisé</p></div>";

	elseif (isset($_GET['error']) && $_GET['error'] === 'invalidEmail'):
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Adresse email déjà utilisée</p></div>";

	elseif (isset($_GET['error']) && $_GET['error'] === 'google-recaptcha'):
		echo "<div class='text-center d-flex justify-content-center'><p id='error' class='bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Vous devez cocher la case du captcha</p></div>";

endif; ?>

<section id="container" class="jumbotron container border border-dark">
	<h2>Inscription</h2><br/><br/>

	<form action="index.php?action=addMember" method="POST">
  		<div class="form-group">
		    <label class="font-weight-bold" for="pseudo">Pseudo</label>
		    <input type="text" name="pseudo" class="form-control" id="pseudo" pattern="^(?=[0-9]*[a-zA-Z])[a-zA-Z0-9]{5,}$" required="required" maxlength="15">
		    <p><em>Le pseudo doit comporter au minimum 5 caractères avec au moins une lettre (caractères spéciaux non autorisés)</em></p>
  		</div>
		<div class="form-group">
		    <label class="font-weight-bold" for="psw">Mot de passe</label>
		    <input type="password" name="password" class="form-control" id="psw" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{5,}$" required="required" maxlength="15">
		    <p><em>Le mot de passe doit comporter au minimum 5 caractères avec au moins une lettre, un chiffre et un caractère spécial</em></p>
		</div>
		<div class="form-group">
		    <label class="font-weight-bold" for="psw_confirm">Confirmer votre mot de passe</label>
		    <input type="password" name="password_confirm" class="form-control" id="psw_confirm" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{5,}$" required="required" maxlength="15">
		</div>
  		<div class="form-group">
		    <label class="font-weight-bold" for="email">Adresse email</label>
		    <input type="email" name="email" class="form-control" id="email" pattern="^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$" required="required">
  		</div><br />
  		<input type="submit" id="submitForm" class="btn btn-info" value="S'inscrire">
  		<div class="g-recaptcha pt-4" data-sitekey="6Lf7MNIUAAAAAKxnQKIP7uUtObcY9mD8-C9Igoup"></div>
 	</form>		
</section>	

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/init/initRegistrationFormValidation.js"></script>