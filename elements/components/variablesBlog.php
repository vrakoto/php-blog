<?php
$id = (int)$blog['id'];
$monBlog = $pdo->estMonBlog($id);
$auteur = htmlspecialchars_decode($blog['auteur']);
$titre = htmlspecialchars_decode($blog['titre']);
$categorie = htmlspecialchars_decode($blog['intitule_categorie']);
$description = htmlspecialchars_decode($blog['description']);
$descriptionCastedBlog = (strlen($description) > 128) ? substr($description,0,125).'...' : $description;
$privation = (int)$blog['privation'];
$autorise = $pdo->estAutorise($id);
$dateCreation = convertDate($blog['created_at'], TRUE);