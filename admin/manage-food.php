<?php include('partials/menu.php'); ?>

<!--  
    * FOOD 
-->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>

        <br>
        <!--  
            * BOTON AGREGAR ADMIN
        -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <!-- MENSAJES -->
        <?php
        $messages = array(
            'add' => 'add'
        );

        foreach ($messages as $key => $value) {
            if (isset($_SESSION[$key])) {
                echo $_SESSION[$key];
                unset($_SESSION[$key]);
            }
        }

        // Metodo antiguo
        /* if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        } */
        ?>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // Crear la consulta SQL para obtener los detalles de la tabla
            $sql = "SELECT * FROM tbl_food";

            // Ejecutar la consulta SQL
            $res = mysqli_query($conn, $sql);

            // Contar las filas para verificar si tenemos productos o no
            $count = mysqli_num_rows($res);

            // Crear el numero serial para la variable contador del S.N.
            $sn=1;

            if ($count > 0) {
                // hay productos en la BD
                // Obtener los productos de la BD
                while ($row = mysqli_fetch_assoc($res)) {
                    // Obtener los valores de forma individual
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php
                                // Verificar si tenemos la imagen
                                if($image_name=="") {
                                    // No hay imagen
                                    echo "<div class='error'>Imagen no encontrada.</div>";
                                } else {
                                    // Si tenemos imagen
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>                        
                        <td>
                            <a href="#" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" class="btn-terciary">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                // No hay productos en la BD
                echo "<tr><td colspan='7' class='error'> Producto no agregado. </td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>