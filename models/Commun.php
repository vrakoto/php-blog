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

    
    function nbCreatedBlogsToday(): int
    {
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE (`created_at` > DATE_SUB(now(), INTERVAL 1 DAY));";

        $p = $this->pdo->query($req);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisWeek(): int
    {
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)";

        $p = $this->pdo->query($req);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisMonth(): int
    {
        $req = "SELECT count(id) as nbBlogs FROM blog 
                WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
                AND YEAR(created_at) = YEAR(CURRENT_DATE())";

        $p = $this->pdo->query($req);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisYear(): int
    {
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE YEAR(created_at) = YEAR(CURDATE())";

        $p = $this->pdo->query($req);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsTotal(): int
    {
        $req = "SELECT count(id) as nbBlogs FROM blog";

        $p = $this->pdo->query($req);
        return $p->fetch()['nbBlogs'];
    }


    function estMonBlog(int $idBlog): bool
    {
        $req = "SELECT auteur FROM blog
                WHERE id = :idBlog
                AND auteur = :auteur";

        $p = $this->pdo->prepare($req);
        $p->execute([
            'idBlog' => $idBlog,
            'auteur' => $this->identifiant
        ]);
        return !empty($p->fetch()); 
    }

    function getLesBlogsUtilisateur(string $identifiant): array
    {
        $req = "SELECT * FROM blog
                WHERE auteur = :identifiant
                ORDER BY created_at DESC";
        $p = $this->pdo->prepare($req);

        $p->execute(['identifiant' => $identifiant]);
        return $p->fetchAll();
    }


    function getLesBlogs(bool $recemment = TRUE): array
    {
        $req = "SELECT * FROM blog";
        if ($recemment) {
            $req .= " ORDER BY created_at DESC";
        }

        $p = $this->pdo->query($req);
        return $p->fetchAll();
    }

    function getLesBlogsParCategorie(string $laCategorie): array
    {
        if ($laCategorie === 'toutes') {
            return $this->getLesBlogs(true);
        }
        $req = "SELECT * FROM blog
                WHERE intitule_categorie = :categorie
                ORDER BY titre";
        $p = $this->pdo->prepare($req);

        $p->execute(['categorie' => $laCategorie]);
        return $p->fetchAll();
    }
}