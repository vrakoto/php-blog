<?php
$id = (int)$blog['id'];
$monBlog = $pdo->estMonBlog($id);
$auteur = htmlspecialchars_decode($blog['auteur']);
$titre = htmlspecialchars_decode($blog['titre']);
$categorie = htmlspecialchars_decode($blog['intitule_categorie']);
$description = htmlspecialchars_decode($blog['description']);
$dateCreation = convertDate($blog['created_at'], TRUE);