<section>

    <div id="traza" class="underHeader">

        <?php
        echo "<p>Carrito de " . $this->session->name . "</p>";
        ?>

    </div>

    <div id="contenedorCarrito">
        <div id="productosCarritoParteFlex">
            <div id="productosCarritoParteGrid">


                <?php

                /**HAY QUE AVERIGUAR COMO PONER EL ENLACE SOLO A ELIMINAR, PORQUE HACE COSAS RARAS
                 * AL FINAL HABRA QUE CAMBIAR Y DEJAR BIEN EL A
                 * 
                 */
                foreach ($productos as $producto) {

                    echo '<div class="unGridEnCarrito">';

                    echo '<div class="centroEliminar">';

                    echo '<a href="' . base_url() . 'index.php/Carrito?eliminar=' . $producto->producto_id . '">';

                    echo '<p class="botonEliminar">Eliminar</p>';

                    echo '</a>';

                    echo '</div>'; //class=centroEliminar               



                    echo '<div class="producto">';

                    echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";

                    echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
                    echo '<p class="precioProducto">' . $producto->precio . '€</p>';
                    echo '<p class="nombreProducto">' . $producto->nombre . '</p>';

                    foreach ($carrito as $carro) {
                        if ($producto->producto_id == $carro->producto_id) {
                            echo '<p class="cantidadProducto"> Cantidad: ' . $carro->cantidad . '</p>';
                        }
                    }

                    echo '</a>';

                    echo '</div>'; //class=producto

                    echo '</div>'; //class=unGridEnCarrito
                }

                ?>
            </div>
        </div>

        <div id="botonesCarrito">
            <a href="<?php echo base_url(); ?>index.php/Carrito?procesar=1">
                <div id="botonProcederCompra" class="botonCompraCarrito">
                    <p>Proceder a la Compra</p>
                </div>
            </a>

            <a href="<?php echo base_url(); ?>index.php/Carrito?vaciar=1">
                <div id="botonVaciarCarrito" class="botonCompraCarrito">
                    <p>Vaciar el carrito</p>
                </div>
            </a>

        </div>
    </div>

</section>