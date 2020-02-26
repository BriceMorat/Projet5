<?php $title = 'Gallerie photos de '.htmlspecialchars_decode($member['pseudo']).''; ?>

<?php ob_start(); ?>

<div class="text-center">
	<a class="btn btn-info" href="index.php">Retour à la liste des récits de voyage</a>
</div><br/>

<section id="container" class="jumbotron container border border-dark position-relative"> 
	<div class="text-center">
		<?= '<h3>Gallerie photos de '.htmlspecialchars_decode($member['pseudo']).'<br/><em class="h6 text-info">membre depuis le '.$member['reg_date'].' </em></h3>' ?>
	</div><br/>

	<div class="row">
		<div class="col-md-12">

			<div class="userImagesContainer bg-dark mdb-lightbox d-flex flex-wrap py-4 px-2">
	    
				<?php while ($userPostImage = $userPostImages->fetch()): ?>
	  
		      	<figure class="userImagesFigure col-md-4">
		      		<div class="userImagesDiv">
		        		<img class="img-fluid" src="public/upload_img/<?= $userPostImage['file_name']; ?>" alt="image">
		        	</div>

		      		<figcaption class="userImagesFigcaption text-center text-white font-weight-bold">
		    			<p class="mb-1 h5"><?= htmlspecialchars_decode($userPostImage['country']).', <em class="h6">'.htmlspecialchars_decode($userPostImage['city']); ?></em></p>
		  			</figcaption>
		      	</figure>

		  		<?php endwhile; ?>
		  		
	  		</div>
	  	</div>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>



