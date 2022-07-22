<?php

class Utilisateur extends Commun {
    function __construct()
    {
        parent::__construct();
    }

    function deconnexion(): void
    {
        unset($_SESSION['identifiant']);
        header('Location:index.php?p=accueil');
        exit();
    }
}