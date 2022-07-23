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

    
    function ajouterCommentaire(int $idBlog, string $commentaire): bool
    {
        $req = "INSERT INTO blog_commentaires (idBlog, commentateur, commentaire) VALUES (:idBlog, :commentateur, :commentaire)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idBlog' => $idBlog,
            'commentateur' => $this->identifiant,
            'commentaire' => $commentaire
        ]);
    }

    function supprimerCommentaire(int $idCommentaire): bool
    {
        $req = "DELETE FROM blog_commentaires
                WHERE id = :idCommentaire
                AND commentateur = :commentateur";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idCommentaire' => $idCommentaire,
            'commentateur' => $this->identifiant
        ]);
    }

    
    function updateParametre(string $leParam): bool
    {
        $req = "UPDATE utilisateur_parametres SET
                checked = 1
                WHERE utilisateur_identifiant = :identifiant
                AND var = :var";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'identifiant' => $this->identifiant,
            'var' => $leParam
        ]);
    }
}