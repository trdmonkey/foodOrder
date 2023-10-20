<?php
    // Incluir las constantes
    include('../config/constants.php');

    // 1. Vamos a cerrar la session por completo
    session_destroy();

    // 2. Redirigir a la pagina de login
    header('Location:'.SITEURL.'admin/login.php');
?>