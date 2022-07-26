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

    case 'parametresBlog':
        if (isset($_REQUEST['id'])) {
            $idBlog = (int)$_REQUEST['id'];
            
            if (!$pdo->estMonBlog($idBlog)) {
                $erreur = "Ce blog ne vous appartient pas";
            }

            if (empty($erreur)) {
                $potentielsInviter = $utilisateur->getLesUtilisateursAInviter($idBlog);
                $lesUtilisateursAcces = $utilisateur->getLesUtilisateursInvites($idBlog);
                $varAddUser = "utilisateurs_ajouter";
                $varDeleteUser = "utilisateurs_retirer";

                if (isset($_REQUEST['ajouterPrivation'], $_REQUEST['id'])) {
                    $idBlog = (int)$_REQUEST['id'];
    
                    try {
                        $utilisateur->ajouterPrivation($idBlog);
                        header('Location:index.php?p=blog&id=' . $idBlog);
                        exit();
                    } catch (\Throwable $th) {
                        $erreur = "Erreur interne rencontrée lors de la privatisation du blog";
                    }
                }
                if (isset($_REQUEST['retirerPrivation'], $_REQUEST['id'])) {
                    $idBlog = (int)$_REQUEST['id'];
        
                    try {
                        $utilisateur->retirerPrivation($idBlog);
                        header('Location:index.php?p=blog&id=' . $idBlog);
                        exit();
                    } catch (\Throwable $th) {
                        $erreur = "Erreur interne rencontrée lors de la mise en publication publique du blog";
                    }
                }


    
                if (isset($_POST[$varAddUser])) {
                    $lesUtilisateursAutorises = $_POST[$varAddUser];
                    try {
                        foreach ($lesUtilisateursAutorises as $identifiant) {
                            $utilisateur->autoriserAcces($idBlog, $identifiant);
                        }
                        header('Location:index.php?p=parametresBlog&id=' . $idBlog);
                        exit();
                    } catch (\Throwable $th) {
                        $erreur = "Erreur interne rencontrée lors de la mise à jour des paramètres du blog";
                    }
                }
    
                if (isset($_POST[$varDeleteUser])) {
                    $lesUtilisateursRetires = $_POST[$varDeleteUser];
    
                    try {
                        foreach ($lesUtilisateursRetires as $identifiant) {
                            $utilisateur->retirerAcces($idBlog, $identifiant);
                        }
                        header('Location:index.php?p=parametresBlog&id=' . $idBlog);
                        exit();
                    } catch (\Throwable $th) {
                        $erreur = "Erreur interne rencontrée lors de la mise à jour des paramètres du blog";
                    }
                }
    
                require_once VUES_UTILISATEUR . 'parametresBlog.php';
            }
        }
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

        $lesParams = $pdo->getLesParametresUtilisateur($monIdentifiant);
        if (isset($_POST['params'])) {
            try {
                foreach ($_POST['params'] as $param) {
                    $leParam = htmlspecialchars($param);
                    $utilisateur->updateParametre($param);
                }
            } catch (\Throwable $th) {
                $erreur = "Erreur interne rencontrée lors de la mise à jour de votre paramètre de visibilité";
            }
        } else {
            foreach ($lesParams as $param) {
                require COMPONENTS . 'variablesParametres.php';
                try {
                    $utilisateur->updateParametre($varParam, 0);
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la mise à jour de votre paramètre de visibilité";
                }
            }
        }
    break;

    case 'creationBlog':
        $erreurs = [];
        $categories = $pdo->getLesCategories();

        if (isset($_POST['titreBlog'], $_POST['description'])) {
            require_once MODELS_UTILISATEUR . 'CreationBlog.php';

            $titreBlog = htmlspecialchars($_POST['titreBlog']);
            if (isset($_POST['categorie'])) {
                $categorie = htmlspecialchars($_POST['categorie']);
            } else {
                $categorie = 'Aucune';
            }
            $description = htmlspecialchars($_POST['description']);

            if (isset($_POST['blogVisibilite'])) {
                $visibiliteBlog = 1;
            } else {
                $visibiliteBlog = 0;
            }

            $blog = new CreationBlog($titreBlog, $categorie, $description, $visibiliteBlog);
            
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

    case 'supprimerBlog':
        if (isset($_REQUEST['id'])) {
            $idBlog = (int)$_REQUEST['id'];

            if (!$pdo->estMonBlog($idBlog)) {
                $erreur = "Ce blog ne vous appartient pas";
            } else {
                try {
                    $utilisateur->supprimerBlog($idBlog);
    
                    $redirect = htmlspecialchars($_SERVER['HTTP_REDIRECT']);
                    if (isset($_REQUEST['redirect'])) {
                        $redirect = htmlspecialchars($_REQUEST['redirect']);
                    }
                    header('Location:' . $redirect);
                    exit();
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la suppression du blog";
                }
            }
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
            $searchComs = $pdo->getLesCommentaires($monIdentifiant);
            foreach ($searchComs as $com) {
                if ($com['commentateur'] === $monIdentifiant) {
                    $can_delete = TRUE;
                } else if ($utilisateur->estMonBlog($com['idBlog'])) {
                    $can_delete = TRUE;
                }
            }
            if (!isset($can_delete)) {
                $erreur = "Commentaire introuvable.";
            } else {
                $utilisateur->supprimerCommentaire($idCommentaire);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } catch (\Throwable $th) {
            $erreur = "Erreur interne rencontrée lors de la suppression du commentaire";
        }
    break;

    default:
        $swapController = $action;
    break;
}
