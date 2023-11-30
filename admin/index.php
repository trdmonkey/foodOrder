<?php include('partials/menu.php'); ?>

<!--  
    * MAIN SECTION
-->
<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>

        <?php
            if(isset($_SESSION['login'])) {
                echo ($_SESSION['login']);
                unset($_SESSION['login']);
            }
        ?>

        <div class="col-4 text-center">

            <?php

            // Crear la consulta SQL para las categorias
            $sql = "SELECT * FROM tbl_category";

            // Ejecutar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar las filas
            $count = mysqli_num_rows($res);

            ?>

            <h1><?= $count; ?></h1>
            Categories
        </div>

        <div class="col-4 text-center">

            <?php
            // Consulta para los productos
            $sql2 = "SELECT * FROM tbl_food";

            // Ejecutar la consulta
            $res2 = mysqli_query($conn ,$sql2);

            // Contar los registros
            $count2 = mysqli_num_rows($res2);
            ?>

            <h1><?= $count2; ?></h1>
            Foods
        </div>

        <div class="col-4 text-center">

            <?php
            // Crear la consulta para las ordenes
            $sql3 = "SELECT * FROM tbl_order";

            // Ejecutar la consulta
            $res3 = mysqli_query($conn, $sql3);

            // Contar las filas
            $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?= $count3; ?></h1>
            Total Orders
        </div>

        <div class="col-4 text-center">

            <?php
            // Crear la cadena para la sumatoria de ventas
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Entregado'";
            /* $sql4 = "SELECT SUM(total) AS Total FROM tbl_order"; */

            // Ejecutar la consulta
            $res4 = mysqli_query($conn, $sql4);

            // Obtener el atributo TOTAL de la tabla
            $row4 = mysqli_fetch_assoc($res4);

            // Tener la sumatoria del atributo llamado total
            $total_revenue = $row4['Total'];
            ?>

            <h1>$ <?= $total_revenue; ?></h1>
            Revenue Generated
        </div>

        <div class="clearfix"></div>

    </div>
</div>

<?php include('partials/footer.php');