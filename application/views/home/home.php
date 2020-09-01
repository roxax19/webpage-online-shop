<section>

    <div id="traza" class="underHeader">
        <p>Home</p>
    </div>
    
    <div id="anuncio">
        <img src="<?php echo base_url(); ?>resources/img/anuncio.jpg" id="imagenAnuncio" alt="Anuncio">
    </div>

    <div id="catDestacadas">

        <?php
            foreach ($categoriasDestacadas as $categoria) {
                
                echo '<a href="' . base_url() .'index.php/Categoria?categoria=' . urlencode($categoria->categoria_id) . '">';
                echo '<div>';
                echo $categoria->categoria_nombre;
                echo '</div>';
                echo '</a>';
                
            }
        ?>
    </div>


    <h3 class="sectionTitle">Productos destacados</h3>

    <div class="productos" id="productosHome">

        <?php

        foreach ($productosDestacados as $producto) {



            echo '<div class="producto">';

            echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";

            echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
            echo '<p class="precioProducto">' . $producto->precio . '€</p>';
            echo '<p class="nombreProducto">' . $producto->nombre . '</p>';

            echo '</a>';

            echo '</div>';
        }

        ?>

    </div>

</section>