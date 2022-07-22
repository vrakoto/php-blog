<?php
session_start();

if (!isset($_REQUEST['p'])) {
    header("Location:index.php?p=accueil");
    exit();
}
$page = $_REQUEST['p'];

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

define("PUBLIC_FOLDER", ROOT . DIRECTORY_SEPARATOR);
define("CONTROLLER", ROOT . 'controller' . DIRECTORY_SEPARATOR);
define("USER_CONTROLLER", CONTROLLER . 'user' . DIRECTORY_SEPARATOR);
define("VISITEUR_CONTROLLER", CONTROLLER . 'user' . DIRECTORY_SEPARATOR);

define("VUES", ROOT . 'pages' . DIRECTORY_SEPARATOR);
define("VUES_UTILISATEUR", VUES . 'client' .DIRECTORY_SEPARATOR);
define("VUES_VISITEUR", VUES . 'visiteur' .DIRECTORY_SEPARATOR);

define("ELEMENTS", ROOT . 'elements' . DIRECTORY_SEPARATOR);

define("FONCTIONS", ROOT . 'fonctions' . DIRECTORY_SEPARATOR);

define("MODELS", ROOT . 'models' . DIRECTORY_SEPARATOR);

define("CSS", 'CSS' . DIRECTORY_SEPARATOR);
define("FONT_AWESOME", CSS . 'fontawesome' . DIRECTORY_SEPARATOR);
define("JS", 'JS' . DIRECTORY_SEPARATOR);
define("JS_UTILS", JS . 'utils' . DIRECTORY_SEPARATOR);

require_once MODELS . 'Commun.php';
require_once FONCTIONS . 'helper.php';

if (!isset($_REQUEST['p'])) {
    header('Location:index.php?p=accueil');
    exit();
}
$action = $_REQUEST['p'];

$pdo = new Commun;
$estConnecte = $pdo->estConnecte();
$monIdentifiant = $pdo->getMonIdentifiant();

ob_start();
$swapController = '';

if (!$estConnecte) {
    require_once CONTROLLER . 'visiteur.php';
} else {
    require_once USER_CONTROLLER . 'index.php';
}
require_once CONTROLLER . 'commun.php';

$pageContent = ob_get_clean();
require_once ELEMENTS . 'layout.php';