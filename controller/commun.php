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

        case 'blog':
            $title = "Blog";
            $categorieRequest = '';
            $categories = $pdo->getLesCategories();
            $lesBlogs = $pdo->getLesBlogs();
            if (isset($_REQUEST['categorie'])) {
                $categorieRequest = htmlentities($_REQUEST['categorie']);
                $active = '';

                $lesBlogs = $pdo->getLesBlogsParCategorie($categorieRequest);
            }

            if (isset($_REQUEST['id'])) {
                $id = (int)$_REQUEST['id'];
                echo $id;
                require_once VUES . 'consulterBlog.php';
            } else {
                require_once VUES . 'blog.php';
            }
        break;
    
        default:
            $title = "Projet Blog - 404 Not Found";
            require_once VUES . '404.php';
        break;
    }
}