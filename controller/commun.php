<?php
$pdo = new Commun; // PROVISOIRE A ENLEVER EN PROD
if (!empty($swapController)) {
    switch ($swapController) {
        case 'accueil':
            $title = "Accueil";
            $nbBlogToday = $pdo->nbCreatedBlogsToday();
            $nbBlogThisWeek = $pdo->nbBlogsThisWeek();
            $nbBlogMonth = $pdo->nbBlogsThisMonth();
            $nbBlogYear = $pdo->nbBlogsThisYear();
            $nbBlogTotal = $pdo->nbBlogsTotal();
            require_once VUES . 'accueil.php';
        break;

        case 'lesBlogs':
            $title = "Les Blogs";
            $categorieRequest = '';
            $categories = $pdo->getLesCategories();
            $lesBlogs = $pdo->getLesNouveautes(5);
            if (isset($_REQUEST['categorie'])) {
                $categorieRequest = htmlentities($_REQUEST['categorie']);
                $active = '';

                $lesBlogs = $pdo->getLesBlogsParCategorie($categorieRequest);
            }

            if (isset($_REQUEST['identifiant'])) {
                $identifiant = htmlspecialchars($_REQUEST['identifiant']);
                try {
                    $lesBlogs = $pdo->getLesBlogsUtilisateur($identifiant);
                    $monProfil = ($monIdentifiant === $identifiant);
                    $noItems = '';
                    if (count($lesBlogs) <= 0) {
                        if ($monProfil) {
                            $noItems = "Vous n'avez aucun blog.";
                        } else {
                            $noItems = "Cet utilisateur n'a créé aucun blog.";
                        }
                    }
                    require_once VUES_UTILISATEUR . 'mesBlogs.php';
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne lors de la récupération des blogs de l'utilisateur";
                }
            } else {
                require_once VUES . 'lesBlogs.php';
            }
        break;

        case 'blog':
            if (isset($_REQUEST['id'])) {
                $id = (int)$_REQUEST['id'];
                $title = "Consulter Blog n°" . $id;
                try {
                    $blog = $pdo->getLeBlog($id);
                    $lesCommentaires = $pdo->getLesCommentaires($id);
                    require_once COMPONENTS .  'variablesBlog.php';

                    if ($privation <= 0 || $monBlog || $autorise) {
                        require_once VUES . 'consulterBlog.php';
                    } else {
                        $erreur = "L'accès à ce blog est restreint, seuls les utilisateurs invités ont le droit d'y accéder";   
                    }
                } catch (\Throwable $th) {
                    $erreur = "Le blog n°" . $id . " n'existe pas";
                }
            } else {
                header('Location:index.php?p=lesBlogs');
                exit();
            }
        break;

        case 'utilisateur':
            if (isset($_REQUEST['identifiant'])) {
                $identifiant = htmlspecialchars($_REQUEST['identifiant']);
                $title = "Consulter le profil de " . $identifiant;
                try {
                    $infosUser = $pdo->getUtilisateur($identifiant);
                    $statistiquesEnabled = ($pdo->getValeurParametre($identifiant, 'statistiques') <= 0) ? FALSE : TRUE;
                    $nbBlogToday = $pdo->nbCreatedBlogsToday($identifiant);
                    $nbBlogThisWeek = $pdo->nbBlogsThisWeek($identifiant);
                    $nbBlogMonth = $pdo->nbBlogsThisMonth($identifiant);
                    $nbBlogYear = $pdo->nbBlogsThisYear($identifiant);
                    $nbBlogTotal = $pdo->nbBlogsTotal($identifiant);
                    
                    $lesBlogs = $pdo->getLesBlogsUtilisateur($identifiant, 4);
                    $phraseSectionBlog = (count($lesBlogs)) > 1 ? "Blogs récents" : "Blog récent";

                    $enableRefBlog = TRUE;
                    $lesCommentaires =  $pdo->getLesCommentaires($identifiant, 4);
                    $phraseSectionCommentaire = (count($lesCommentaires)) > 1 ? "Commentaires récents" : "Commentaire récent";

                    require_once COMPONENTS . 'variablesUtilisateur.php';
                    require_once VUES . 'consulterUtilisateur.php';
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la récupération des informations de l'utilisateur";
                }
            } else {
                header('Location:index.php?p=lesBlogs');
                exit();
            }
        break;
    
        default:
            $title = "Projet Blog - 404 Not Found";
            require_once VUES . '404.php';
        break;
    }
}