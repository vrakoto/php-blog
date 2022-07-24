<?php foreach ($lesBlogs as $blog) :
    require 'variablesBlog.php';
?>
    <div class="leBlog card mx-3 mt-3" style="width: 18rem;">
        <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="card-img-top" alt="Image d'un blog">
        <div class="card-body">
            <h5 class="card-title" title="<?= $titre ?>"><?= (strlen($titre) > 28) ? substr($titre,0,35).'...' : $titre ?></h5>
            <p><?= (strlen($description) > 128) ? substr($description,0,125).'...' : $description ?></p>

            <div class="bottomCard">
                <?php if ($privation !== 0) : ?>

                    <?php if (!$monBlog) : ?>
                        <?php if ($autorise) : ?>
                            <div class="alert alert-success text-center">
                                <i class='fa-solid fa-check'></i> Autorisé
                            </div>
                            <a href="index.php?p=blog&id=<?= $id ?>" class="btn btn-primary">Consulter</a>
                        <?php else : ?>
                            <div class="alert alert-danger text-center">
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