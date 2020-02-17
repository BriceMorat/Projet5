<?php $title = 'Panneau d\'administration'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4">
	<h2>Mise à jour de votre récit de voyage</h2><br/>
	<div>

		<?php  
			if (isset($_GET['updatePost']) && $_GET['updatePost'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le chapitre a bien été modifié !<p></div>';
			}
		?>

		<p><a class="btn btn-info" href="index.php?action=dashBoard">Retour au tableau de bord</a></p><br/>
		<form action="index.php?action=submitUpdatePost&id=<?= $post['id']; ?>" method="POST" enctype='multipart/form-data'>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Titre du récit :</label>
			    <input type="text" name="title" class="form-control" value="<?= $post['title']; ?>">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Pays visité :</label>
			    <p><?= $post['country']; ?></p>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Ville ou endroit visité :</label>
				<p><?= $post['city']; ?></p>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Votre récit :</label>
			    <textarea id="textarea" name="content" cols="160" rows="40"><?= $post['content']; ?></textarea>
			</div>
		  	<div class="form-group">
            	<label class="font-weight-bold" for="upload-pic">Télécharger vos photos de voyage</label>
            	<input type="file" class="form-control-file" name="userFiles[]" aria-describedby="fileHelp" multiple="multiple">
            	<small id="fileHelp" class="form-text text-muted">Les formats d'images autorisés sont : JPEG, JPG, PNG. La taille individuelle doit être inférieure à 2Mo<br/> et la taille totale du fichier doit être inférieure à 10 Mo.</small>
        	</div>
		  	<input type="submit" value="Publier" class="btn btn-info">
		
		</form>
	
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>