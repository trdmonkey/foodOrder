<?php include('partials/menu.php'); ?>

<!--  
    * CATEGORY 
-->
<div class="main-content">
    <div class="wrapper">
        <h1>CATEGORY</h1>

        <?php
        $messages = array(
            'add' => 'add',
            'delete' => 'delete',
            'update' => 'update',
            'remove' => 'remove'
        );

        foreach ($messages as $key => $value) {
            if (isset($_SESSION[$key])) {
                echo $_SESSION[$key];
                unset($_SESSION[$key]);
            }
        }

        // METODO ANTIGUO
        /* if(isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        } */
        ?>

        <br>
        <!--  
            * BOTON AGREGAR ADMIN
        -->
        <!-- <a href="./add-category.php" class="btn-primary">Add Category</a> -->
        <a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            // Consulta para obtener todas las categorias de la BD
            $sql = "SELECT * FROM tbl_category";

            // Ejecutar la consulta SQL
            $res = mysqli_query($conn, $sql);

            // Contar las filas de registros
            $count = mysqli_num_rows($res);

            // Crear un contador para la columna S.N.
            $sn = 1;

            // Verificar si hay datos en la BD
            if ($count > 0) {
                // Si hay data
                // Obtener la data y mostrarla
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                // Verificar si la imagen esta disponible o no
                                if($image_name != "") {
                                    // Mostrar la imagen
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="80px;">
                                    <?php
                                } else {
                                    // Mostrar el mensaje de error
                                    echo "<div class='error'>Imagen no agregada.</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-terciary">Delete</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                // No hay data
                // Mostrar el mensaje de error
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">Categoria no agregada.</div>
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>