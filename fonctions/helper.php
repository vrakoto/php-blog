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

function form_input_label(string $idRef, string $typeInput, string $titre, array $erreurs, bool $keepValue = TRUE, string $property = NULL): string
{
    $isInvalid = '';
    if (isset($erreurs[$idRef])) {
        $isInvalid = "is-invalid";
    }

    $value = '';
    if ($keepValue && !isset($erreurs[$idRef])) {
        $value = htmlentities($_POST[$idRef] ?? '');
    }

    return <<<HTML
    <div class="mb-3">
        <label for="$idRef" class="form-label has-warning mb-0">$titre</label>
        <input type="$typeInput" name="$idRef" class="form-control $isInvalid" id="$idRef" value="$value" $property>
    </div>
HTML;
}



function form_checkbox(string $var, string $titre, int $checked = 0): string
{
    $checking = '';
    if ($checked !== 0) {
        $checking = "checked";
    }
    return <<<HTML
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="params[]" value="$var" id="$var" $checking>
        <label class="form-check-label" for="$var">$titre</label>
    </div>
HTML;
}

function removeSpecialChr(string $input) {
    $string = str_replace(' ', ' ', $input); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-?!()]/', '', $string); // Removes special chars.
 }