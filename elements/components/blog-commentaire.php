<?php foreach ($lesCommentaires as $utilisateur) :
    require COMPONENTS . 'variablesCommentaireBlog.php';
?>
    <div class="border mb-3">
        <div class="d-flex justify-content-between m-2">
            <div class="d-flex flex-row align-items-center">
                <img src="<?= $avatar ?>" alt="Avatar de l'utilisateur" class="rounded-circle" width="40" height="40">
                <div>
                    <a title="Consulter le profil de <?= $identifiantCommentateur ?>" href="index.php?p=utilisateur&identifiant=<?= $identifiantCommentateur ?>" class="mb-0"><?= $nom . ' ' . $prenom ?></a>
                    <p class="form-text mt-0"><?= $datePublication ?> <?php if ($enableRefBlog): ?><a href="index.php?p=blog&id=<?= $idBlog ?>">EN RÉFÉRENCE À CE BLOG</a><?php endif ?></p>
                </div>
            </div>

            <?php if ($monCommentaire || $monBlog) : ?>
                <a href="index.php?p=supprimerCommentaire&id=<?= $idCommentaire ?>" class="delete" title="Supprimer ce commentaire"><i class="fa-solid fa-trash"></i></a>
            <?php endif ?>
        </div>
        <p class="text-justify m-0 mx-2 mb-2 ms-2"><?= $commentaire ?></p>
    </div>
<?php endforeach ?>