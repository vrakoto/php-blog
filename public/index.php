<?php
session_start();

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("ELEMENTS", ROOT . 'elements' . DIRECTORY_SEPARATOR);
require_once ELEMENTS . 'pathsFolder.php';

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
    require_once VISITEUR_CONTROLLER;
} else {
    require_once USER_CONTROLLER;
}
require_once COMMUN_CONTROLLER;

$pageContent = ob_get_clean();
require_once ELEMENTS . 'layout.php';