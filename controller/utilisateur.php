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

            $titreBlog = htmlspecialchars($_POST['titreBlog']);
            if (isset($_POST['categorie'])) {
                $categorie = htmlspecialchars($_POST['categorie']);
            } else {
                $categorie = 'Aucune';
            }
            $description = htmlspecialchars($_POST['description']);

            $blog = new CreationBlog($titreBlog, $categorie, $description);
            
            if (!$blog->verifierCreation()) {
                $erreur = 'Le formulaire est incorrect :';
                $erreurs = $blog->getErreurs();
            } else {
                try {
                    $blog->creerBlog();
                    header('Location:index.php?p=blog');
                    exit();
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la création du blog";
                }
            }
        }
        require_once VUES_UTILISATEUR . 'creationBlog.php';
    break;

    case 'mesBlogs':
        $lesBlogs = $utilisateur->getLesBlogsUtilisateur($monIdentifiant);
        if (count($lesBlogs) <= 0) {
            $noItems = "Vous n'avez aucun blog.";
        }
        require_once VUES_UTILISATEUR . 'mesBlogs.php';
    break;


    case 'supprimerBlog':
        $idBlog = (int)$_REQUEST['id'];
        try {
            $utilisateur->supprimerBlog($idBlog);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            $erreur = "Erreur interne rencontrée lors de la suppression du blog";
        }
    break;

    default:
        $swapController = $action;
    break;
}
