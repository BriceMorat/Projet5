<?php $title = 'Tableau de bord'; ?>

<?php ob_start(); ?>

<section class="container">
    <div id="container" class="jumbotron container border border-dark">

        <h1 class="post-h4">Bienvenue <small><?php echo $_SESSION['pseudo']; ?></small></h2>
        <hr>
        <br/>
        <p>
            <a class="btn btn-dark" href="index.php?action=createPost" role="button">Ajouter un nouveau récit</a>
        </p>
    </div>
    <br/><br/>

    <div class="row justify-content-center">
        <div id="container" class="col-xl-7 jumbotron container border border-dark">
            <h4>Tous vos récits</h4>
            <hr>
            <br/>
            <table class="table table-striped table-borderless border border-dark">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Titre de l'article</th>
                        <th scope="col">Pays visité</th>
                        <th scope="col">Ville ou endroit visité</th>
                        <th scope="col">Date de publication</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <?php
                while ($postsUser = $postsByUser->fetch()) {

                ?>

                <tbody>
                    <tr>
                        <th scope="row" class="my-auto"><a class="text-decoration-none text-info" href="index.php?action=post&id=<?= $postsUser['id']; ?>"><?= $postsUser['title']; ?></a></th>
                        <td><h6><?= $postsUser['country'] ?></h6></td>
                        <td><h6><?= $postsUser['city'] ?></h6></td>
                        <td><h6><em>le <?= $postsUser['date_fr'] ?></em></h6></td>
                        <td class="text-right">
                            <button type="button" class="btn btn-success mr-1" title="Éditer"><a href="index.php?action=updatePost&id=<?= $postsUser['id']; ?>"><i class="fas fa-edit text-white"></i></a></button>
                            <button type="button" class="removepost btn btn-danger bg-danger" title="Supprimer" data-toggle="modal" data-target="#postModal<?= $postsUser['id']; ?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                </tbody>

                       
                <div class="modal fade" id="postModal<?= $postsUser['id']; ?>" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Suppression de l'article</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer l'article <span class="text-info font-weight-bold"><?= $postsUser['title']; ?></span> ?</p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary bg-secondary" href="index.php?action=deletePost&id=<?= $postsUser['id']; ?>">Oui</a>
                                <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Non</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>

            </table>
        </div>

        <div id="container" class="col-xl-4 jumbotron container border border-dark">
            <h4>Vos informations personnelles</h4>
            <hr>
            <br/>
            <form method="POST" action="index.php?action=updatePassword">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label font-weight-bold">Pseudo</label>
                    <div class="col-sm-8">
                      <input type="text" readonly class="form-control-plaintext" id="name" name="name" value="<?php echo $_SESSION['pseudo']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label font-weight-bold">Email</label>
                    <div class="col-sm-8">
                      <input type="text" readonly class="form-control-plaintext" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label font-weight-bold">Mot de passe</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="psw" name="psw">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm-password" class="col-sm-4 col-form-label font-weight-bold">Confirmer votre mot de passe</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="psw_confirm" name="psw_confirm">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="update-pass" class="btn btn-success">Changer votre mot de passe</button>
                </div>
            </form>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


