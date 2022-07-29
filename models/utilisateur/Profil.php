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
        $extensionsAllowed = ["png", "jpg", "jpeg", "gif", "svg", "webp"];
        
        $erreurs['avatar'] = "L'extension de l'image est invalide. L'extension de l'URL doit être figuré dans cette liste : " . implode(', ', $extensionsAllowed);
        foreach ($extensionsAllowed as $extension) {
            if (str_contains($this->avatar, $extension)) {
                unset($erreurs['avatar']);
            }
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