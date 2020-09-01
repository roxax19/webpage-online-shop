<section>

    <div id="traza" class="underHeader">
        <p>Datos de envío</p>
    </div>

    <h2 class="sectionTitle">Datos de envío</h2>
    <div id="login">

        <?php
        /**Lista de elementos que tienen que ir en el form
         * email
         * nombre y apellidos
         * Direccion
         * codigo postal
         * provincia
         * pais
         * telefono
         * */

        ?>

        <!--?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?-->

        <?php echo form_open('DatosEnvio'); ?>

        <p>Email:</p>
        <?php echo form_error('email', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="email" value="<?php echo $this->session->sesion; ?>" size="50" />
        <!-- con echo set value devolvemos los valores introducidos-->

        <p>Nombre:</p>
        <?php echo form_error('nombre', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="nombre" value="<?php echo $this->session->name; ?>" size="50" />

        <p>Apellidos:</p>
        <?php echo form_error('apellidos', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>" size="50" />

        <p>Dirección:</p>
        <?php echo form_error('direccion', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="direccion" value="<?php echo set_value('direccion'); ?>" size="50" />

        <p>Código Postal:</p>
        <?php echo form_error('cp', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="cp" value="<?php echo set_value('cp'); ?>" size="50" />

        <p>Provincia:</p>
        <?php echo form_error('provincia', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="provincia" value="<?php echo set_value('provincia'); ?>" size="50" />

        <p>País:</p>
        <?php echo form_error('pais', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="pais" value="<?php echo set_value('pais'); ?>" size="50" />

        <p>Teléfono:</p>
        <?php echo form_error('telefono', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="telefono" value="<?php echo set_value('telefono'); ?>" size="50" />


        <div><input type="submit" value="Submit" /></div>

        </form>

    </div>

</section>