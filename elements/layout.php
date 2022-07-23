<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS . 'bootstrap' . DIRECTORY_SEPARATOR . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href=<?= FONT_AWESOME . 'CSS' . DIRECTORY_SEPARATOR . 'all.min.css' ?>>
    <link rel="stylesheet" href="<?= CSS . 'main.css' ?>">
    <link rel="icon" href="<?= ICON . 'blog.png' ?>">
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
                    <?= nav_link('lesBlogs', 'Les Blogs') ?>
                    <?php if ($estConnecte): ?>
                        <?= nav_link('mesBlogs', 'Mes blogs') ?>
                        <?= nav_link('creationBlog', 'Créer un blog') ?>
                    <?php endif ?>
                </ul>

                <div class="d-flex">
                    <?php if (!$estConnecte): ?>
                        <a class="nav-item btn btn-primary mx-2" href="index.php?p=connexion">Connexion</a>
                        <a class="nav-item btn btn-success" href="index.php?p=inscription">Inscription</a>
                    <?php else: ?>
                        <a class="nav-item btn btn-danger mx-2" href="index.php?p=deconnexion">Deconnexion</a>
                        <a class="nav-item btn btn-secondary" href="index.php?p=parametres"><i class="fa-solid fa-gears"></i></a>
                    <?php endif ?>
                </div>

            </div>
        </div>
    </nav>
    
    <div class="mt-3">
        <div class="container">
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger text-center">
                    <h3><?= $erreur ?></h3>

                    <?php if (isset($erreurs) && !empty($erreurs)): ?>
                        <ul>
                            <?php foreach ($erreurs as $message): ?>
                                <li><?= $message ?></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success text-center">
                    <h3><?= $success ?></h3>
                </div>
            <?php endif ?>
        </div>

        <?= $pageContent ?? '' ?>
    </div>
    
    <script src="<?= JS_UTILS . 'bootstrap.bundle.min.js' ?>"></script>
    <script src="<?= JS . 'main.js' ?>"></script>
</body>

</html>