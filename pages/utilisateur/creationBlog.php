<form class="container border p-3 mt-5" action="index.php?p=creationBlog" method="POST">
    <h3 class="text-center mb-3">Veuillez remplir le formulaire</h3>

    <?= form_input_label('titreBlog', 'text', 'Titre du blog', $erreurs, true, 'autofocus') ?>

    <div class="mb-4 mt-4">
        <input type="text" class="form-input mb-2" oninput="rechercherCategorie(this)" placeholder="Rechercher une catégorie">
        <select name="categorie" class="form-select" multiple>
            <?php foreach ($categories as $c):
                $laCateg = htmlentities($c['intitule']);
            ?>
                <option class="lesCategories" id="<?= $laCateg ?>" value="<?= $laCateg ?>"><?= ucfirst($laCateg) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <?= form_input_label('description', 'text', 'Description', $erreurs, true) ?>

    <div class="form-text">Une fois créé, les blogs crées ne peuvent pas être modifiés.</div>
    <button type="submit" class="btn btn-success">Créer le blog</button>
</form>