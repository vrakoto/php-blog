<?php
$pdo = new Commun; // PROVISOIRE A ENLEVER EN PROD
define("MODELS_UTILISATEUR", MODELS . 'utilisateur' . DIRECTORY_SEPARATOR);
require_once MODELS_UTILISATEUR . 'Utilisateur.php';
$utilisateur = new Utilisateur;


switch ($action) {
    case 'deconnexion':
        $utilisateur->deconnexion();
    break;

    case 'parametres':
        $infosUser = $pdo->getUtilisateur($monIdentifiant);
        $lesParams = $pdo->getLesParametresUtilisateur($monIdentifiant);
        require_once COMPONENTS . 'variablesUtilisateur.php';
        require_once VUES_UTILISATEUR . 'parametres.php';
    break;

    case 'updateMonProfil':
        if (isset($_POST['avatar'], $_POST['nom'], $_POST['prenom'])) {
            require_once MODELS_UTILISATEUR . 'Profil.php';
            $avatar = htmlspecialchars($_POST['avatar']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);

            $profil = new Profil($avatar, $nom, $prenom);

            if (!$profil->verifierProfil()) {
                $erreur = "Les informations sont incorrectes, aucun changement n'a été effectué";
                $erreurs = $profil->getErreurs();
            } else {
                try {
                    $profil->update();
                    $success = "Profil modifié !";
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la mise à jour du profil";
                }
            }
        }

        /* if (isset($_POST['params'])) {
            $lesParams = $pdo->getLesParametresUtilisateur($monIdentifiant);
            foreach ($lesParams as $param) {
                require COMPONENTS . 'variablesParametres.php';
                try {
                    $utilisateur->updateParametre($varParam, $checked);
                } catch (\Throwable $th) {
                    var_dump($th);
                }
            }
        } */
    break;

    case 'creationBlog':
        $erreurs = [];
        $categories = $pdo->getLesCategories();
        if (isset($_POST['titreBlog'], $_POST['categorie'], $_POST['description'])) {
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


    case 'ajouterCommentaire':
        if (isset($_REQUEST['idBlog'], $_POST['commentaire'])) {
            $idBlog = (int)$_REQUEST['idBlog'];
            $commentaire = htmlspecialchars($_POST['commentaire']);
            if (empty(trim($commentaire))) {
                $erreur = "Le commentaire ne doit pas être vide";
            } else {
                try {
                    $utilisateur->ajouterCommentaire($idBlog, $commentaire);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de l'ajout du commentaire";
                }
            }
        } else {
            header('Location:index.php?p=lesBlogs');
            exit();
        }
    break;

    case 'supprimerCommentaire':
        $idCommentaire = (int)$_REQUEST['id'];
        try {
            $utilisateur->supprimerCommentaire($idCommentaire);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            $erreur = "Erreur interne rencontrée lors de la suppression du commentaire";
        }
    break;

    default:
        $swapController = $action;
    break;
}
