<?php foreach ($lesBlogs as $blog) :
    require 'variablesBlog.php';
?>
    <div class="leBlog card mx-3 mt-3">
        <!-- <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="card-img-top" alt="Image d'un blog"> -->
        <div class="form-text m-0">Par: <a href="index.php?p=utilisateur&identifiant=<?= $auteur ?>"><?= $auteur ?></a> le <?= $dateCreation ?></div>
        <div class="card-body">
            <h5 class="titre" title="<?= $titre ?>"><?= (strlen($titre) > 28) ? substr($titre,0,35).'...' : $titre ?></h5>
            <p class="form-text"><?= $descriptionCastedBlog ?></p>

            <div class="bottomCard">
                <?php if ($privation !== 0) : ?>

                    <?php if (!$monBlog) : ?>
                        <?php if ($autorise) : ?>
                            <div class="alert alert-success text-center mb-1">
                                <i class='fa-solid fa-check'></i> Autorisé
                            </div>
                            <a href="index.php?p=blog&id=<?= $id ?>" class="btn btn-primary">Consulter</a>
                        <?php else : ?>
                            <div class="alert alert-danger text-center mb-1">
                                <i class="fa-solid fa-lock"></i> Ce blog est restreint
                            </div>
                        <?php endif ?>
                    <?php else : ?>
                        <a href="index.php?p=blog&id=<?= $id ?>" class="mt-2 btn btn-primary">Consulter</a>
                        <a href="index.php?p=parametresBlog&id=<?= $id ?>" class="mt-2 btn btn-secondary">Gérer les accès</a>
                        <a href="index.php?p=supprimerBlog&id=<?= $id ?>" class="mt-2 btn btn-danger">Supprimer</a>
                    <?php endif ?>

                <?php else : ?>
                    <a href="index.php?p=blog&id=<?= $id ?>" class="btn btn-primary">Consulter</a>
                    <?php if ($monBlog) : ?>
                        <a href="index.php?p=supprimerBlog&id=<?= $id ?>" class="btn btn-danger">Supprimer</a>
                    <?php endif ?>
                <?php endif ?>
            </div>

        </div>
    </div>
<?php endforeach ?>