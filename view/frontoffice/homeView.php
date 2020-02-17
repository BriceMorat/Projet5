<?php $title = 'ShareMyTrip'; ?>

<?php ob_start(); ?>

<?php
	while ($data = $posts->fetch()) {
		if (!empty($data)) {
?>
			<section id="container" class="jumbotron container border border-dark">
				<div id="container" class="bg-dark pl-2 pt-2 pb-2 text-white">
					<h3 class="pl-2">
						<?= htmlspecialchars($data['title']); ?>
						<em><small>le <?= $data['date_fr']; ?></em></small>
					</h3>
				</div>
				<br/><br/>
				
				<div class="row d-flex align-items-center">
					<div class="col-md-3">
						<img class="img-fluid small-img" src="public/upload_img/<?= $data["file_name"]; ?>" alt="photos de voyage">
					</div>

					<div class="col-md-9 text-justify">
						<p>
							<?php
								$extract = substr($data['content'], 0, 1000);
								echo html_entity_decode(htmlspecialchars($extract . " ..."));
							?>
						</p><br/>
						
						<div class="text-md-right">
							<a class="btn btn-success text-right" href="index.php?action=post&id=<?= $data['id'];?>">Lire la suite ...</a>
						</div>
					</div>
				</div>
			</section>

<?php
		} else {
			echo "Ce chapitre n'existe pas.";
		}
	}
	$posts->closeCursor();
?>

			<nav>
		  		<ul class="pagination justify-content-center">

				<?php 
					for ($i = 1; $i <= $pageNb; $i++) {
						echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
					}
				?>

		  		</ul>
			</nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
