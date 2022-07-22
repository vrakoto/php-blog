<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS . 'bootstrap' . DIRECTORY_SEPARATOR . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href=<?= FONT_AWESOME . 'CSS' . DIRECTORY_SEPARATOR . 'all.min.css' ?>>
    <title><?= $title ?? 'Projet Commerce' ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-brand">Blog</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?= nav_link('accueil', 'Accueil') ?>
                    <?= nav_link('blog', 'Blog') ?>
                </ul>
                <div class="d-flex">
                    <?php if (!$connecte): ?>
                        <a class="btn btn-primary mx-2" href="index.php?p=connexion">Connexion</a>
                        <a class="btn btn-success" href="index.php?p=inscription">Inscription</a>
                    <?php else: ?>
                        <a class="btn btn-danger" href="index.php?p=deconnexion">Deconnexion</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

    <?= $pageContent ?? '' ?>
    <script src="<?= JS_UTILS . 'bootstrap.bundle.min.js' ?>"></script>

</body>

</html>