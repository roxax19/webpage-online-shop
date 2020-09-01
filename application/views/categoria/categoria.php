<section>

    <div id="traza" class="underHeader">

        <?php

        //echo "<div id=\"categoriasTitle\" class=\"underHeader\">";


        echo "<p>" . $categoriaActual . "</p>";

        //echo "</div>";
        //echo "Categoria";

        ?>

    </div>

    <div class="productos">

        <?php

        foreach ($productos as $producto) {



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