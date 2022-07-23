<?php

class Profil extends Commun {
    private $avatar;
    private $nom;
    private $prenom;
    
    function __construct(string $avatar, string $nom, string $prenom)
    {
        parent::__construct();
        $this->avatar = $avatar;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    
    function verifierProfil(): bool
    {
        return empty($this->getErreurs());
    }

    function getErreurs(): array
    {
        $erreurs = [];
        $extensionsAllowed = array("png", "jpg", "jpeg", "gif");
        $avatarLink = explode(".", $this->avatar);
        $imgExtension = end($avatarLink);

        if (!in_array($imgExtension, $extensionsAllowed)) {
            $erreurs['avatar'] = "L'URL ou l'extension de l'image est invalide. Seuls PNG, JPG/JPEG et GIF sont autorisés";
        }
        if (strlen($this->nom) < 2) {
            $erreurs['nom'] = "Le nom est trop court";
        }
        if (strlen($this->prenom) < 2) {
            $erreurs['prenom'] = "Le prénom est trop court";
        }
        return $erreurs;
    }

    function update(): bool
    {
        $req = "UPDATE utilisateur SET
                avatar = :avatar,
                nom = :nom,
                prenom = :prenom
                WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'avatar' => $this->avatar,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'identifiant' => $this->identifiant
        ]);
    }
}