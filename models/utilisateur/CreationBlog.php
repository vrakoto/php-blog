<?php

class CreationBlog extends Commun {
    private $titre;
    private $intituleCategorie;
    private $description;

    function __construct(string $titre, string $intituleCategorie, string $description)
    {
        parent::__construct();
        $this->titre = $titre;
        $this->intituleCategorie = $intituleCategorie;
        $this->description = $description;
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
        $req = "INSERT INTO blog (intitule_categorie, titre, description) VALUES (:intitule_categorie, :titre, :description)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'intitule_categorie' => $this->intituleCategorie,
            'titre' => $this->titre,
            'description' => $this->description
        ]);
    }
}