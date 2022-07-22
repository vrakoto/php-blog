<?php
switch ($action) {
    case 'connexion':
        $erreurs = [];
        $title = "Connexion";
        if (!empty($_POST)) {
            require_once MODELS_VISITEUR . 'Connexion.php';
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
        require_once VUES_VISITEUR . 'connexion.php';
    break;

    case 'inscription':
        $erreurs = [];
        $title = "Inscription";
        if (!empty($_POST)) {
            require_once MODELS_VISITEUR . 'Inscription.php';
            $identifiant = htmlspecialchars(trim($_POST['identifiant']));
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $mdp = htmlspecialchars(trim($_POST['mdp']));
            $mdpc = htmlspecialchars(trim($_POST['mdpc']));

            $inscription = new Inscription($identifiant, $nom, $prenom, $mdp, $mdpc);
            if (!$inscription->verifierInscription()) {
                $erreur = 'Le formulaire est incorrect :';
                $erreurs = $inscription->getErreurs();
            } else {
                try {
                    $inscription->inscrire();
                    header('index.php?p=accueil');
                    exit();
                } catch (\Throwable $th) {
                    $erreur = "Erreur interne rencontrée lors de l'inscription";
                }
            }
        }
        require_once VUES_VISITEUR . 'inscription.php';
    break;

    default:
        $swapController = $action;
    break;
}
