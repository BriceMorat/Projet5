<?php $title = 'Carte'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron border border-dark col-10 mx-auto mapContainer pb-4">
   	<div class="d-lg-flex">
	    <div id="map2" class="col-xs-12 col-lg-6 border border-dark"></div>

	    <?php while ($data = $latLngList->fetch()):

			$lat = $data['lat'];
			$lng = $data['lng'];
		?>
			<p class="latRec"><?= json_encode($lat, JSON_NUMERIC_CHECK); ?></p>		
			<p class="lngRec"><?= json_encode($lng, JSON_NUMERIC_CHECK); ?></p>	

		<?php endwhile; ?>

		<div class="markerImagesContainer col-xs-12 col-lg-6 position-relative">               
			<?php while ($markerImage = $markerImages->fetch()): ?>
				
			<figure class="markerImagesFigure position-absolute bg-dark w-100 mb-0">
				<div class="markerImagesDiv overflow-hidden px-4 pt-4">
	        		<img class="img-fluid" src="public/upload_img/<?= $markerImage['file_name']; ?>" alt="image">
	        	</div>
	        	<figcaption class="markerImagesFigcaption text-center text-white font-weight-bold position-relative">
	        		<p class="h4 mb-0"><?= htmlspecialchars_decode($markerImage['title']); ?>
	        		<p class="h5 mb-0"><?= htmlspecialchars_decode($markerImage['country']).', <em class="h6">'.htmlspecialchars_decode($markerImage['city']); ?></em></p>
	        		<p class="mb-0"><?= htmlspecialchars_decode($markerImage['author']); ?></p>
					
					<p class="mb-0"><a href="index.php?action=map&image=<?= $markerImage['id']; ?>"><i class="fa fa-thumbs-up fa-2x"></i></a></p>

	        	</figcaption>
	      	</figure>

			<?php endwhile; ?>
		</div>
	</div>

	<div class="text-center text-white imagesBtn mt-4">
		<button class="btn btn-success text-center">Les photos les plus aimées</button>
	</div>
          
</section>

<section id="container" class="jumbotron container border border-dark position-relative imagesContainer">
	<div class="text-center">
		<h3>Les photos les plus aimées</h3>
	</div><br/>

	<div class="row">
		<div class="col-md-12">

			<div class="likedImagesContainer bg-dark mdb-lightbox d-flex flex-wrap py-4 px-2">

			    <?php while ($nbImgLike = $nbImgLikes->fetch()): ?>

				<figure class="likedImagesFigure col-md-4">
					<div class="likedImagesDiv">
			    		<img class="img-fluid" src="public/upload_img/<?= $nbImgLike['file_name']; ?>" alt="image">
			    	</div>
			    	
			    	<figcaption class="likedImagesFigcaption text-center text-white font-weight-bold">
			    	
						<p><i class="fa fa-thumbs-up"></i> <?= $nbImgLike['img_likes']; ?></p>

			    	</figcaption>
			  	</figure>
				
				<?php endwhile; ?>

			</div>
	  	</div>
	</div>
	<div class="text-center text-white imagesReturnBtn position-relative mt-4">
		<button class="btn btn-success text-center">Retour carte</button>
	</div>
</section>

<section id="container" class="jumbotron border border-dark col-11 mx-auto autoSlideImagesContainer">
	<div>
		<div class="col-md-12 overflow-hidden">
		   
		    <div id="autoSlideImages" class="d-flex flex-row">
			<?php while ($autoSliderMapImage = $autoSliderMapImages->fetch()): ?>
		
		      	<figure class="autoSlideImagesFigure col-md-3 mx-4 bg-dark">
		      		<div class="autoSlideImagesDiv my-4">
		        		<img class="img-fluid" src="public/upload_img/<?= $autoSliderMapImage['file_name']; ?>" alt="image">
		        	</div>
		        	<figcaption class="autoSlideImagesFigcaption text-center text-white font-weight-bold mb-4">
		        		<p class="mb-1 h6"><?= $autoSliderMapImage['title']; ?>
		            	<p class="mb-1"><?= $autoSliderMapImage['country'].', <em>'.$autoSliderMapImage['author']; ?></em></p>

		      		</figcaption>
		      	</figure>

		  	<?php endwhile; ?>
		    </div>

			<div id="playPauseBtn" class="mx-auto text-center pb-2">
		  		<i class="far fa-play-circle fa-2x position-relative visibility"></i>
		  		<i class="far fa-pause-circle position-relative fa-2x"></i>
		  	</div>

		</div>

	  	<div class="text-center text-white sliderBtn">
			<button class="btn btn-success text-center">Agrandir diaporama</button>
		</div>
	</div>
</section>

<section id="container" class="jumbotron border border-dark col-11 mx-auto pb-4 sliderMapImages">

    <div class="sliderMapImagesContainer position-relative">

  		<?php while ($sliderMapImage = $sliderMapImages->fetch()): ?>

          	<figure class="sliderMapImagesFigure bg-dark position-absolute w-100">
      			<div class="sliderMapImagesDiv overflow-hidden px-5 pt-4">
        			<img class="img-fluid" src="public/upload_img/<?= $sliderMapImage['file_name']; ?>" alt="image">
        		</div>
				<div id="prevNextBtn">
					
			    	<span id="prev-btn" class="prev-btn"><i class="fas fa-angle-double-left fa-2x text-white p-2" aria-hidden="true"></i></span>
			    	<span id="next-btn" class="next-btn"><i class="fas fa-angle-double-right fa-2x text-white p-2" aria-hidden="true"></i></span>
			  		
			  	</div>
            	<figcaption class="sliderMapImagesFigcaption text-center text-white font-weight-bold position-relative">
        			<p class="h4 mb-0"><?= $sliderMapImage['title']; ?>
            		<p class="h5 mb-0"><?= $sliderMapImage['country'].', <em class="h6">'.$sliderMapImage['city']; ?></em></p>
            		<p class="mb-0"><?= $sliderMapImage['author']; ?></p>
      			</figcaption>
            </figure>

		<?php endwhile; ?>

	</div>

  	<div class="text-center text-white sliderReturnBtn position-relative pt-2">
		<button class="btn btn-success text-center">Retour diaporama</button>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/init/initMap2.js"></script>
<script type="text/javascript" src="public/js/init/initMapSlider.js"></script>


