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

    function getLesUtilisateursAInviter(int $idBlog): array
    {
        $req = "SELECT identifiant, avatar, nom, prenom, created_at FROM utilisateur
                WHERE NOT identifiant = :currentIdentifiant
                AND identifiant NOT IN (SELECT demandeur FROM blog_acces WHERE idBlog = :idBlog)
                ORDER BY identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'currentIdentifiant' => $this->identifiant,
            'idBlog' => $idBlog
        ]);
        return $p->fetchAll();
    }

    function getLesUtilisateursInvites(int $idBlog): array
    {
        $req = "SELECT nom, prenom,
                idBlog, demandeur, acces
                FROM blog_acces
                JOIN utilisateur on utilisateur.identifiant = blog_acces.demandeur
                WHERE idBlog = :idBlog
                AND acces = 1";
        $p = $this->pdo->prepare($req);
        $p->execute(['idBlog' => $idBlog]);
        return $p->fetchAll();
    }

    function autoriserAcces(int $idBlog, string $identifiant): bool
    {
        $req = "INSERT INTO blog_acces (idBlog, demandeur, acces) VALUES (:idBlog, :demandeur, 1)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idBlog' => $idBlog,
            'demandeur' => $identifiant
        ]);
    }

    function retirerAcces(int $idBlog, string $identifiant): bool
    {
        $req = "DELETE FROM blog_acces
                WHERE idBlog = :idBlog
                AND demandeur = :demandeur";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idBlog' => $idBlog,
            'demandeur' => $identifiant
        ]);
    }


    function ajouterPrivation(int $idBlog): bool
    {
        $req = "UPDATE blog SET privation = 1
                WHERE id = :idBlog
                AND auteur = :auteur";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idBlog' => $idBlog,
            'auteur' => $this->identifiant
        ]);
    }

    function retirerPrivation(int $idBlog): bool
    {
        $req = "UPDATE blog SET privation = 0
                WHERE id = :idBlog
                AND auteur = :auteur";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idBlog' => $idBlog,
            'auteur' => $this->identifiant
        ]);
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
                WHERE id = :idCommentaire";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idCommentaire' => $idCommentaire
        ]);
    }

    function estMonCommentaire(int $idCommentaire): bool
    {
        $req = "SELECT commentateur FROM blog_commentaires
                WHERE commentateur = :idCommentaire
                AND commentateur = :identifiant";

        $p = $this->pdo->prepare($req);
        $p->execute([
            'idCommentaire' => $idCommentaire,
            'identifiant' => $this->identifiant
        ]);
        return !empty($p->fetch());
    }

    
    function updateParametre(string $leParam, int $value = 1): bool
    {
        $req = "UPDATE utilisateur_parametres SET
                checked = :value
                WHERE utilisateur_identifiant = :identifiant
                AND var = :var";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'value' => $value,
            'identifiant' => $this->identifiant,
            'var' => $leParam
        ]);
    }
}