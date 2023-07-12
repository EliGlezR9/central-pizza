<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo($actual, $proximo) :bool{
    if($actual !== $proximo){
        return true;
    }
    return false;
}

function isAuth() :void {
    if(!isSet($_SESSION['login'])){
        header('Location: /');
    }
}