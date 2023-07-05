<?php

define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function dd($variable) {
    echo "<pre>";
        var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Propiedad Creada Correctamente';
            break;
        case 2:
            $mensaje = 'Propiedad Actualizada Correctamente';
            break;
        case 3:
            $mensaje = 'Propiedad Eliminada Correctamente';
            break;
        case 4:
            $mensaje = 'Vendedor Registrado Correctamente';
            break;
        case 5:
            $mensaje = 'Vendedor Actualizado Correctamente';
            break;
        case 6:
            $mensaje = 'Vendedor Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}