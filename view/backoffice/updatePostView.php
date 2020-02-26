<?php $title = 'Mise à jour du récit de voyage'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4">
	<h2>Mise à jour de votre récit de voyage</h2><br/>
	<div>

		<?php  
			if (isset($_GET['updatePost']) && $_GET['updatePost'] === 'success'):
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le chapitre a bien été modifié !<p></div>';
			endif;
		?>

		<p><a class="btn btn-info" href="index.php?action=dashBoard">Retour au tableau de bord</a></p><br/>
		<form action="index.php?action=submitUpdatePost&id=<?= $post['id']; ?>" method="POST" enctype='multipart/form-data'>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Titre du récit :</label>
			    <input type="text" name="title" id="title" class="form-control" value="<?= $post['title']; ?>">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Pays visité :</label>
			    <p><?= htmlspecialchars_decode($post['country']); ?></p>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Ville ou endroit visité :</label>
				<p><?= htmlspecialchars_decode($post['city']); ?></p>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="title">Votre récit :</label>
			    <textarea id="textarea" name="content" cols="160" rows="40"><?= htmlspecialchars_decode($post['content']); ?></textarea>
			</div>
		  	<div class="form-group">
            	<label class="font-weight-bold" for="upload-pic">Télécharger vos photos de voyage</label>
            	<input type="file" id="files" class="form-control-file" accept=".jpg, .jpeg, .png" name="userFiles[]" aria-describedby="fileHelp" multiple="multiple">
            	<p id="alert" class="mt-2">Veuillez charger un fichier dans le bon format</p>
            		
            	<small id="fileHelp" class="form-text text-muted">Formats d'images autorisés : JPEG, JPG, PNG.<br/>Taille individuelle inférieure à 2Mo<br/>Taille totale du fichier inférieure à 8 Mo.</small>
            	<div class="d-flex flex-row mt-3 flex-wrap">
	            	<?php while ($userImage = $userImages->fetch()): ?>
	            		<div class="mb-3">
		            		<img class="imgUpdate" src="public/upload_img/<?= $userImage['file_name']; ?>">

							<i class="removeImage fas fa-trash-alt position-relative" title="Supprimer" data-toggle="modal" data-target="#postModal<?= $userImage['id']; ?>"></i>
						</div>
						<div class="modal fade" id="postModal<?= $userImage['id']; ?>" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Suppression de la photo</h5>
										<button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
									</div>
									<div class="modal-body">
										<p>Voulez-vous vraiment supprimer la photo <span class="text-info font-weight-bold"><?= htmlspecialchars_decode($userImage['file_name']); ?></span> ?</p>
									</div>
									<div class="modal-footer">
										<a class="btn btn-secondary bg-secondary" href="index.php?action=deleteImage&id=<?= $userImage['post_id']; ?>&imageId=<?= $userImage['id']; ?>">Oui</a>
										<button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
									</div>
								</div>
							</div>
						</div>
	            	<?php endwhile; ?>
            	</div>
            	
        	</div>
		  	<input type="submit" value="Publier" id="submitForm" class="btn btn-info">
		
		</form>
	
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/init/initUpdatePostFormValidation.js"></script>