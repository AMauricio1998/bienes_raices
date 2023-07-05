<?php 
    require '../../includes/app.php';
    
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    // Crear el objeto
    $propiedad = new Propiedad;

    // Obtener todos los vendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST['propiedad']);

        // Subir archivos
        // Generar nombre a imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Resize a la imagen con intervation
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();
        
        // Revisar que el array errorres este vacio
        if (empty($errores)) {

            // Crear carpeta
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Guardar miagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();
        }

    }
    
    incluirTemplate('header');
?>
    
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton btn-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="error alerta">
                <?php echo($error) ?>
            </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
           
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton btn-verde">
        </form>
    </main>

    <?php 
        incluirTemplate('footer');
    ?>