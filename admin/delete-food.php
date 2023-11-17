<?php

// Incluir CONSTANTS
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Proceder a eliminar
    // echo "PROCEDER A ELIMINAR";
    /* 1.  Obtener el ID y nombre de la Imagen */
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    /* 2.  Remover la imagen si esta disponible */
    // Verificar si la imagen esta disponible o no y eliminar solo si esta disponible
    if ($image_name != "") {
        // Hubo imagen y necesita ser eliminada de la carpeta del proyecto
        // Primero vamos a obtener la ruta de la imagen
        $path = "../images/food/" . $image_name;

        // Remover el archivo de la carpeta del proyecto
        $remove = unlink($path);

        // Ahora vamos a confirmar si la imagen fue eliminada o no
        if ($remove == false) {
            $_SESSION['upload'] = "<div class='error'>Fallo al eliminar la imagen.</div>";

            // Redirigir a la pagina manage food
            header('Location:' . SITEURL . 'admin/manage-food.php');

            // Para todos los procesos
            die();
        }
    }
    /* 3.  Eliminar de la base de datos */
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    // Ejecutar la cadena
    $res = mysqli_query($conn, $sql);

    // Verificar si la cadena se ejecuto y lanzar el mensaje respectivo
    if ($res == true) {
        // Exito.
        $_SESSION['delete'] = "<div class='success'>Producto eliminado con exito.</div>";
        header('Location:' . SITEURL . 'admin/manage-food.php');
    } else {
        // Error.
        $_SESSION['delete'] = "<div class='error'>El producto no fue eliminado.</div>";
        header('Location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // Redirigir a la pagina de productos
    $_SESSION['unauthorize'] = "<div class='error'>Acceso no autorizado.</div>";
    header('Location:' . SITEURL . 'admin/manage-food.php');
}
