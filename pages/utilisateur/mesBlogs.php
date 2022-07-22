<div class="container mt-5">
    <?php if (isset($noItems)): ?>
        <div class="text-center">
            <h1><?= $noItems ?></h1>
            <br>
            <a href="index.php?p=creationBlog" class="btn btn-success">Créez votre premier blog !</a>
        </div>
    <?php else: ?>
        <h3 class="text-center">Mes blogs</h3>
        <input type="text" class="form-control mt-3" oninput="rechercherBlog(this)" placeholder="Rechercher un blog" autofocus>

        <div class="d-flex justify-content-center mt-5">
            <?php require_once COMPONENTS . 'blog.php' ?>
        </div>
    <?php endif ?>
</div>