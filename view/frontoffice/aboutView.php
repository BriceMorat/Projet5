<?php $title = 'À propos'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-dark pt-4">
	<div id="container" class="card mb-3">
		<div class="row no-gutters">
	    	<div class="ml-4 col-md-2 col d-flex align-items-center">
	      		<img src="public/img/icon-travelBlog.jpg" class="card-img rounded-circle border border-dark" alt="Image d'un globe terrestre">
	    	</div>
	    	<div class="col-md-9 text-justify">
	      		<div class="card-body">
	        		<h2 class="card-title">À propos de l'auteur</h5>
	        		<p class="card-text text-justify">Né en 1987 en France et pendant mon enfance j'ai eu la chance de voyager avec mes parents comme en Grêce ou en Martinique.</p>
					<p class="card-text text-justify">Cette passion pour les voyages ne me quittera plus. J'ai eu l'occasion de voyager à de multiple reprises dans plusieurs pays comme aux États-Unis, en Chine et dans quelques pays européens comme l'Espagne, l'Italie et l'Angleterre.</p>
					<p class="card-text text-justify">Un peu plus tard lors d'un déplacement professionnel d'une durée de 7 mois, j'ai pu visiter l'Indonésie et la Malaisie. Mes plus beaux souvenirs de voyages et de découverte seront lors de mon Tour du Monde réalisé en 2016 où pendant 8 mois j'ai pu visiter 10 pays. De l'Asie du Sud Est (Thaïlande, Laos, Vietnam, Cambodge, Phillipines) en passant par la Nouvelle Zélande et enfin l'Amérique du Sud (Chili, Argentine, Bolivie et Pérou) j'ai pu réaliser un des mes rêves.</p>
					<p class="card-text text-justify">Aujourd'hui, au travers de ce blog de voyage, je souhaite partager ma passion pour le voyage et la découverte avec un maximum d'aventuriers.</p>
					<p class="card-text text-justify">Le principe est simple : chaque membre du site peut se connecter et publier le récit de son voyage accompagné de ses plus belles photos de voyage.</p>
					<p class="card-text text-justify">Je vous invite donc à venir rejoindre sans plus tarder la communauté des voyageurs et aventuriers !</p>
					<p class="card-text text-justify">A très vite !</p>

	        	</div>
	    	</div>
	  	</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

