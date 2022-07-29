<?php
$idCommentaire = (int)$utilisateur['id'];
$idBlog = (int)$utilisateur['idBlog'];
$identifiantCommentateur = htmlspecialchars_decode($utilisateur['commentateur']);
$monCommentaire = ($monIdentifiant === $identifiantCommentateur);
$avatar = htmlspecialchars($utilisateur['avatar']);
$nom = htmlspecialchars_decode($utilisateur['nom']);
$prenom = htmlspecialchars_decode($utilisateur['prenom']);
$datePublication = convertDate($utilisateur['published_at'], true);
$commentaire = htmlspecialchars_decode($utilisateur['commentaire']);

$enableRefBlog = (isset($_REQUEST['identifiant']) && !empty($_REQUEST['identifiant'])) ? TRUE : FALSE;