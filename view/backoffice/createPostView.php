<?php $title = 'Nouveau récit de voyage'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4">
	<h2>Publier votre récit et partagez vos plus belles photos de voyage!</h2><br/>
	<div>
		<p><a class="btn btn-info" href="index.php?action=dashBoard">Retour au tableau de bord</a></p><br/>
		<form action="index.php?action=submitPost" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="font-weight-bold" for="title">Titre du récit :</label>
			    <input type="text" name="title" id="title" placeholder="Titre du récit" class="form-control title">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Pays visité :</label>
			    <input type="text" name="country" id="country" placeholder="Nom du pays visité" class="form-control country">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Ville ou endroit visité :</label>
				<div id="map1" class="col-xs-12 col-lg-6"></div>
				<em><p id="cityText" class="mt-3 pl-2"></p></em>
				<input type="text" id="city" name="city" class="mt-3 pl-2 city" disabled="true">
			    <input type="number" step="any" id="lat" name="lat" class="form-control" disabled="true">
			    <input type="number" step="any" id="lng" name="lng" class="form-control" disabled="true">
			</div>
  		
			<div id="cityWeather"></div>
			
			<div class="form-group">
				<label class="font-weight-bold" for="title">Votre récit :</label>
			    <textarea id="textarea" name="content" cols="160" rows="40"></textarea>
			</div>
			<div class="form-group">
                <label class="font-weight-bold" for="upload-pic">Télécharger vos photos de voyage</label>
                <input type="file" id="files" class="form-control-file" accept=".jpg, .jpeg, .png" name="userFiles[]" aria-describedby="fileHelp" multiple="multiple">
                <p id="alert" class="mt-2">Veuillez charger un fichier dans le bon format</p>
                
                <small id="fileHelp" class="form-text text-muted">Formats d'images autorisés : JPEG, JPG, PNG.<br/>Taille individuelle inférieure à 2Mo<br/>Taille totale du fichier inférieure à 8 Mo.</small>
                
            </div>
		  	<input type="submit" value="Publier" id="submitForm" class="btn btn-info">
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/init/initPostFormValidation.js"></script>
<script type="text/javascript" src="public/js/init/initMap1.js"></script>




