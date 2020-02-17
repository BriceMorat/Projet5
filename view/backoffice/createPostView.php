<?php $title = 'Nouveau récit de voyage'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4">
	<h2>Publier votre récit et partagez vos plus belles photos de voyage!</h2><br/>
	<div>
		<p><a class="btn btn-info" href="index.php?action=dashBoard">Retour au tableau de bord</a></p><br/>
		<form action="index.php?action=submitPost" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="font-weight-bold" for="title">Titre du récit :</label>
			    <input type="text" name="title" placeholder="Titre du récit" class="form-control">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Pays visité :</label>
			    <input type="text" name="country" placeholder="Nom du pays visité" class="form-control">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Ville ou endroit visité :</label>
				<div id="map1" class="col-xs-12 col-lg-6"></div>
				<em><p id="cityText" class="mt-3 pl-2"></p></em>
				<input type="text" id="city" name="city" class="mt-3 pl-2" disabled="true">
			    <input type="number" step="any" id="lat" name="lat" class="form-control">
			    <input type="number" step="any" id="lng" name="lng" class="form-control">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Votre récit :</label>
			    <textarea id="textarea" name="content" cols="160" rows="40"></textarea>
			</div>
			<div class="form-group">
                <label class="font-weight-bold" for="upload-pic">Télécharger vos photos de voyage</label>
                <input type="file" class="form-control-file" name="userFiles[]" aria-describedby="fileHelp" multiple="multiple">
                <small id="fileHelp" class="form-text text-muted">Les formats d'images autorisés sont : JPEG, JPG, PNG. La taille individuelle doit être inférieure à 2Mo<br/> et la taille totale du fichier doit être inférieure à 10 Mo.</small>
                
            </div>
		  	<input type="submit" value="Publier" id="submitPost" class="btn btn-info">
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/initMap1.js"></script>


