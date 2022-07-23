<div class="text-center">
    <h1 class="mb-4 ">Les catégories</h1>
    <div class="categories">
        <a href="index.php?p=lesBlogs&categorie=toutes" class="btn btn-<?= ($categorieRequest === 'toutes') ? "primary" : "secondary" ?>">Toutes</a>
        <?php foreach ($categories as $categorie) :
            $laCateg = htmlentities($categorie['intitule']);
            if ($laCateg === $categorieRequest) {
                $active = 'primary';
            } else {
                $active = 'secondary';
            }
        ?>
            <a href="index.php?p=lesBlogs&categorie=<?= $laCateg ?>" class="btn btn-<?= $active ?>"><?= ucfirst($laCateg) ?></a>
        <?php endforeach ?>
    </div>

    <div class="container mt-4">
        <input type="text" class="form-control" oninput="rechercherBlog(this)" placeholder="Rechercher un blog" autofocus>
    </div>

</div>
<hr class="mt-5">
<?php if (empty(trim($categorieRequest))) : ?>
    <h1 class="text-center">Les nouveautés</h1>
<?php endif ?>
<div class="d-flex justify-content-center flex-wrap mt-3">
    <?php require_once COMPONENTS . 'blog.php' ?>
</div>