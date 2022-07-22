<?php

class Commun {
    protected $pdo;
    protected string $identifiant;

    function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $this->identifiant = $_SESSION['identifiant'] ?? '';
    }

    function estConnecte(): bool
    {
        return !empty($this->identifiant);
    }

    function getMonIdentifiant(): string
    {
        return $this->identifiant;
    }

    function getLesCategories(): array
    {
        $req = "SELECT intitule FROM categorie
                ORDER BY 1";
        $p = $this->pdo->query($req);
        return $p->fetchAll();
    }
}