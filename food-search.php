<?php include('./partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        
        // Obtener la busqueda de la palabra
        $search = $_POST['search'];

        ?>
        <h2>Foods on Your Search <a href="#" class="text-white">"<?= $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        // Realizar la busqueda con base en la palabra del input
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        // Ejectuar la consulta
        $res = mysqli_query($conn, $sql);

        // Contar las filas
        $count = mysqli_num_rows($res);

        // Verificar si hay productos disponibles
        if ($count > 0) {
            // Si hay productos disponibles en la busqueda
            while ($row = mysqli_fetch_assoc($res)) {
                // Obtener los detalles de cada busqueda encontrada
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Verificar si la imagen esta disponible
                        if($image_name=="") {
                            // Imagen no disponible
                            echo "<div class='error'>Imagen no disponible.</div>";
                        } else {
                            // Imagen disponible
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            // No hay busquedas encontradas
            echo "<div class='error'>Busqueda no encontrada.</div>";
        }

        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>