<?php include('./partials-front/menu.php'); ?>

<?php
// Verificar si esta pasando el id de la categoria seleccionada
if(isset($_GET['category_id'])) {
    // Afirmativo
    $category_id = $_GET['category_id'];

    // Obtener el titulo de la categoria
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    // Ejectuar la consulta
    $res = mysqli_query($conn, $sql);

    // Obtener el valor de la BD
    $row = mysqli_fetch_assoc($res);

    // Obtener el valor del titulo
    $category_title = $row['title'];

} else {
    // Negativo
    // Redirigir a la pagina de home
    header('Location:'.SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Crear la consulta SQL con base en la categoria seleccionada
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

        // Ejecutar la consulta
        $res2 = mysqli_query($conn, $sql2);

        // Contar las filas
        $count = mysqli_num_rows($res2);

        // Verificar si hay filas disponibles
        if($count>0) {
            // Si
            while($row2=mysqli_fetch_assoc($res2)) {
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Validar si hay imagenes
                        if($image_name=="") {
                            // No hay imagenes
                            echo "<div class='error'>Imagen no disponible.</div>";
                        } else {
                            // Si hay
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
            // no
            echo "<div class='error'>Productos no encontrados.</div>";
        }

        ?>        

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>