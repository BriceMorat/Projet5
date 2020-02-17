<?php  $title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4 adminSection">
	<h2>Panneau d'administration</h2><br/>

	<div id="container" class="jumbotron border border-dark bg-white pt-4 pb-4 postDiv">
		<h3 class="mb-4">Gestion des articles</h3>

		<?php  
			if (isset($_GET['new-post']) && $_GET['new-post'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">L\'article a bien été publié<p></div>';
			} elseif (isset($_GET['update-post']) && $_GET['update-post'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">L\'article a bien été modifié<p></div>';
			} elseif (isset($_GET['remove-post']) && $_GET['remove-post'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">L\'article a bien été supprimé<p></div>';
			}
		?>

		<table class="table table-striped table-borderless">
  			<thead class="thead-dark">
    			<tr>
			    	<th scope="col">Titre de l'article</th>
			    	<th scope="col">Date de publication</th>
			    	<th scope="col">Auteur de l'article</th>
			    	<th scope="col">Nombre de photos</th>
			    	<th scope="col"></th>
    			</tr>
  			</thead>

			<?php
			while (($post = $posts->fetch()) && ($image = $images->fetch())) {
				if (!empty($post)) {
			?>			

			<tbody>
				<tr>
					<th scope="row" class="my-auto"><a class="text-decoration-none text-info" href="index.php?action=updatePost&id=<?= $post['id']; ?>"><?= $post['title']; ?></a></th>
					<td>
						<em>le <?= $post['date_fr'] ?></em>

						<?php 
						if ($post['date_fr'] < $post['date_update_fr']) {
							echo '<p><em>modifié le ' . $post['date_update_fr'] . '</em></p>';
						}
						?>
					</td>

					<td><?= $post['author'] ?></td>

					<td><?= $image['images_nb']; ?></td>

					<td class="text-right">
						<button type="button" class="removepost btn btn-danger bg-danger" title="Supprimer" data-toggle="modal" data-target="#postModal<?= $post['id']; ?>"><i class="fas fa-trash-alt"></i></button>
					</td>
				</tr>
			</tbody>

			<div class="modal fade" id="postModal<?= $post['id']; ?>" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Suppression de l'article</h5>
							<button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
						</div>
						<div class="modal-body">
							<p>Voulez-vous vraiment supprimer l'article <span class="text-info font-weight-bold"><?= $post['title']; ?></span> ?</p>
						</div>
						<div class="modal-footer">
							<a class="btn btn-secondary bg-secondary" href="index.php?action=deletePost&id=<?= $post['id']; ?>">Oui</a>
							<button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php 		
				} else {
						echo '<div class="text-center d-flex justify-content-center"><p id="error" class="bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Pas de chapitres<p></div>';
				}
			}
			?>

		</table>

		<?php
			$posts->closeCursor();
			if ($pageNb >= 2) {
		?>

		<nav>
	  		<ul class="pagination justify-content-center">

			<?php 
				for ($i = 1; $i <= $pageNb; $i++) {
					if ((!isset($_GET['page']) && $i === 1) || (isset($_GET['page']) && $_GET['page'] === $i)) {
						echo '<li class="page-item"><a class="page-link" href="#">'.$i.'</a></li>';
					} else {
						echo '<li class="page-item"><a class="page-link" href="index.php?action=admin&page='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			?>

	  		</ul>
		</nav>
	</div>

	<div id="container" class="jumbotron border border-dark bg-white pt-4 pb-4 commentDiv">
		<h3 class="mb-4">Gestion des commentaires signalés</h3>

		<?php
			if (isset($_GET['remove-comment']) && $_GET['remove-comment'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le commentaire a bien été supprimé<p></div>';
			} elseif (isset($_GET['restore-comment']) && $_GET['restore-comment'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le commentaire a bien été restauré<p></div>';
			}
		?>	


		<table class="table table-striped table-borderless">
  			<thead class="thead-dark">
    			<tr>
			    	<th scope="col">Auteur</th>
			    	<th scope="col">Commentaire</th>
			    	<th scope="col">Date du signalement</th>
			    	<th scope="col">Nombre de signalement</th>
			    	<th scope="col"></th>
    			</tr>
  			</thead>
   
			<?php  
				while ($report = $reports->fetch()) {
			?>	
		
			<tbody>
				<tr>
					<th scope="row"><a class="text-decoration-none text-info" href="#"><?= $report['author']; ?></a></th>
					<td class="comment"><?= $report['content']; ?></td>
					<td><em><?= $report['date_c']; ?></em></td>
					<td><?= $report['reports_nb']; ?></td>
					<td class="text-right pl-0">
						<button type="button" class="restorComment btn btn-success" title="Rétablir" data-toggle="modal" data-target="#reportModalRestore<?= $report['author']; ?>"><i class="fas fa-undo-alt"></i></button>
						<button type="button" class="removeComment btn btn-danger bg-danger" title="Supprimer" data-toggle="modal" data-target="#reportModalDelete<?= $report['author']; ?>"><i class="fas fa-trash-alt"></i></button>
					</td>
				</tr>
			</tbody>
			
			<div class="modal fade" id="reportModalRestore<?= $report['author']; ?>" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Rétablissement du commentaire</h5>
							<button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
						</div>
						<div class="modal-body">
							<p>Voulez-vous vraiment rétablir le commentaire de <span class="text-info font-weight-bold"><?= $report['author']; ?></span> ?</p>
						</div>
						<div class="modal-footer">
							<a class="btn btn-secondary bg-secondary" href="index.php?action=restoreComment&id=<?= $report['comment_id']; ?>">Oui</a>
							<button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
						</div>
					</div>
				</div>
			</div>
	
			<div class="modal fade" id="reportModalDelete<?= $report['author']; ?>" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Suppression du commentaire</h5>
							<button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
						</div>
						<div class="modal-body">
							<p>Voulez-vous vraiment supprimer le commentaire de <span class="text-info font-weight-bold"><?= $report['author']; ?></span> ?</p>
						</div>
						<div class="modal-footer">
							<a class="btn btn-secondary bg-secondary" href="index.php?action=deleteComment&id=<?= $report['comment_id']; ?>">Oui</a>
							<button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
						</div>
					</div>
				</div>
			</div>
		
			<?php 		
				}
			?>

		</table>
	
	<?php
		$reports->closeCursor();
	?>

	</div>

	<div id="container" class="jumbotron border border-dark bg-white pt-4 pb-4 memberDiv">
		<h3 class="mb-4">Gestion des membres</h3>

		<?php
			if (isset($_GET['remove-member']) && $_GET['remove-member'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le membre a bien été supprimé<p></div>';
			}
		?>

		<table class="table table-borderless table-striped">
  			<thead class="thead-dark">
    			<tr>
			    	<th scope="col">Identifiant</th>
			    	<th scope="col">Pseudo</th>
			    	<th scope="col">Date d'inscription</th>
			    	<th scope="col"></th>
    			</tr>
  			</thead>
  		
			<?php
				while ($member = $members->fetch()) {
					if (!empty($member)) {
			?>	
			
			<tbody>
				<tr>
					<td><?= $member['id']; ?></td>
					<th scope="row" id><a class="text-decoration-none text-info" href="#"><?= $member['pseudo']; ?></a></th>
					<td><em><?= $member['reg_date']; ?></em></td>
					<td class="text-right">
						<?php 
						if ($member['role'] === 'admin') {
						
							echo '<p></p>';

						} else {
						
							echo '<button type="button" class="removeMember btn btn-danger bg-danger" title="Supprimer" data-toggle="modal" data-target="#memberModal'.$member["pseudo"].'"><i class="fas fa-user-times"></i></button>';
						}
						?>
						
					</td>
				</tr>
			</tbody>
			
			<div class="modal fade" id="memberModal<?= $member['pseudo']; ?>" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Suppression du membre</h5>
							<button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
						</div>
						<div class="modal-body">
							<p> Voulez-vous vraiment supprimer le membre <span class="text-info font-weight-bold"><?= $member['pseudo'];?></span> ?</p>
							
						</div>
						<div class="modal-footer">
							<a class="btn btn-secondary bg-secondary" href="index.php?action=deleteMember&id=<?= $member['id']; ?>">Oui</a>
							<button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
						</div>
					</div>
				</div>
			</div>

			<?php
					} else {
						echo '<div class="text-center d-flex justify-content-center"><p id="error" class="bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Pas de membres enregistrés<p></div>';
					}
				}
			?>

		</table>

	<?php
		$members->closeCursor();
	?>

	</div>

</section>	

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>