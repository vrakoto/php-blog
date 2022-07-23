<div class="mt-5 container consulterBlog">
    <div class="row">

        <div class="col-sm blog">
            <h1 class="text-center mt-3 mb-3"><?= $titre ?></h1>
            <div class="container text-justify">
                <p><?= $description ?></p>
            </div>
        </div>

        <div class="col-sm blog p-0">
            <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="img-fluid" alt="Image du blog">
            <div class="p-2">
                <h3 class="mb-0">Créé par <a href="index.php?p=user&id=<?= $auteur ?>"><?= $auteur ?></a></h3>
                <div>Catégorie: <a href="index.php?p=blog&categorie=<?= strtolower($categorie) ?>"><?= strtoupper($categorie) ?></a></div>
                <div>Date de publication: <?= $dateCreation ?></div>
            </div>
        </div>

        <div class="border mt-3">
            <h2 class="mt-3 text-center">Commentaires</h2>

            <div class="container">

                <?php if ($estConnecte): ?>
                    <form class="d-flex flex-row add-comment-section mt-4 mb-4" action="index.php?p=ajouterCommentaire&idBlog=<?= $id ?>" method="POST">
                        <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38">
                        <input type="text" name="commentaire" class="form-control mr-3" placeholder="Ajouter un commentaire" required>
                        <button class="btn btn-success" type="submit">Comment</button>
                    </form>
                <?php else: ?>
                    <div class="text-center">
                        <a href="index.php?p=connexion" title="Accéder à la page de connexion">Authentifiez-vous pour publier un commentaire</a>
                    </div>
                <?php endif ?>

                <?php foreach ($lesCommentaires as $utilisateur) : 
                    require COMPONENTS . 'variablesCommentaireBlog.php';
                ?>
                    <div class="border mb-3">
                        <div class="d-flex justify-content-between m-2">
                            <div class="d-flex flex-row align-items-center">
                                <img src="https://i.imgur.com/yTFUilP.jpg" alt="Avatar de l'utilisateur" class="rounded-circle" width="40" height="40">
                                <div>
                                    <a title="Consulter le profil de <?= $identifiantCommentateur ?>" href="index.php?p=utilisateur&identifiant=<?= $identifiantCommentateur ?>" class="mb-0"><?= $nom . ' ' . $prenom ?></a>
                                    <p class="form-text mt-0"><?= $datePublication ?></p>
                                </div>
                            </div>

                            <?php if ($estConnecte): ?>
                                <a href="index.php?p=supprimerCommentaire&id=<?= $idCommentaire ?>" class="delete" title="Supprimer ce commentaire"><i class="fa-solid fa-trash"></i></a>
                            <?php endif ?>
                        </div>
                        <p class="text-justify m-0 mx-2 mb-2 ms-2"><?= $commentaire ?></p>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>