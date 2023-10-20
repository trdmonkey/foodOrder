<?php
    // Verificar si el usuario se ha logueado o no - AUTORIZACION DE ACCESO
    if(!isset($_SESSION['user'])) {
        // Si el usuario no es logueado - redirigir a la pagina de login
        $_SESSION['no-login-message'] = "<div class='error'>Por favor inicie session para acceder al panel de administración.</div>";
        header('Location:'.SITEURL.'admin/login.php');
    }
?>
