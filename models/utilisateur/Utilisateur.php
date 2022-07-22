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

    function supprimerBlog(int $idBlog): bool
    {
        $req = "DELETE FROM blog
                WHERE id = :id
                AND auteur = :auteur";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'id' => $idBlog,
            'auteur' => $this->identifiant
        ]);
    }
}