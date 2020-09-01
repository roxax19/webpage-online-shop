<html>

<head>
    <title>My Form</title>
</head>

<body>

    <?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?>

    <?php echo form_open('form'); ?>

    <h5>Username</h5>
    <?php echo form_error('username', '<div class="error" style="color:red;">', '</div>'); ?>
    <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />
    <!-- con echo set value devolvemos los valores introducidos-->

    <h5>Password</h5>
    <?php echo form_error('password', '<div class="error" style="color:red;">', '</div>'); ?>
    <input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />

    <h5>Password Confirm</h5>
    <?php echo form_error('passconf', '<div class="error" style="color:red;">', '</div>'); ?>
    <input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />

    <h5>Email Address</h5>
    <?php echo form_error('email', '<div class="error" style="color:red;">', '</div>'); ?>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

    <div><input type="submit" value="Submit" /></div>

    </form>

</body>

</html>