<?php  

    // Incluimos las constantes
    include('../config/constants.php');

    /*  
        * 1. Obtener el ID del adiministrador que sera eliminado
    */
    $id = $_GET['id'];

    /*  
        * 2. Crear la consulta SQL para eliminar el admin
    */
    $sql = "DELETE FROM tbl_admin WHERE id='$id'";

    // Ahora ejecutamos la consulta
    $res = mysqli_query($conn, $sql);

    // Verificamos si la consulta se realizo o no
    if($res == true) {
        // SI
        /* echo "Deleted succesfully!"; */
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        // header ('Location:'.SITEURL.'admin/manage-admin.php');

    } else {
        // NO
        // echo "No succesfully deleted.";

        $_SESSION['delete'] = "<div class='error'>Failed delete. Try again!</div>";
        // header('Location:'.SITEURL.'admin/manage-admin.php');
    }

    /*  
        * 3. Redirigir a la pagina de gestor de administradores con el mensaje de (Exito/Error)
    */
    header ('Location:'.SITEURL.'admin/manage-admin.php');


?>
