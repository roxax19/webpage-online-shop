<section>

    <div id="traza" class="underHeader">
        <p>Login</p>
    </div>

    <h2 class="sectionTitle">Login</h2>
    <div id="login">

        <!--?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?-->

        <?php echo form_open('Login'); ?>

        <p>Email:</p>
        <?php echo form_error('email', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
        <!-- con echo set value devolvemos los valores introducidos-->

        <p>Contraseña: </p>
        <?php echo form_error('password', '<div class="error" style="color:red;">', '</div>'); ?>
        <input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />

        <div><input type="submit" value="Submit" /></div>

        </form>

    </div>

</section>