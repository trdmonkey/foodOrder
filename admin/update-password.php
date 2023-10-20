<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <?php  
            $id = $_GET['id'];
            
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <th>Current Password:</th>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <th>New Password:</th>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <th>Confirm Password:</th>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm New Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php
    // Verificar si el boton SUBMIT fue presionado por el usuario
    if(isset($_POST['submit'])) {
        /* echo "Clicked"; */

        // 1. Obtener la informacion del formulario FORM
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. Verificar si el usuario y la contraseña actual existen o no
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // Ejecutar la cadema sql
        $res = mysqli_query($conn, $sql);

        // 3. Verificar si el nuevo password y la confirmacion, coinciden o no
        if($res == true) {
            // Verificar si la informacion de la cadena esta disponible o no
            $count = mysqli_num_rows($res);

            if($count == 1) {
                // Usuario y contraseña existen y pueden ser cambiados
                // echo "ENCONTRADO";

                // Ahora verificamos si la nueva contraseña y la confirmacion coinciden
                if($new_password == $confirm_password) {
                    // Actualizar contraseña
                    // echo "COINCIDENCIA EXITOSA";
                    $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                    // Ejecutamos la consulta
                    $res2 = mysqli_query($conn, $sql2);

                    // Verificamos si la consulta se ejecutó o no
                    if($res2 == true) {
                        // Mostramos en pantalla el mensaje de confirmacion
                        $_SESSION['change-pwd'] = "<div class='success'>Contraseña cambiada con exito.</div>";
                        header('Location:'.SITEURL.'admin/manage-admin.php');
                    } else {
                        // Redirigimos a la pagina de gestor de administradores con el mensaje de error
                        $_SESSION['change-pwd'] = "<div class='error'>Fallo el cambio de contraseña.</div>";
                        header('Location:'.SITEURL.'admin/manage-admin.php');
                    }

                } else {
                    // Redirigir a la pagina de administradores con el mensaje de error
                    $_SESSION['pwd-not-match'] = "<div class='error'>El nuevo password y la confirmación no coinciden.</div>";
                    header('Location:'.SITEURL.'admin/manage-admin.php');
                }

            } else {
                // usuario o contraseña no existen, vamos a redirigir a la pagina de gestor de administradores
                $_SESSION['user-not-found'] = "<div class='error'>Usuario o contraseña no encontrados.</div>";

                // Redirigir a la pagina de gestor de administradores
                header('Location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        // 4. Cambiar la contraseña si todo lo anterior es verdadero
    }
?>

<?php include('./partials/footer.php'); ?>