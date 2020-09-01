<header>

    <script src="<?php echo base_url(); ?>resources/js/header.js"></script>

    <div id="sandwich">
        <img src="<?php echo base_url(); ?>resources/img/sandwich.svg" alt="Menu" id="botonSandwich" class="botonHeader">
    </div>

    <div id="logo">
        <h1><a href="<?php echo base_url(); ?>">Home</a></h1>
    </div>

    <div id="busqueda">
        <input id="barraBusqueda" type="text">
        <button id="botonBusqueda">Buscar</button>
    </div>

    <div id="headerLogin">
        <?php
        if ($this->session->has_userdata('sesion')) {
            //Hay que escapar los caracteres de el nombre
            echo '<a href="' . base_url() . 'index.php/ListaCompras">';
            echo 'Hola, ' . $this->session->name;
            echo '</a>';
        } else {
            echo '<a href="' . base_url() . 'index.php/Login">';
            echo 'Log in';
            echo '</a>';
        }
        ?>
    </div>

    <div id="headerSingup">
        <?php
        if ($this->session->has_userdata('sesion')) {
            echo '<a href="' . base_url() . 'index.php/Logout">';
            echo 'Log out';
            echo '</a>';
        } else {
            echo '<a href="' . base_url() . 'index.php/SingUp">';
            echo 'Sing up';
            echo '</a>';
        }
        ?>
    </div>

    <div id="carrito">
        <a href="<?php echo base_url(); ?>index.php/Carrito">
            <img src="<?php echo base_url(); ?>resources/img/carrito.svg" alt="Menu" id="botonCarrito" class="botonHeader">
        </a>
    </div>
</header>