<?php
$pdo = new Commun; // PROVISOIRE A ENLEVER EN PROD
define("MODELS_UTILISATEUR", MODELS . 'utilisateur' . DIRECTORY_SEPARATOR);
require_once MODELS_UTILISATEUR . 'Utilisateur.php';
$utilisateur = new Utilisateur;


switch ($action) {
    case 'deconnexion':
        $utilisateur->deconnexion();
    break;

    case 'creationBlog':
        $erreurs = [];
        $categories = $pdo->getLesCategories();
        if (!empty($_POST)) {
            require_once MODELS_UTILISATEUR . 'CreationBlog.php';

            $titreBlog = htmlentities($_POST['titreBlog']);
            if (isset($_POST['categorie'])) {
                $categorie = htmlentities($_POST['categorie']);
            } else {
                $categorie = 'Aucune';
            }
            $description = htmlentities($_POST['description']);

            $blog = new CreationBlog($titreBlog, $categorie, $description);
            
            if (!$blog->verifierCreation()) {
                $erreur = 'Le formulaire est incorrect :';
                $erreurs = $blog->getErreurs();
            } else {
                try {
                    $blog->creerBlog();
                    $_SESSION['success'] = 'Votre blog a bien été créé !';
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la création du blog";
                }
            }
        }
        require_once VUES_UTILISATEUR . 'creationBlog.php';
    break;

    default:
        $swapController = $action;
    break;
}
