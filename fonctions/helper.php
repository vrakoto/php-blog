<?php

function nav_link(string $lien, string $titre): string
{
    $active = '';
    $currentLinkController = str_replace('p=', '', $_SERVER['QUERY_STRING']);
    if (str_contains($currentLinkController, $lien)) {
        $active = " active";
    }
    return <<<HTML
    <li class="nav-item">
        <a href="index.php?p=$lien" class="nav-link $active">$titre</a>
    </li>
HTML;
}

function convertDate(string $date, bool $heure = FALSE): string
{
    if ($heure === TRUE) {
        $heure = " à H:i";
    }
    $date = new DateTime($date);
    return $date->format('d/m/Y' . $heure);
}