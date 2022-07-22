<?php

class Inscription extends Commun {
    private $identifiant_inscription;
    private $nom;
    private $prenom;
    private $mdp;
    private $mdp_confirm;

    function __construct(string $identifiant_inscription, string $nom, string $prenom, string $mdp, string $mdp_confirm)
    {
        parent::__construct();
        $this->identifiant_inscription = $identifiant_inscription;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
        $this->mdp_confirm = $mdp_confirm;
    }

    function verifierInscription(): bool
    {
        return empty($this->getErreurs());
    }


    function identifiantExistant(string $identifiant_inscription): bool
    {
        $req = "SELECT identifiant FROM utilisateur WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $identifiant_inscription
        ]);

        return !empty($p->fetch());
    }

    function getErreurs(): array
    {
        $erreurs = [];
        if (strlen($this->identifiant_inscription) < 2) {
            $erreurs['identifiant'] = "L'identifiant est trop court";
        }
        if ($this->identifiantExistant($this->identifiant_inscription)) {
            $erreurs['identifiant'] = "Cet identifiant a déjà été prit";
        }
        if (strlen($this->nom) < 2) {
            $erreurs['nom'] = "Le nom est trop court";
        }
        if (strlen($this->prenom) < 2) {
            $erreurs['prenom'] = "Le prénom est trop court";
        }
        if (strlen($this->mdp) < 3) {
            $erreurs['mdp'] = "Le mot de passe est trop court";
        }
        if ($this->mdp_confirm !== $this->mdp) {
            $erreurs['mdpc'] = "Les mots de passes ne correspondent pas";
        }
        return $erreurs;
    }

    function inscrire(): bool
    {
        $req = "INSERT INTO utilisateur (identifiant, nom, prenom, mdp) VALUES (:identifiant, :nom, :prenom, :mdp)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'identifiant' => $this->identifiant_inscription,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'mdp' => password_hash($this->mdp,  PASSWORD_DEFAULT, ['cost' => 12])
        ]);
    }
}