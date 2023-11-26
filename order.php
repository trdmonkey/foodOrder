<?php include('./partials-front/menu.php'); ?>

<?php
// Verificar si el id de los productos esta llamado
if(isset($_GET['food_id'])) {

    // Obtener el id del producto seleccionado
    $food_id = $_GET['food_id'];

    // Obtener los detalles  del producto seleccionado
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    // Ejecutar la consulta
    $res = mysqli_query($conn, $sql);

    // Contar los registros
    $count = mysqli_num_rows($res);

    // Verificar si hay informacion disponible
    if($count==1) {

        // Si hay data
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    } else {

        // No hay data | Redirigir a la pagina HOME
        header('Location:'.SITEURL);

    }
} else {

    // Redirigir a la pagina home
    header('Location:'.SITEURL);

}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // Verificar si hay imagen para mostrar
                    if($image_name=="") {
                        // No hay imagen
                        echo "<div class='error'>Imagen no encontrada.</div>";
                    } else {
                        // Si hay imagen
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Ingresa tu nombre completo." class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Ingresa tu numero de telefono." class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Ingresa tu correo electronico." class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="Ingresa tu dirección de domicilio." class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        
        // Verificar si el boton SUBMIT fue clickeado
        if(isset($_POST['submit'])) {

            // SI | Obtener los valores del FORM
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $order_date = date('Y-m-d H:i:s');
            $status = "Pedido"; // Pedido, En Camino, Entregado, Cancelado.

            // LADO DEL CLIENTE
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // date_default_timezone_set('America/Bogota');
            // date.timezone = "America/Bogota";

            // Guardar la informacion en la BD | Crear la consulta SQL
            $sql2 = "INSERT INTO tbl_order SET 
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
            ";

            // echo $sql2; die();

            // Ejecutar la consulta
            $res2 = mysqli_query($conn, $sql2);

            // Verificar si la consulta se ejecuto
            if($res2==true) {
                // Consulta ejecutada
                $_SESSION['order'] = "<div class='success'>Su PEDIDO ha sido confirmado con exito.</div>";
                header('Location:'.SITEURL);
            } else {
                // Fallo en la consulta
                $_SESSION['order'] = "<div class='error'>Su pedido no ha sido confirmado.</div>";
                header('Location:'.SITEURL);
            }
        } else {
            // NO

        }

        ?>


    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>