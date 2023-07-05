<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    estaAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    // Conectar db
    $db = conectarDb();

    //Obtener datos de l apropiedad
    $propiedad = Propiedad::find($id);

    $vendedores = Vendedor::all();
    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //Asignar files a una variable
        $errores = $propiedad->validar();

        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Resize a la imagen con intervation
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que el array errorres este vacio
        if (empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            
            $propiedad->guardar();
        }

    }
    
    incluirTemplate('header');
?>
    
    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="/admin" class="boton btn-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="error alerta">
                <?php echo($error) ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton btn-verde">
        </form>
    </main>

    <?php 
        incluirTemplate('footer');
    ?>