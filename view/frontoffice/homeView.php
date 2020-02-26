<?php $title = 'ShareMyTrip'; ?>

<?php ob_start(); ?>

<?php while ($data = $posts->fetch()): ?>
	<?php if (!empty($data)): ?>

		<section id="container" class="jumbotron container border border-dark">
			<div id="container" class="bg-dark pl-2 pt-2 pb-2 text-white">
				<h3 class="pl-2">
					<?= htmlspecialchars_decode($data['title']); ?>
					<em><small>le <?= $data['date_fr']; ?></em></small>
					<?= '<em class="h6"> par <a class="text-decoration-none text-info" href="index.php?action=member&authorId='.$data['author_id'].'">'.htmlspecialchars_decode($data['author']).'</a></em>'; ?>
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
							$extract = substr(htmlspecialchars_decode($data['content']), 0, 1000);
							echo ($extract . " ...");
						?>
					</p><br/>
					
					<div class="text-md-right">
						<a class="btn btn-success text-right" href="index.php?action=post&id=<?= $data['id'];?>">Lire la suite ...</a>
					</div>
				</div>
			</div>
		</section>

	<?php else:
		"Ce chapitre n'existe pas.";
		
	endif;

endwhile; ?>

			<nav>
		  		<ul class="pagination justify-content-center">
		  			<?php
		  				if (!isset($_GET['page'])):
		  					echo '';
		  				elseif ($_GET['page'] === 1):
			  				echo '<li class="page-item"><a class="page-link" href="" aria-label="Previous" disabled="disabled"><span aria-hidden="true">&laquo;</span></a></li>';
			  			elseif ($_GET['page'] > 1):
			  				echo '<li class="page-item"><a class="page-link" href="index.php?page='.($_GET["page"]-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		  				endif;
				
						for ($i = 1; $i <= $pageNb; $i++):
							echo '<li class="page-item"><a class="page-link pageNb" href="index.php?page='.$i.'">'.$i.'</a></li>';
						endfor;
	
						if (!isset($_GET['page'])):
		  					echo '';
		  				elseif ($_GET['page'] === $pageNb):
			  				echo '<li class="page-item"><a class="page-link" href="" aria-label="Next" disabled="disabled"><span aria-hidden="true">&raquo;</span></a></li>';
			  			elseif ($_GET['page'] < $pageNb):
			  				echo '<li class="page-item"><a class="page-link" href="index.php?page='.($_GET["page"]+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
			  			endif;
		  			?>

		  		</ul>
			</nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
