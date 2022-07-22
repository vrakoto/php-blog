<?php
define("MODELS_UTILISATEUR", MODELS . 'utilisateur' . DIRECTORY_SEPARATOR);
require_once MODELS_UTILISATEUR . 'Utilisateur.php';
$utilisateur = new Utilisateur;

switch ($action) {
    case 'deconnexion':
        $utilisateur->deconnexion();
    break;

    default:
        $swapController = $action;
    break;
}
