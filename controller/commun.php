<?php
$pdo = new Commun; // PROVISOIRE A ENLEVER EN PROD
if (!empty($swapController)) {
    switch ($swapController) {
        case 'accueil':
            $title = "Accueil";
            require_once VUES . 'accueil.php';
        break;

        case 'blog':
            $title = "Blog";
            $categorieRequest = '';
            $categories = $pdo->getLesCategories();
            if (isset($_REQUEST['categorie'])) {
                $categorieRequest = htmlentities($_REQUEST['categorie']);
                $active = '';
            }
            require_once VUES . 'blog.php';
        break;
    
        default:
            $title = "Projet Blog - 404 Not Found";
            require_once VUES . '404.php';
        break;
    }
}