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

    function identifiantExistant(string $identifiant_inscription): bool
    {
        $req = "SELECT identifiant FROM utilisateur WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $identifiant_inscription
        ]);

        return !empty($p->fetch());
    }

    function estConnecte(): bool
    {
        return !empty($this->identifiant);
    }

    function getMonIdentifiant(): string
    {
        return $this->identifiant;
    }

    function getUtilisateur(string $identifiant): array
    {
        $req = "SELECT identifiant, avatar, nom, prenom, created_at FROM utilisateur
                WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute(['identifiant' => $identifiant]);
        return $p->fetch();
    }

    function getLesParametresUtilisateur(string $identifiant): array
    {
        $req = "SELECT * FROM utilisateur_parametres
                WHERE utilisateur_identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute(['identifiant' => $identifiant]);
        return $p->fetchAll();
    }

    function getValeurParametre(string $identifiant, string $var): int
    {
        $req = "SELECT checked FROM utilisateur_parametres
                WHERE utilisateur_identifiant = :identifiant
                AND var = :var";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $identifiant,
            'var' => $var
        ]);
        return $p->fetch()['checked'];
    }

    function getLesCategories(): array
    {
        $req = "SELECT intitule FROM categorie
                ORDER BY 1";
        $p = $this->pdo->query($req);
        return $p->fetchAll();
    }
    function getLesCategoriesPopulaires(int $limit = 0): array
    {
        $req = "SELECT intitule, count(*) as nbBlogs FROM categorie
                JOIN blog on blog.intitule_categorie = categorie.intitule
                GROUP BY intitule
                ORDER BY nbBlogs DESC";
        if ($limit <= 0) {
            $req .= " LIMIT " . $limit;
        }
        $p = $this->pdo->query($req);
        return $p->fetchAll();
    }

    
    function nbCreatedBlogsToday(string $identifiant = NULL): int
    {
        $params = [];
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE (`created_at` > DATE_SUB(now(), INTERVAL 1 DAY))";

        if (!empty($identifiant)) {
            $req .= " AND auteur = :identifiant";
            $params['identifiant'] = $identifiant;
        }

        $p = $this->pdo->prepare($req);
        $p->execute($params);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisWeek(string $identifiant = NULL): int
    {
        $params = [];
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)";

        if (!empty($identifiant)) {
            $req .= " AND auteur = :identifiant";
            $params['identifiant'] = $identifiant;
        }

        $p = $this->pdo->prepare($req);
        $p->execute($params);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisMonth(string $identifiant = NULL): int
    {
        $params = [];
        $req = "SELECT count(id) as nbBlogs FROM blog 
                WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
                AND YEAR(created_at) = YEAR(CURRENT_DATE())";

        if (!empty($identifiant)) {
            $req .= " AND auteur = :identifiant";
            $params['identifiant'] = $identifiant;
        }

        $p = $this->pdo->prepare($req);
        $p->execute($params);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsThisYear(string $identifiant = NULL): int
    {
        $params = [];
        $req = "SELECT count(id) as nbBlogs FROM blog
                WHERE YEAR(created_at) = YEAR(CURDATE())";

        if (!empty($identifiant)) {
            $req .= " AND auteur = :identifiant";
            $params['identifiant'] = $identifiant;
        }

        $p = $this->pdo->prepare($req);
        $p->execute($params);
        return $p->fetch()['nbBlogs'];
    }

    function nbBlogsTotal(string $identifiant = NULL): int
    {
        $params = [];
        $req = "SELECT count(id) as nbBlogs FROM blog";

            if (!empty($identifiant)) {
                $req .= " WHERE auteur = :identifiant";
                $params['identifiant'] = $identifiant;
            }

        $p = $this->pdo->prepare($req);
        $p->execute($params);
        return $p->fetch()['nbBlogs'];
    }


    function estAutorise(int $idBlog): bool
    {
        $req = "SELECT demandeur, acces FROM blog_acces
                WHERE idBlog = :idBlog
                AND demandeur = :currentIdentifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'idBlog' => $idBlog,
            'currentIdentifiant' => $this->identifiant
        ]);
        return !empty($p->fetch());
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

    function getLesBlogsUtilisateur(string $identifiant, int $limit = 0): array
    {
        
        $req = "SELECT * FROM blog
                WHERE auteur = :identifiant
                ORDER BY created_at DESC";
        if ($limit > 0) {
            $req .= " LIMIT " . $limit;
        }
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

    function getLesNouveautes(int $quantite): array
    {
        $req = "SELECT * FROM blog
                ORDER BY created_at DESC
                LIMIT " . $quantite;

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

    function getLeBlog(int $idBlog): array
    {
        $req = "SELECT * FROM blog
                WHERE id = :idBlog";
        $p = $this->pdo->prepare($req);

        $p->execute(['idBlog' => $idBlog]);
        return $p->fetch();
    }
    
    /**
     * getLesCommentaires
     *
     * @param  string|int $elementSearch
     * Si chaine de caractère, alors récupère seulement les commentaires de l'utilisateur spécifié
     * Si valeur numérique, alors récupère seulement les commentaires du blogs spécifié (par id) 
     * 
     * @param  int $limit
     * @return array
     */
    function getLesCommentaires(string|int $elementSearch, int $limit = 0): array
    {
        $prepareArgs = [];
        $req = "SELECT id, idBlog, commentateur, commentaire, published_at,
                avatar, nom, prenom FROM blog_commentaires
                JOIN utilisateur on utilisateur.identifiant = blog_commentaires.commentateur";

        if (!is_int($elementSearch)) {
            $req .= " WHERE commentateur = :identifiant";
            $prepareArgs['identifiant'] = $elementSearch;
        } else {
            $req .= " WHERE idBlog = :idBlog";
            $prepareArgs['idBlog'] = $elementSearch;
        }
        $req .= " ORDER BY published_at DESC";

        if ($limit > 0) {
            $req .= " LIMIT " . $limit;
        }

        $p = $this->pdo->prepare($req);
        $p->execute($prepareArgs);
        return $p->fetchAll();
    }
}