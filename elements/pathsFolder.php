<?php
define("COMPONENTS", ELEMENTS . 'components' . DIRECTORY_SEPARATOR);

define("PUBLIC_FOLDER", ROOT . DIRECTORY_SEPARATOR);
define("CONTROLLER", ROOT . 'controller' . DIRECTORY_SEPARATOR);
define("COMMUN_CONTROLLER", CONTROLLER . 'commun.php');
define("USER_CONTROLLER", CONTROLLER . 'utilisateur.php');
define("VISITEUR_CONTROLLER", CONTROLLER . 'visiteur.php');

define("VUES", ROOT . 'pages' . DIRECTORY_SEPARATOR);
define("VUES_UTILISATEUR", VUES . 'utilisateur' .DIRECTORY_SEPARATOR);
define("VUES_VISITEUR", VUES . 'visiteur' .DIRECTORY_SEPARATOR);

define("FONCTIONS", ROOT . 'fonctions' . DIRECTORY_SEPARATOR);

define("MODELS", ROOT . 'models' . DIRECTORY_SEPARATOR);
define("MODELS_VISITEUR", MODELS . 'visiteur' . DIRECTORY_SEPARATOR);

define("CSS", 'CSS' . DIRECTORY_SEPARATOR);
define("ICON", 'icon' . DIRECTORY_SEPARATOR);
define("FONT_AWESOME", CSS . 'fontawesome' . DIRECTORY_SEPARATOR);
define("JS", 'JS' . DIRECTORY_SEPARATOR);
define("JS_UTILS", JS . 'utils' . DIRECTORY_SEPARATOR);