<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1><br>

        <?php  
            // 1. Vamos a obtener el ID del administrador seleccionado
            $id = $_GET['id'];

            // 2. Crear la consulta SQL para obtener los detalles del registro a actualizar
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // 3. Ejecutar la consulta
            $res = mysqli_query($conn, $sql);

            // 4. Ahora verificamos si la consulta es ejecutada
            if($res == true) {
                // Ahora vamos a verificar si hay informacion de la tabla en la BD
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    // Obtener los detalles del registro a actualizar
                    /* echo "Admin disponible"; */

                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];

                } else {
                    // Redirigir a la pagina gestor de administradores
                    header('Location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <th>Full Name:</th>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <th>Username:</th>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- HIDDEN -->
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // Verificar si el usuario da click al boton SUBMIT 
    if(isset($_POST['submit'])) {
        // echo "Boton presionado satisfactoriamente";

        echo $id = $_POST['id'];
        echo $full_name = $_POST['full_name'];
        echo $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true) {
            // SUCCESSFULLY
            $_SESSION['update'] = "<div class='success'>Admin actualizado con exito</div>";
        } else {
            // FAILED
            $_SESSION['update'] = "<div class='error'>Fallo la actualizacion del administrador!</div>";
        }

        // echo "GUARDADO";
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }

?>

<?php include ('./partials/footer.php') ?>