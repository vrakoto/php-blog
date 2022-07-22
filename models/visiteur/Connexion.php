<?php

class Connexion extends Commun {
    private $identifiant_connexion;
    private $mdp;

    function __construct(string $identifiant_connexion, string $mdp)
    {
        parent::__construct();
        $this->identifiant_connexion = $identifiant_connexion;
        $this->mdp = $mdp;
    }

    function getPasswordToVerify(): string
    {
        $req = "SELECT mdp FROM utilisateur WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $this->identifiant_connexion
        ]);

        return $p->fetch()['mdp'];
    }

    function verifierAuth(): bool
    {
        $req = "SELECT * FROM utilisateur WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $this->identifiant_connexion
        ]);

        return !empty($p->fetch()) && password_verify($this->mdp, $this->getPasswordToVerify());
    }

    function connexion(): void
    {
        $_SESSION['identifiant'] = $this->identifiant_connexion;
        header('Location:index.php?p=accueil');
        exit();
    }
}