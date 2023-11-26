    <?php include('./partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                /*  
                    * Crear la consulta SQL de las categorias
                */
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                // Ejecutar la constulta
                $res = mysqli_query($conn, $sql);

                // Contar filas
                $count = mysqli_num_rows($res);

                // Verificar si hay registros
                if($count>0) {
                    // Categorias disponibles
                    while($row=mysqli_fetch_assoc($res)) {
                        // Obtener todos los elementos del array
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    // Verificar si la imagen esta disponible  
                                    if($image_name=="") {
                                        // No hay imagen de categoria
                                        echo "<div class='error'>Imagen no disponible.</div>";
                                    } else {
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
                    // Categorias no disponibles
                    echo "<div class='error'>Categoria no encontrada.</div>"; 

                }
            ?>

            <!-- <a href="#">
                <div class="box-3 float-container">
                    <img src="images/burger.jpg" alt="Burger" class="img-responsive img-curve">

                    <h3 class="float-text text-white">Burger</h3>
                </div>
            </a>

            <a href="#">
                <div class="box-3 float-container">
                    <img src="images/momo.jpg" alt="Momo" class="img-responsive img-curve">

                    <h3 class="float-text text-white">Momo</h3>
                </div>
            </a> -->

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
                // Obtener los productos de la BD que estan active y featured
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                // Ejecutar la consulta
                $res2 = mysqli_query($conn, $sql2);

                // Contar filas
                $count2 = mysqli_num_rows($res2);

                // Verificar si hay productos disponibles
                if($count>0) {
                    // Productos disponibles
                    while($row=mysqli_fetch_assoc($res2)) {
                        // Obtener todos los valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="") {
                                        // Imagen no disponible.
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
                    // Productos no disponibles.
                    echo "<div class='error'>Productos no disponibles.</div>";
                }
            ?>    

            
            <div class="clearfix"></div>
        </div>


        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./partials-front/footer.php'); ?>