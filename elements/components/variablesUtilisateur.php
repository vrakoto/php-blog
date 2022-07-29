<?php
$identifiant = htmlspecialchars($infosUser['identifiant']);
$avatar = htmlspecialchars($infosUser['avatar']);
$nom = htmlspecialchars($infosUser['nom']);
$prenom = htmlspecialchars($infosUser['prenom']);
$dateCreation = convertDate($infosUser['created_at']);