<div class="container mt-5">
    <?php if (!empty($noItems)): ?>
        <div class="text-center">
            <?php if ($identifiant === $monIdentifiant): ?>
                <h1>Vous n'avez aucun blog.</h1>
                <br>
                <a href="index.php?p=creationBlog" class="btn btn-success">Créez votre premier blog !</a>
            <?php else: ?>
                <h1>Cet utilisateur n'a créé aucun blog</h1>
            <?php endif ?>
        </div>
    <?php else: ?>
        <h3 class="text-center">Mes blogs</h3>
        <input type="text" class="form-control mt-3" oninput="rechercherBlog(this)" placeholder="Rechercher un blog" autofocus>

        <div class="d-flex flex-wrap justify-content-center mt-5">
            <?php require_once COMPONENTS . 'blog.php' ?>
        </div>
    <?php endif ?>
</div>