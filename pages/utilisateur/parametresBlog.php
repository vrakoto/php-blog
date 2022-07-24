<div class="container">
    <div class="row">
        <form class="border bg-success text-white col-sm mt-5 p-3 mx-3" method="POST">
            <h3 class="text-center">Donner accès</h3>
            <input type="text" class="form-control mt-3 mb-3" oninput="rechercherCategorie(this)" placeholder="Rechercher un utilisateur" autofocus>
            <select name="<?= $varAddUser ?>[]" class="form-select" multiple>
                <?php foreach ($potentielsInviter as $infosUser) :
                    require COMPONENTS . 'variablesUtilisateur.php'
                ?>
                    <option class="lesCategories" value="<?= $identifiant ?>">@<?= $identifiant . ' - ' . strtoupper($nom) . ' ' . ucfirst($prenom) ?></option>
                <?php endforeach ?>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Donner accès</button>
        </form>

        <form class="border bg-danger text-white col-sm mt-5 p-3" method="POST">
            <h3 class="text-center">Retirer accès</h3>
            <input type="text" class="form-control mt-3 mb-3" oninput="rechercherCategorie(this)" placeholder="Rechercher un utilisateur" autofocus>
            <select name="<?= $varDeleteUser ?>[]" class="form-select" multiple>
                <?php foreach ($lesUtilisateursAcces as $infos) :
                    require COMPONENTS . 'variablesBlog_acces.php';
                ?>
                    <option class="lesCategories" value="<?= $demandeur ?>">@<?= $demandeur . ' - ' . strtoupper($nom) . ' ' . ucfirst($prenom) ?></option>
                <?php endforeach ?>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Retirer accès</button>
            <a href="index.php?p=parametresBlog&id=<?= $idBlog ?>&retirerPrivation" class="btn btn-warning mt-3">Rendre public le blog</a>
        </form>
    </div>
</div>