<section>

    <div id="traza" class="underHeader">
        <?php
        echo "<p>Proceder al pago</p>";
        ?>
    </div>

    <div>
        <h2>Vas a comprar: </h2>

        <div class="productosComprasParteGrid">                

            <?php
                foreach ($productosEnProceso as $producto) {         
                    
                    echo '<div class="unGridEnCarrito">';

                    echo '<div class="producto">';

                    echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";

                    echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
                    echo '<p class="precioProducto">' . $producto->precio . '€</p>';
                    echo '<p class="nombreProducto">' . $producto->nombre . '</p>';

                    foreach ($comprasEnProceso as $compra) {
                        if ($producto->producto_id == $compra->producto_id) {
                            echo '<p class="cantidadProducto"> Cantidad: ' . $compra->cantidad . '</p>';
                        }
                    }                    

                    echo '</a>';

                    echo '</div>'; //class=producto

                    echo '</div>'; //class=unGridEnCarrito
                }
            ?>
        </div>

    </div>

    <div>
        <h2>Método de envio: </h2>

        <?php 

        echo '<p>';
        echo 'Envío urgente 2 - 3 días';     
        echo '</p>';
        
        
        ?>
    </div>

    <div>
        <h2>Datos de envío: </h2>

        <?php 

        echo '<p>';
        echo 'Nombre: ' . $datosEnvio->nombre. '<br>';
        echo 'Apellidos: ' . $datosEnvio->apellidos. '<br>';
        echo 'Email: ' . $datosEnvio->email. '<br>';
        echo 'Teléfono: ' . $datosEnvio->telefono. '<br>';
        echo 'Dirección : ' . $datosEnvio->direccion. '<br>';
        echo 'CP: ' . $datosEnvio->cp. '<br>';
        echo 'Provincia: ' . $datosEnvio->provincia. '<br>';
        echo 'Pais: ' . $datosEnvio->pais. '<br>';        
        echo '</p>';
        
        
        ?>
    </div>

    <div id="botonesProcederPago">
        <a href="<?php echo base_url(); ?>index.php/PrePago?proceder=1">
            <div id="botonProcederCompra" class="botonCompraCarrito">
                <p>Proceder al pago</p>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>index.php/PrePago?cancelar=1">
            <div id="botonVaciarCarrito" class="botonCompraCarrito">
                <p>Cancelar</p>
            </div>
        </a>

    </div>

    

</section>