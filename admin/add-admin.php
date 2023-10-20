<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Admin</h1><br>

        <?php 
            // Verificar si la info se guardo o no
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Mostrar en pantalla el mensaje de confirmacion
                unset($_SESSION['add']); // Limpiar el navegador del mensaje confirmado.
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                    
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php include('./partials/footer.php'); ?>

<?php 

    /* 
        * VAMOS A PROCESAR EL VALOR DEL FORMULARIO Y AGREGARLO A LA BASE DE DATOS
    */
    // Vamos a verificar si el usuario dio click al boton SUBMIT
    if(isset($_POST['submit'])) {
        // Button Clicked
        // echo "Button Clicked";

        // 1.  Vamos a obtener la informacion del formulario
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Vamos a encriptar la contraseña con MD5

        // 2.  Consulta SQL para guardar los datos en la BD
        $sql = "INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";

        /* echo $sql; */


        // 3.  Ejecutar la consulta y guardar los datos en la BD
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // 4.  Verificar si los datos se han insertado o no y mostrar el mensaje apropiado
        if($res == TRUE) {
            // Data inserted
            /* echo "Data inserted"; */

            // Crearemos un mensaje de confirmación
            $_SESSION['add'] = "<div class='success'>Admin Added Succesfully.</div>";

            // Ahora vamos a redirigir a la pagina admin.php
            header("location:".SITEURL.'admin/manage-admin.php');

        } else {
            // Data failed
            // echo "Failed Data";

            // Crearemos un mensaje de confirmación
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";

            // Ahora vamos a redirigir nuevamente a la pagina para agregar admin.php
            header("location:".SITEURL.'admin/add-admin.php');
        }




    }



?>
