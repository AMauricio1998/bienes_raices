<?php 

    require 'funciones.php';
    require 'config/db.php';
    require __DIR__ . '/../vendor/autoload.php';

    define('TEMPLATES_URL', __DIR__ . '/templates');
    define('FUNCIONES_URL', __DIR__ . 'funciones-php');

    // Conectar a la base de datos
    $db = conectarDb();

    use App\ActiveRecord;

    ActiveRecord::setDB($db);