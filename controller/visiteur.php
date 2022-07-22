<?php

switch ($action) {
    case 'accueil':
        echo 'ok';
    break;
    
    default:
        $swapController = $action;
    break;
}