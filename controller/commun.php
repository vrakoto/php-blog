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
            require_once VUES . 'lesBlogs.php';
        break;

        case 'blog':
            if (isset($_REQUEST['id'])) {
                $id = (int)$_REQUEST['id'];
                $title = "Consulter Blog n°" . $id;
                try {
                    $blog = $pdo->getLeBlog($id);
                    $lesCommentaires = $pdo->getLesCommentairesBlog($id);
                    require_once COMPONENTS .  'variablesBlog.php';
                    require_once VUES . 'consulterBlog.php';
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la récupération des informations du blog";
                }
            } else {
                header('Location:index.php?p=lesBlogs');
                exit();
            }
        break;

        case 'utilisateur':
            if (isset($_REQUEST['id'])) {
                $identifiant = htmlspecialchars($_REQUEST['identifiant']);
                $title = "Consulter le profil de " . $identifiant;
                try {
                    require_once COMPONENTS .  'variablesBlog.php';
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