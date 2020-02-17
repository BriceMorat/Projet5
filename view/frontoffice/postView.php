<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<div class="text-center">
	<a class="btn btn-info" href="index.php">Retour à la liste des récits de voyage</a>
</div><br/>


<section id="container" class="jumbotron container border border-dark">
	<div class="text-center">
		<h3>
			<?= ''.htmlspecialchars($post['title']).' <em class="h6"> par <a class="text-decoration-none text-info" href="index.php?action=member&authorId='.$post['author_id'].'">'.$post['author'].' </a></em>'; ?>
		</h3>
	</div><br/>
	
    <div class="postImagesContainer position-relative">
        
    
		<?php while ($postImage = $postImages->fetch()) {
		?>
  
      	<figure class="postImagesFigure bg-dark position-absolute w-100">
      		
  			<div class="postImagesDiv overflow-hidden px-5 pt-4">
    			<img class="img-fluid" src="public/upload_img/<?= $postImage['file_name']; ?>" alt="image">
    		</div>

    		<div id="prevNextDiv">
    			<span id="prev-btn" class="prev-btn"><i class="fas fa-angle-double-left fa-2x text-white p-2" aria-hidden="true"></i></span>
				<span id="next-btn" class="next-btn"><i class="fas fa-angle-double-right fa-2x text-white p-2" aria-hidden="true"></i></span>
			</div>
    		
        	
			<figcaption class="postImagesFigcaption text-center text-white font-weight-bold position-relative">
    			<p class="h4 mb-0"><?= $postImage['title']; ?>
    			<p class="h5 mb-0"><?= $postImage['country'].', <em class="h6">'.$postImage['city'] ?></em></p>
  			</figcaption>
      	</figure>
      
   		
  		<?php
  		}
  		?>

 
    </div>
</section>

<section id="container" class="jumbotron container border border-dark">

	<div id="container" class="container text-justify pl-0">
		
		<p>
			<?= html_entity_decode(nl2br(htmlspecialchars($post['content']))) ?>
		</p>

		<p class="text-md-right text-info">
			<em>le <?= $post['date_fr'] ?></em>
		</p>

		<?php 
		if ($post['date_fr'] < $post['date_update_fr']) {
			echo '<p class="text-md-right text-info"><em>modifié le ' . $post['date_update_fr'] . '</em></p>';
		}
		?>

	</div>
</section>


<section id="container" class="jumbotron container border border-dark">
	<h4 class="post-h4">Récits récents</h4>
	<hr>
	<ul class="list-unstyled">
		<?php foreach ($recentPosts as $recentPost) {
			if ($recentPost['id'] === $_GET['id']) {
		?>
				<li></li>
		
			<?php
			} else {
			?>

				<li><a href="index.php?action=post&id=<?= $recentPost['id']; ?>" class="text-decoration-none text-info font-weight-bold"><?= $recentPost['title']; ?></a></li>
		
			<?php
			}
			?>
			
        <?php
    	}
        ?>

    </ul>
</section>
<br>

<section id="container" class="jumbotron container border border-dark">
	<h2>Commentaires</h2></br>

	<?php
	if (isset($_GET['report']) && $_GET['report'] === 'success') {
		echo "<div class='text-center d-flex justify-content-center'><p id='success' class='bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Le commentaire a bien été signalé</p></div>";
	}

		while ($comment = $comments->fetch()) {
	?>

			<div class="shadow p-3 bg-white rounded-lg mb-4">
				<p class="pl-3"><strong><?= htmlspecialchars($comment['author']); ?></strong> le <?= $comment['date_fra']; ?></p>
				<p class="pl-3 comment"><?= nl2br(htmlspecialchars($comment['content'])); ?></p>

				<?php 
				if (!empty($_SESSION)) {
					if (in_array($comment['id'], $idComment) && $comment['author'] !== $_SESSION['pseudo']) {
						echo "<p class='text-md-right text-danger font-italic'>Ce commentaire a été signalé</p>";
					}
				}
				?>

				<?php
				if (!empty($_SESSION)) {
					if (!in_array($comment['id'], $idComment) && $comment['author'] !== $_SESSION['pseudo']) {
						echo '<div class="text-right text-danger font-italic alert-btn"><a class="btn btn-danger text-right reportButton" href="index.php?action=report&id=' . $comment['post_id'] . '&comment-id=' . $comment['id'] . '"><i class="fas fa-exclamation-triangle mr-2"></i>Signaler</a></div>';
					}
					
				}
				?>

			</div>

	<?php
		}
	?>

</section>
		
<?php
	if (!empty($_SESSION)) {
?>
		<div id="container" class="jumbotron container border border-dark">
			<h3>Laisser un commentaire</h3></br>
			<form action="index.php?action=addComment&id=<?= $post['id']; ?>" method="POST">
				<div class="form-group">
		    		<label for="comment">Votre commentaire :</label>
		    		<textarea id="comment" name="content" class="form-control"></textarea>
		    	</div><br />
		    	<input type="submit" value="Envoyer" class="btn btn-info send-btn">
			</form>
	  	</div>
<?php 
    } else {
    	echo '<div class="text-center d-flex justify-content-center"><p class="bg-danger rounded-lg text-white p-2">Pour laisser un commentaire, veuillez vous <a class="text-info" href="index.php?action=login">connecter</a></p></div>';
    }
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="public/js/initPostSlider.js"></script>