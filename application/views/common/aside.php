<div id="content">
    <div id="aside-container">
        <aside>
            <div id="categoriasTitle" class="underHeader">
                <p>Categorias</p>
            </div>

            <?php

            echo '<ul id="categorias">';

            foreach ($categorias as $categoria) {

                if (isset($_GET['categoria']) && $categoria->categoria_nombre == $_GET['categoria']) {
                    echo '<li class="categoriaSeleccionada">';
                    echo '<a href="' . base_url() .'index.php/Categoria?categoria=' . urlencode($categoria->categoria_id) . '">';
                    echo $categoria->categoria_nombre;
                    echo '</a>';
                    echo '</li>';
                    //echo "<li class='categoriaSeleccionada'><a href=\"" . base_url() . "index.php/Categoria\">" . $categoria . "</a></li>";
                } else {
                    echo '<li>';
                    echo '<a href="' . base_url() .'index.php/Categoria?categoria=' . urlencode($categoria->categoria_id) . '">';
                    echo $categoria->categoria_nombre;
                    echo '</a>';
                    echo '</li>';
                    //echo "<li><a href=\"" . base_url() . "index.php/Categoria\">" . $categoria . "</a></li>";
                }
            }
            echo "</ul>";

            ?>


        </aside>
    </div>