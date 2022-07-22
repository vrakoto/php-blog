<?php
switch ($action) {
    case 'connexion':
        if (!empty($_POST)) {
            require_once MODELS_VISITEUR . 'Connexion.php';
            $erreurs = [];
            $identifiant = htmlentities(trim($_POST['identifiant']));
            $mdp = htmlentities(trim($_POST['mdp']));

            $connexion = new Connexion($identifiant, $mdp);
            if (!$connexion->verifierAuth()) {
                $erreur = "L'authentification est incorrect";
            } else {
                try {
                    $connexion->connexion();
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de la tentative de connexion";
                }
            }
        }
        includePages('connexion', 'visiteur');
    break;

    case 'inscription':
        if (!empty($_POST)) {
            require_once MODELS_VISITEUR . 'Inscription.php';
            $erreurs = [];
            $identifiant = htmlentities(trim($_POST['identifiant']));
            $nom = htmlentities(trim($_POST['nom']));
            $prenom = htmlentities(trim($_POST['prenom']));
            $mdp = htmlentities(trim($_POST['mdp']));
            $mdpc = htmlentities(trim($_POST['mdpc']));

            $inscription = new Inscription($identifiant, $nom, $prenom, $mdp, $mdpc);
            if (!$inscription->verifierInscription()) {
                $erreur = 'Le formulaire est incorrect :';
                $erreurs = $inscription->getErreurs();
            } else {
                try {
                    $inscription->inscrire();
                    $success = 'Inscription réussie ! Connectez-vous';
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de l'inscription";
                }
            }
        }
        includePages('inscription', 'visiteur');
    break;

    default:
        $swapController = $action;
    break;
}
