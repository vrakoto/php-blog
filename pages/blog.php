<div class="text-center">
    <h1 class="mb-4">Trier par catégorie</h1>
    <div class="categories">
        <a href="index.php?p=blog&categorie=toutes" class="btn btn-<?= ($categorieRequest === 'toutes') ? "primary" : "secondary" ?>">Toutes</a>
        <?php foreach ($categories as $categorie):
            $laCateg = htmlentities($categorie['intitule']);
            if ($laCateg === $categorieRequest) {
                $active = 'primary';
            } else {
                $active = 'secondary';
            }
        ?>
            <a href="index.php?p=blog&categorie=<?= $laCateg ?>" class="btn btn-<?= $active ?>"><?= ucfirst($laCateg) ?></a>
        <?php endforeach ?>
    </div>
    <hr>
    <?php if (empty(trim($categorieRequest))): ?>
        <h1>Les nouveautés</h1>
    <?php endif ?>
</div>