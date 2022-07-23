<?php
$idCommentaire = (int)$utilisateur['id'];
$identifiantCommentateur = htmlspecialchars_decode($utilisateur['commentateur']);
$nom = htmlspecialchars_decode($utilisateur['nom']);
$prenom = htmlspecialchars_decode($utilisateur['prenom']);
$datePublication = convertDate($utilisateur['published_at'], true);
$commentaire = htmlspecialchars_decode($utilisateur['commentaire']);