<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<?php 
	if (isset($_GET['account-status']) && $_GET['account-status'] === 'unsuccess-login') {
		echo '<div class="text-center d-flex justify-content-center"><p id="error" class="bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Mauvais identifiant ou mot de passe !<p></div>';
	}
?>

<section>-u origin master
	<div id="container" class="jumbotron container border border-dark">
		<h2>Connexion</h2><br/><br/>
		<form action="index.php?action=loginSubmit" method="POST">
			<div class="form-group">
			    <label class="font-weight-bold" for="pseudo">Pseudo</label>
			    <input type="text" name="pseudo" class="form-control" id="pseudo"> 
		  	</div>
			<div class="form-group">
			    <label class="font-weight-bold" for="psw">Mot de passe</label>
			    <input type="password" name="password" class="form-control" id="psw">
			</div>
		  	<input type="submit" value="Se connecter" class="btn btn-info loginSubmit">
		</form><br />
	</div>

	<div id="container" class="jumbotron container border border-dark mb-4">
		<p>Nouveau sur ShareMyTrip ? Créez votre compte et rejoignez la communauté des voyageurs. Une fois votre compte créé, vous pourrez créer vos propres récits de voyages et commenter tous les récits et photos des autres voyageurs du monde entier !</p>
		<a href="index.php?action=registration" class="btn btn-info">S'incrire</a>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>