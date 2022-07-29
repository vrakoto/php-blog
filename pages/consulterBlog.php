<div class="mt-5 container consulterBlog">
    <div class="row">
        <div class="col-lg-8 blog">
            <h1 class="text-center mt-3 mb-3"><?= $titre ?></h1>
            <div class="container text-justify">
                <p><?= $description ?></p>
            </div>
        </div>

        <div class="col-lg-4 blog p-0">
            <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="img-fluid" alt="Image du blog">
            <div class="p-2">
                <div class="d-flex align-items-center justify-content-around">
                    <p class="mt-2 mb-2">Auteur</p>
                    <p class="mt-2 mb-2"><?= ($monBlog) ? "<span class='text-success'><i class='fa-solid fa-check'></i> Moi</span>" : "<a href='index.php?p=user&id=$auteur'>$auteur</a>" ?></p>
                </div>

                <hr class="m-0">

                <div class="d-flex align-items-center justify-content-around">
                    <p class="mt-2 mb-2">Catégorie</p>
                    <p class="mt-2 mb-2"><a href="index.php?p=lesBlogs&categorie=<?= strtolower($categorie) ?>"><?= strtoupper($categorie) ?></a></p>
                </div>

                <hr class="m-0">

                <div class="d-flex align-items-center justify-content-around">
                    <p class="mt-2 mb-2">Date de publication</p>
                    <p class="mt-2 mb-2"><?= $dateCreation ?></a></p>
                </div>

                <?php if ($monBlog): ?>
                    <div class="text-center">
                        <?php if ($privation > 0): ?>
                            <a href="index.php?p=parametresBlog&id=<?= $id ?>" class="btn btn-secondary">Paramètres</a>
                        <?php else: ?>
                            <a href="index.php?p=parametresBlog&id=<?= $id ?>&ajouterPrivation" class="btn btn-secondary">Rendre ce blog privé</a>
                        <?php endif ?>
                        <a href="index.php?p=supprimerBlog&id=<?= $id ?>&redirect=index.php?p=mesBlogs" class="btn btn-danger">Supprimer ce blog</a>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="border mt-3">
            <h2 class="mt-3 text-center">Commentaires</h2>

            <div class="container">

                <?php if ($estConnecte) : ?>
                    <form class="d-flex flex-row add-comment-section mt-4 mb-4" action="index.php?p=ajouterCommentaire&idBlog=<?= $id ?>" method="POST">
                        <input type="text" name="commentaire" class="form-control mr-3" placeholder="Ajouter un commentaire" required>
                        <button class="btn btn-success" type="submit">Comment</button>
                    </form>
                <?php else : ?>
                    <div class="text-center">
                        <a href="index.php?p=connexion" title="Accéder à la page de connexion">Authentifiez-vous pour publier un commentaire</a>
                    </div>
                <?php endif ?>

                <?php require_once COMPONENTS . 'blog-commentaire.php' ?>

            </div>
        </div>
    </div>
</div>