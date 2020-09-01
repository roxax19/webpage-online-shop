<section>

    <div id="traza" class="underHeader">

        <?php
        echo "<p>Lista de compras de " . $this->session->name . "</p>";
        ?>

    </div>

    <div id="contenedorCarrito">
        <div id="productosCarritoParteFlex">
            <?php

            /**Vamos a hacer secciones segun el estado (deberiamos hacerlo guardando los estados
            *posibles en una db para que se pudieran agregar y quitar estados sin problema): */

            ?>

            <h3>En Proceso</h3>

            <div class="productosComprasParteGrid">                

                <?php

                    if(is_int($comprasEnProceso)){
                        echo '<p>No hay compras en proceso.</p>';
                    }else{

                        foreach ($productosEnProceso as $producto) {

                            echo '<div class="unGridEnCarrito">';                        
    
                            echo '<div class="centroEliminar">';
    
                            echo '<a href="' . base_url() . 'index.php/ListaCompras?eliminar=' . $producto->producto_id . '">';
    
                            echo '<p class="botonEliminar">Cancelar</p>';
    
                            echo '</a>';
    
                            echo '</div>'; //class=centroEliminar
    
                                                    
    
                            echo '<div class="producto">';
    
                            echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";
    
                            echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
                            echo '<p class="precioProducto">' . $producto->precio . '€</p>';
                            echo '<p class="nombreProducto">' . $producto->nombre . '</p>';
    
                            foreach ($comprasEnProceso as $compra) {
                                if ($producto->producto_id == $compra->producto_id) {
                                    echo '<p class="cantidadProducto"> Cantidad: ' . $compra->cantidad . '</p>';
                                    echo '<p class="estadoProducto"> Estado: ' . $compra->estado . '</p>';
                                }
                            }                    
    
                            echo '</a>';
    
                            echo '</div>'; //class=producto
    
                            echo '</div>'; //class=unGridEnCarrito
                        }  

                    }

                                  

                ?>

            </div>

            <h3>Enviados</h3>

            <div class="productosComprasParteGrid">             

                <?php

                    if(is_int($comprasEnviado)){
                        echo '<p>No hay compras en proceso.</p>';
                    }else{

                        foreach ($productosEnviado as $producto) {

                            echo '<div class="unGridEnCarrito">';                        

                            /**Aqui no quiero que haya boton de eliminar */

                            echo '<div class="producto">';

                            echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";

                            echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
                            echo '<p class="precioProducto">' . $producto->precio . '€</p>';
                            echo '<p class="nombreProducto">' . $producto->nombre . '</p>';

                            foreach ($comprasEnviado as $compra) {
                                if ($producto->producto_id == $compra->producto_id) {
                                    echo '<p class="cantidadProducto"> Cantidad: ' . $compra->cantidad . '</p>';
                                    echo '<p class="estadoProducto"> Estado: ' . $compra->estado . '</p>';
                                }
                            }                    

                            echo '</a>';

                            echo '</div>'; //class=producto

                            echo '</div>'; //class=unGridEnCarrito
                        }
                    }               

                ?>
            </div>

            <h3>Recibidos</h3>

            <div class="productosComprasParteGrid">            

                <?php

                    if(is_int($comprasRecibido)){
                        echo '<p>No hay compras en proceso.</p>';
                    }else{

                        foreach ($productosRecibido as $producto) {

                            echo '<div class="unGridEnCarrito">';                        

                            /**Aqui no quiero que haya boton de eliminar */

                            echo '<div class="producto">';

                            echo "<a href=\"" . base_url() . "index.php/Producto?id=" . urlencode($producto->producto_id) . "\">";

                            echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProducto">';
                            echo '<p class="precioProducto">' . $producto->precio . '€</p>';
                            echo '<p class="nombreProducto">' . $producto->nombre . '</p>';

                            foreach ($comprasRecibido as $compra) {
                                if ($producto->producto_id == $compra->producto_id) {
                                    echo '<p class="cantidadProducto"> Cantidad: ' . $compra->cantidad . '</p>';
                                    echo '<p class="estadoProducto"> Estado: ' . $compra->estado . '</p>';
                                }
                            }                    

                            echo '</a>';

                            echo '</div>'; //class=producto

                            echo '</div>'; //class=unGridEnCarrito
                        }      
                    }          

                ?>

               
            </div><!-- ProductosComprasParteFlex -->
        </div><!-- ProductosCarritoParteFlex -->
    </div><!-- Contenedor Carrito -->

</section>