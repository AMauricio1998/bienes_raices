<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    // Conectar db
    require '../../includes/config/db.php';
    $db = conectarDb();

    //Obtener datos de l apropiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    //Consultar los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedor_id'];
    $imagenPropiedad = $propiedad['imagen'];

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

        // if(!$imagen['name'] || $imagen['error']){ 
        //     $errores[] = 'La imagen es obligatoria';
        // }
        //Validar 100KB maximo
        $media = 1000 * 1000;

        // Revisar que el array errorres este vacio
        if (empty($errores)) {
            // Subir archivos
            // Crear carpeta
            $carpetaImagenes = '../../imagenes';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';
            if($imagen['name']) {

                unlink($carpetaImagenes . $propiedad['imagen']);
    
                // Generar nombre a imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
                // subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/" . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', 
                habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedor_id = {$vendedorId} WHERE id = {$id}";
            
            $resultado = mysqli_query($db, $query);
    
            if ($resultado) {
                // echo 'Insertado correctamente';
                header("location: /admin?resultado=2");
            }
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
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen"  id="imagen" accept="image/jpeg, image/png">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="imagen propiedad" class="imagen-small">

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

            <input type="submit" value="Actualizar Propiedad" class="boton btn-verde">
        </form>
    </main>

    <?php 
        incluirTemplate('footer');
    ?>