<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">        

        <?php
        // Verificar si llamamos el id del registro a modificar
        if(isset($_GET['id'])) {
            
            // Obtener los detalles de la orden de pedido
            $id = $_GET['id'];

            // Crear la consulta SQL para obtener los detalles del id
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            // Ejecutar la consulta SQL
            $res = mysqli_query($conn, $sql);

            // Contar las filas
            $count = mysqli_num_rows($res);

            // Verificar si hay registros
            if($count==1) {
                
                // Detalles de la orden disponibles
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

            } else {

                // Redirigir a la pagina de ordenes
                header('Location:'.SITEURL.'admin/manage-order.php');

            }

        } else {

            // Redirigir a la pagina de ordenes
            header('Location:'.SITEURL.'admin/manage-order.php');

        }
        ?>

        <h1>Update Order No. <?= $id; ?></h1>
        <br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td>
                        <b><?php echo $food; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>$ <?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Pedido") { echo "selected"; } ?> value="Pedido">Pedido</option>
                            <option <?php if($status=="Despachado") { echo "selected"; } ?> value="Despachado">Despachado</option>
                            <option <?php if($status=="Entregado") { echo "selected"; } ?> value="Entregado">Entregado</option>
                            <option <?php if($status=="Cancelado") { echo "selected"; } ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?= $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="50" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">                        
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <!-- Boton -->
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        
        // Validar si se presionno el boton SUBMIT
        if(isset($_POST['submit'])) {
            // echo "Clikeado.";

            // Obtener los datos del formulario
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // Actualizar los valores en la BD
            $sql2 = "UPDATE tbl_order SET 
                qty = $qty, 
                total = $total, 
                status = '$status', 
                customer_name = '$customer_name', 
                customer_contact = '$customer_contact', 
                customer_email = '$customer_email', 
                customer_address = '$customer_address'
                WHERE id=$id
            ";

            // Ejectuar la consulta
            $res2 = mysqli_query($conn, $sql2);

            // Verfificar si se ejecuto la consulta y Redirigir a la pagina de manage orders con el mensaje de confirmacion
            if($res2==true) {
                // Datos actualizados
                $_SESSION['update'] = "<div class='success text-center'>Orden de pedido actualizada con exito.</div>";
                header('Location:'.SITEURL.'admin/manage-order.php');
            } else {
                // Fallo en la actualizacion
                $_SESSION['update'] = "<div class='error text-center'>No se pudo actualizar la orden de.</div>";
                header('Location:'.SITEURL.'admin/manage-order.php');
            }


        }
        
        ?>

    </div>
</div>

<?php include('./partials/footer.php'); ?>