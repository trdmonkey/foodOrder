<?php include('./partials-front/menu.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
            // Mostrar todas las categorias activas
            // Consulta SQL
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            // Ejecutar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar las filas
            $count = mysqli_num_rows($res);

            // Verificar si hay categorias disponibles
            if($count>0) {
                // Si hay categorias
                while($row=mysqli_fetch_assoc($res)) {
                    // Obtener los valores del arreglo asociativo
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name=="") {
                                    // Imagen no disponible
                                    echo "<div class='error'>Imagen no encontrada.</div>";
                                } else {
                                    // Imagen disponible
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                // No hay categorias disponibles
                echo "<div class='error'>Categoria no encontrada.</div>";
            }
            
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>