<?php
if (!empty($swapController)) {
    switch ($swapController) {
        case 'accueil':
            $title = "Accueil";
            require_once VUES . 'accueil.php';
        break;
    
        default:
            $title = "Projet Blog - 404 Not Found";
            require_once VUES . '404.php';
        break;
    }
}