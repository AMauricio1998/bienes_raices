<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    // Conectar db
    require '../../includes/config/db.php';
    $db = conectarDb();

    //Consultar los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files a una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "Debes añadir un precio";
        }

        if ( strlen( $descripcion ) < 50) {
            $errores[] = "La descricpion es obligatoria y debe tener al menos 50 caracteres";
        }

        if (!$habitaciones) {
            $errores[] = "El numero de habitaciones es obligatorio";
        }

        if (!$wc) {
            $errores[] ="El numero de baños es obligatorio";
        }

        if (!$estacionamiento) {
            $errores[] = "El numero de lugares de estacionamiento es obligatorio";
        }
        
        if (!$vendedorId) {
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']){ 
            $errores[] = 'La imagen es obligatoria';
        }
        //Validar 100KB maximo
        $media = 1000 * 1000;

        if($imagen['size'] > $media) {
            $errores[] = 'La imgen es muy pesada';
        }

        // Revisar que el array errorres este vacio
        if (empty($errores)) {
            // Subir archivos
            // Crear carpeta
            $carpetaImagenes = '../../imagenes';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            // Generar nombre a imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/" . $nombreImagen);

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedor_id) 
                    VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";
    
            $resultado = mysqli_query($db, $query);
    
            if ($resultado) {
                // echo 'Insertado correctamente';
                header("location: /admin?resultado=1");
            }
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
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen"  id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion" >Descripcion:</label>
                <textarea name="descripcion" name="descripcion" id="descripcion" cols="30" rows="10">
                    <?php echo $descripcion; ?>
                </textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $habitaciones; ?>"
                >

                <label for="wc">Baños:</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $wc; ?>"
                >
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $estacionamiento; ?>"
                >
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="vendedor">
                    <option value="" selected>-- Elije un vendedor --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option 
                            <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''?> 
                            value="<?php echo $vendedor['id']; ?>">
                        >
                            <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                        </option>    
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton btn-verde">
        </form>
    </main>

    <?php 
        incluirTemplate('footer');
    ?>