<form class="container border p-3" action="index.php?p=inscription" method="POST">
    <h3 class="text-center mb-3">Veuillez remplir le formulaire</h3>
    <?= form_input_label('identifiant', 'text', 'Identifiant', $erreurs, true, 'autofocus') ?>
    <?= form_input_label('nom', 'text', 'Nom', $erreurs) ?>
    <?= form_input_label('prenom', 'text', 'Prénom', $erreurs) ?>
    <?= form_input_label('mdp', 'password', 'Mot de passe', $erreurs) ?>
    <?= form_input_label('mdpc', 'password', 'Confirmez le mot de passe', $erreurs) ?>
    <button type="submit" class="btn btn-success">S'inscrire</button>
</form>