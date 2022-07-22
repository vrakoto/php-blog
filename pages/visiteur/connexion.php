<form class="container border p-3" action="index.php?p=connexion" method="POST">
    <h3 class="text-center mb-3">Authentifiez vous</h3>
    <?= form_input_label('identifiant', 'text', 'Identifiant', false, 'autofocus') ?>
    <?= form_input_label('mdp', 'password', 'Mot de passe', false) ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>