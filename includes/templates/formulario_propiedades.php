<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">
    
    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="propiedad[imagen]"  id="imagen" accept="image/jpeg, image/png">

    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion" >Descripcion:</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10">
        <?php echo sanitizar($propiedad->descripcion); ?>
    </textarea>
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
        type="number" 
        id="habitaciones" 
        name="propiedad[habitaciones]" 
        placeholder="Ej: 3" 
        min="1" 
        max="9" 
        value="<?php echo sanitizar($propiedad->habitaciones); ?>"
    >

    <label for="wc">Baños:</label>
    <input 
        type="number" 
        id="wc" 
        name="propiedad[wc]" 
        placeholder="Ej: 3" 
        min="1" 
        max="9" 
        value="<?php echo sanitizar($propiedad->wc); ?>"
    >
    
    <label for="estacionamiento">Estacionamiento:</label>
    <input 
        type="number" 
        id="estacionamiento" 
        name="propiedad[estacionamiento]" 
        placeholder="Ej: 3" 
        min="1" 
        max="9" 
        value="<?php echo sanitizar($propiedad->estacionamiento); ?>"
    >
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    
    
<select name="propiedad[vendedor_id]" id="vendedor">
    <option value="" selected>-- Elije un vendedor --</option>
    <?php foreach($vendedores as $vendedor) { ?>
        <option 
            <?php echo $propiedad->vendedor_id === $vendedor->id ? 'selected' : ''; ?> 
            value="<?php echo sanitizar($vendedor->id); ?>"
        >
            <?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido); ?>
        </option>    
    <?php } ?>
</select>
</fieldset>