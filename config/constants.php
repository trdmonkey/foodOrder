<?php 

    /*  
        * Inciar SESSION
    */
    session_start();


    /* 
        * Crear constantes y almacenar sin repetir valores
        // Recordemos que las CONSTANTES siempre van en mayusculas y las variables en minusculas
    */    
    define('SITEURL', 'http://localhost/RestaurantOne/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'foodOrder');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>