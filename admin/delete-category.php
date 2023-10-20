<?php
    // Incluir las constantes
    include('../config/constants.php');


    /* $uno = $_GET['id'];
    $dos = $_GET['image_name']; */

    // Verificar si el id y la imagen si estan llegando
    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        // vamos a obtener el valor y luego eliminar
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remover la imagen fisica disponible
        if($image_name != "") {
            // Imagen fisica (osea en la carpeta del proyecto) disponible, para ser eliminada
            $path = "../images/category/".$image_name;

            // Remover la imagen
            $remove = unlink($path);

            // si falla la eliminacion mostrar el mensaje de error y parar todos los procesos
            if($remove == false) {
                // Colocar el mensaje de SESSION
                $_SESSION['remove'] = "<div class='error'>Fallo al remover la imagen.</div>";

                // Redirigir a la pagina de categorias
                header('Location:'.SITEURL.'admin/manage-category.php');

                // Parar todo el proceso
                die();
            }
        }
        // Eliminar la info de la BD
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Ejecutar la consulta SQL
        $res = mysqli_query($conn, $sql);

        // ahora vamos a verificar si la info fue eliminada de la BD
        if($res == true) {
            // Mostrar el mensaje de confirmacion y redirigir la pagina
            $_SESSION['delete'] = "<div class='success'>Categoria eliminada.</div>";

            // Redirigir la pagina
            header('Location:'.SITEURL.'admin/manage-category.php');
        } else {
            // Mostrar el mensaje de error y redirigir
            $_SESSION['delete'] = "<div class='error'>Categoria NO eliminada, por favor intente nuevamente.</div>";

            // Redirigir
            header('Location:'.SITEURL.'admin/manage-category.php');
        }

        // Redirigir a la pagina de categorias con el mensaje de confirmacion
        // header('Location:'.SITEURL.'admin/manage-category.php');

    } else {
        // redirigir a la pagina de categorias
        header('Location:'.SITEURL.'admin/manage-category.php');


    }
?>

