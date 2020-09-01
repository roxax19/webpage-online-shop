<section>

    <div id="traza" class="underHeader">
        <p>Sing Up</p>
    </div>

    <h2 class="sectionTitle">Sing up</h2>
    <div id="singup">

        <!--?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?-->

        <?php echo form_open('SingUp'); ?>
        <!-- Deberiamos crear un Controller para enviar el resultado del formulario-->

        <p>Email:</p>
        <?php echo form_error('email', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

        <p>Nombre de usuario:</p>
        <?php echo form_error('username', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />
        <!-- con echo set value devolvemos los valores introducidos-->

        <p>Contraseña: </p>
        <?php echo form_error('password', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />

        <p>Repetir contraseña:</p>
        <?php echo form_error('passconf', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />

        <div><input type="submit" value="Submit" /></div>

        </form>

    </div>

</section>