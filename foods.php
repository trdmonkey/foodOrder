<?php include('./partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?= SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        // Mostrar los productos que estan activos
        /* $sql = "SELECT * FROM tbl_food WHERE active='Yes'"; */
        $sql = "SELECT * FROM tbl_food WHERE active='Yes' ORDER BY category_id";


        // Ejecutar la consulta
        $res = mysqli_query($conn, $sql);

        // Contar los registros (filas)
        $count = mysqli_num_rows($res);

        // Verificar si los productos estas disponibles
        if ($count > 0) {
            // Productos disponibles
            while($row=mysqli_fetch_assoc($res)) {
                // Obtener los valores
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Verificar si la imagen esta disponible
                        if($image_name == "") {
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

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            // Productos NO disponibles
            echo "<div class='error'>Producto no encontrado.</div>";
        }

        ?>
        
        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>