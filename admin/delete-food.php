<?php 

// Incluir CONSTANTS
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])) {
    // Proceder a eliminar
    echo "PROCEDER A ELIMINAR";
} else {
    // Redirigir a la pagina de productos
    $_SESSION['delete'] = "<div class='error'>Acceso no autorizado.</div>";
    header('Location:'.SITEURL.'admin/manage-food.php');
}

?>