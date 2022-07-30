<form class="container border p-3 mt-5" action="index.php?p=creationBlog" method="POST">
    <h3 class="text-center mb-3">Veuillez remplir le formulaire</h3>

    <?= form_input_label('titreBlog', 'text', 'Titre du blog', $erreurs, true) ?>

    <div class="mb-4 mt-4 border p-2">
        <h5>Sélectionner une catégorie</h5>
        <?php foreach ($categories as $c) :
            $laCateg = htmlentities($c['intitule']);
        ?>
            <div class="form-check">
                <input class="<?php if (isset($erreurs['categorie'])): ?>is-invalid<?php endif ?> form-check-input" type="radio" name="categorie" value="<?= $laCateg ?>" id="<?= $laCateg ?>" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === $laCateg) : ?>checked<?php endif ?>>
                <label class="form-check-label" for="<?= $laCateg ?>"><?= ucfirst($laCateg) ?></label>
            </div>
        <?php endforeach ?>
    </div>
    <?= form_input_label('description', 'text', 'Description', $erreurs, true) ?>

    <hr>

    <div class="mb-3 form-check">
        <input type="checkbox" name="blogVisibilite" class="form-check-input" id="blogVisibilite" <?php if (isset($_POST['blogVisibilite'])): ?>checked<?php endif ?>>
        <label class="form-check-label" for="blogVisibilite">Privatiser la visibilité de ce blog (accès via autorisation)</label>
    </div>

    <div class="form-text">Une fois créé, les blogs ne peuvent pas être modifiés.</div>
    <button type="submit" class="btn btn-success">Créer le blog</button>
</form>