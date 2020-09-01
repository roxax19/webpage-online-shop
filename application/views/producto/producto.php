<section>

    <script src="<?php echo base_url(); ?>resources/js/producto.js"></script>

    <div id="traza" class="underHeader">

        <?php
        /**Cambiar por producto nombre */
        echo $producto->nombre;
        ?>

    </div>

    <div id="contenedorProducto">
        <div id="contenedorProductoImagen">
            <?php
            echo '<img src="' . base_url() . 'resources/img/' . $producto->imagen . '" alt="ProductoPrueba" class="imagenProductoProducto">';
            ?>


        </div>
        <div id="contenedorProductoDatos">
            <?php

            echo '<p class="nombre">' . $producto->nombre . '</p>';
            echo '<p class="precio">' . $producto->precio . '€</p>';
            echo '<p>Recíbelo en 2 días</p>';
            //echo cantidad

            ?>

            <!-- Vamos a crear un formulario pequeño para la cantidad -->
            <?php echo form_open('Producto', array('class' => "myForm"), array('id' => $producto->producto_id)); ?>
            <p>
                Cantidad:
                <?php echo form_error('cantidad', '<div class="error" style="color:red;">', '</div>'); ?>
                <input type="number" name="cantidad" value="<?php echo set_value('cantidad'); ?>" min="1" />
            </p>
            <!-- Hay que comprobar en el servidor que los datos enviados son correctos -->
            </form>

            <div id="contenedorBotonesCompra">
                <div id="anadirCarrito" class="botonCompra">
                    <p>Añadir al carrito</p>
                </div>

                <div id="comprar" class="botonCompra">
                    <p>Comprar ahora</p>
                </div>
            </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis aliquam placerat. Phasellus tristique nibh diam, in faucibus quam luctus ut. Pellentesque sed purus vitae dui ultrices pellentesque. Nullam pellentesque turpis sed lobortis efficitur. Duis quis ultrices nibh. Sed imperdiet elementum pharetra. Etiam vitae venenatis lectus, sed condimentum felis. Nullam eleifend purus et purus blandit, in tempor metus varius. Nam ipsum dui, venenatis a ullamcorper a, facilisis id neque. Fusce rhoncus nisl ac pulvinar iaculis. Pellentesque lacinia ullamcorper arcu, vehicula rhoncus dolor ornare in. Etiam interdum mi sed nisi vulputate congue. Sed molestie ante non enim commodo efficitur.

                Nam sed orci congue, pharetra elit id, lobortis ipsum. Fusce lacus magna, lobortis vitae lacinia sed, convallis et lacus. Nunc venenatis neque quis felis lacinia, in sagittis ex suscipit. Proin efficitur eget ante id lacinia. Phasellus commodo rhoncus est non aliquet. Suspendisse potenti. Aenean vel laoreet nibh. Maecenas auctor leo semper diam porttitor efficitur. Praesent ac sapien dignissim sem lobortis ultrices at vel metus. Nam sit amet felis ac eros tempus imperdiet. Mauris molestie, nibh vitae euismod aliquet, tortor ipsum vestibulum massa, nec dignissim diam ipsum nec leo. Fusce nisi mi, auctor sit amet ante placerat, sollicitudin pretium urna. Nulla mollis, ante quis commodo interdum, tortor dui efficitur dui, sed blandit sapien purus sit amet neque. Phasellus ac diam porttitor, lacinia lorem a, varius risus.

                Nullam metus lorem, malesuada efficitur nibh eget, dignissim sagittis dui. Nullam elementum lacus fringilla ultricies elementum. Integer luctus lectus nec risus porta, nec pellentesque nisl hendrerit. Aenean gravida auctor porta. Proin at ex sed augue pellentesque efficitur. Sed posuere pretium libero eget dictum. Ut congue elementum euismod.

                Morbi nec sollicitudin mauris, a tincidunt lectus. Ut id dui ut lacus iaculis volutpat in in velit. Proin suscipit, nisi at tempus laoreet, lorem enim ultricies nibh, a pharetra est velit ut risus. Quisque eu efficitur nisl. Ut pretium felis non nulla aliquam, id dignissim odio lobortis. Curabitur ex quam, blandit ut placerat in, maximus ac nulla. Maecenas risus tortor, consectetur et placerat at, faucibus at leo. In volutpat mauris ut nibh vulputate imperdiet.

                Quisque et purus et sem euismod bibendum. Sed fermentum nulla at sapien egestas elementum. Aenean ut quam pharetra, tristique odio in, ultricies velit. Mauris consectetur, purus vel imperdiet pharetra, turpis orci interdum dui, facilisis rutrum risus dolor at purus. Suspendisse sit amet dapibus libero. Praesent ut mi fringilla, scelerisque sem nec, posuere sem. Nunc elementum, est in pretium porta, eros nisl pulvinar sapien, ut tristique mi turpis nec mi. Curabitur aliquet dui nec nisi accumsan aliquet. Quisque quis lorem metus. Donec varius elit nec ornare posuere.

                Donec mollis suscipit enim hendrerit blandit. Cras orci dolor, feugiat nec pretium sit amet, sollicitudin eget ante. Nunc faucibus pharetra luctus. Donec at ante augue. Ut blandit ultrices urna, rutrum ultrices dui sollicitudin in. Praesent a vestibulum urna. Mauris non enim vestibulum, imperdiet nunc eget, tempus ligula. Quisque justo metus, porta at risus sit amet, viverra rutrum felis. In ullamcorper egestas velit id fringilla. In velit odio, semper in egestas sit amet, tempor sit amet magna.

                Nulla vitae ultrices neque. Morbi placerat ante in elementum finibus. Vivamus maximus, tortor et facilisis mollis, massa diam eleifend tortor, vitae aliquet orci lorem nec nisi. Praesent hendrerit tincidunt eros. Phasellus augue dui, cursus in elementum eget, blandit a risus. Cras at enim eget risus aliquet suscipit at quis tortor. Curabitur at massa ornare, vestibulum risus id, tempus neque. Integer sodales venenatis enim id mattis. Nunc egestas diam id lacus tincidunt mollis. Nunc et diam sem. Fusce vel finibus nisi. Aenean id neque eu tortor scelerisque consequat.

                In interdum ligula in est auctor, sit amet venenatis libero consequat. Suspendisse interdum, leo in posuere pulvinar, ante leo consequat nibh, sed accumsan diam leo in nisi. Nam vitae augue erat. Morbi eu metus a enim mattis convallis. Aenean non tristique odio, ac accumsan sapien. Morbi et pulvinar lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue scelerisque arcu quis blandit.

                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque sit amet erat a quam mattis porttitor eu ac ipsum. Pellentesque elementum purus lectus, eu aliquet felis blandit nec. Quisque massa tellus, tincidunt ut mattis a, condimentum sed lorem. Donec pellentesque arcu odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque laoreet purus lorem, pretium pharetra mi feugiat eu. Aenean sagittis massa id justo imperdiet, sed egestas elit sollicitudin. Pellentesque molestie dolor urna, quis vehicula odio consequat vitae. Duis eu iaculis urna, eget varius enim. Nam tincidunt lobortis gravida. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam metus leo, volutpat eu volutpat sit amet, luctus quis est.

                Morbi tincidunt nunc ipsum, ac fermentum nibh vehicula a. Cras imperdiet aliquam nulla eget finibus. Fusce fringilla tortor et leo imperdiet viverra. Nam faucibus a lacus sed vestibulum. Sed tempus diam dictum venenatis posuere. Quisque posuere nunc vel magna egestas, at porta turpis ullamcorper. Vestibulum id ipsum ac neque interdum fermentum in sed libero. Pellentesque volutpat augue sapien, a faucibus metus placerat quis. In non lacus tristique, vehicula magna bibendum, bibendum erat. Nullam egestas pretium justo iaculis molestie. Praesent dictum mi eros, eu ultrices dui congue congue.
            </p>
        </div>

    </div><!-- id="contenedorProducto" -->

</section>