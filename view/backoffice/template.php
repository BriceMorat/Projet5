<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !" />
		<!-- favicon -->
		<link rel="icon" type="image/png" href="public/img/icon-travelBlog.jpg" />
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Style -->
		<link rel="stylesheet" href="public/css/style.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
		<!-- leaflet css link -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 		<!-- Leaflet Search Box -->
        <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<!-- Twitter Card data -->
		<meta name="twitter:card" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !">
		<!-- Open Graph data -->
		<meta property="og:title" content="Bienvenue sur ShareMyTrip. Site communautaire de partage de récits et de photos de voyage. Pour découvrir le monde à travers vos plus beaux voyages !" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://projet5.bricemorat.fr" />
		<meta property="og:image" content="public/img/icon-travelBlog.jpg" />
		<meta property="og:description" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !" />

		<title><?= $title ?></title>
	</head>

	<body>
		<header>
			<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">

				<?php 
					if (!empty($_SESSION) && $_SESSION['role'] === 'admin'):
			      		echo '<ul class="nav nav-pills"><li class="nav-item"><a class="nav-link" href="index.php?action=admin"><img src="public/img/traveler-person-icon" class="mr-2"></img>Administration</a></li></ul>';
			    	endif;
				?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    				<span class="navbar-toggler-icon"></span>
  				</button>

  				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
		    		<ul class="nav nav-pills">
		      			<li class="nav-item mr-2">
		        			<a class="nav-link" href="index.php">Accueil</a>
		      			</li>
		      			<li class="nav-item mr-2">
		        			<a class="nav-link" href="index.php?action=about">À propos</a>
		      			</li>
		      			<li class="nav-item mr-2">
		        			<a class="nav-link" href="index.php?action=map">Carte</a>
		      			</li>

		      			<?php
			      			if (!empty($_SESSION)):
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=dashBoard"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['pseudo']) . '</a></li>';
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=logout">Déconnexion</a></li>';
			      	 
			      			else:
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login">Se connecter</a></li>';
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=registration">S\'inscrire</a></li>';

			      			endif;
		      			?>

		    		</ul>
	    		</div>
			</nav><br/><br/><br/>
		</header>

		<?= $content ?>

		<!-- Tiny MCE -->
		<script src="https://cdn.tiny.cloud/1/awbrpbrntn6dluij2xowqpbazd9pmf2lnlwc90vrn1t6081t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  		<script>tinymce.init({selector:'#textarea', content_css:'public/css/style.css', resize: false});</script>
		
		<!-- Font Awesome -->
		<script src="https://use.fontawesome.com/b4858dacdf.js"></script>
		<!-- Google Recaptcha -->
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Bootstrap -->
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <!-- Leaflet -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
       	<!-- Leaflet Search Box -->
		<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
    	<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
    	<script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>
    	<script src="https://unpkg.com/esri-leaflet"></script>
		<script src="https://unpkg.com/esri-leaflet-geocoder"></script>

	    <!-- Script -->

	    <script type="text/javascript" src="public/js/animation.js"></script>
	    <script type="text/javascript" src="public/js/classLeaflet.js"></script>
	    <script type="text/javascript" src="public/js/classFormValidation.js"></script>
	    	  
	</body>
</html>
