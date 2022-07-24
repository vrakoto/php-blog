<?php

class CreationBlog extends Commun {
    private $titre;
    private $intituleCategorie;
    private $description;
    private $visibiliteBlog;

    function __construct(string $titre, string $intituleCategorie, string $description, int $visibiliteBlog)
    {
        parent::__construct();
        $this->titre = $titre;
        $this->intituleCategorie = $intituleCategorie;
        $this->description = $description;
        $this->visibiliteBlog = $visibiliteBlog;
    }

    function verifierCreation(): bool
    {
        return empty($this->getErreurs());
    }


    function validCategorie(): bool
    {
        $req = "SELECT intitule FROM categorie
                WHERE intitule = :categorie";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'categorie' => $this->intituleCategorie
        ]);

        return !empty($p->fetch());
    }

    function getErreurs(): array
    {
        $erreurs = [];
        if (strlen($this->titre) < 3) {
            $erreurs['titreBlog'] = "Le titre est trop court";
        }
        if (!$this->validCategorie()) {
            $erreurs['categorie'] = "La catégorie sélectionnée est inexistante";
        }
        if (strlen($this->description) < 5) {
            $erreurs['description'] = "La description est trop courte";
        }
        return $erreurs;
    }

    function creerBlog(): bool
    {
        $req = "INSERT INTO blog (intitule_categorie, auteur, titre, description, privation) VALUES (:intitule_categorie, :auteur, :titre, :description, :privation)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'intitule_categorie' => $this->intituleCategorie,
            'auteur' => $this->identifiant,
            'titre' => $this->titre,
            'description' => $this->description,
            'privation' => $this->visibiliteBlog
        ]);
    }
}