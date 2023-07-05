<?php

function conectarDb() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'bienesraices_crud');
    $db->set_charset("utf8");
    if (!$db) {
        echo 'No se pudo conectar';
        exit;
    } 
    return $db;
}