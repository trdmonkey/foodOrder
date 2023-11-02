<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE CATEGORY</h1><br>

        <?php
        // Verificar el id a actualizar
        if (isset($_GET['id'])) {
            // Obtener el id 
            // echo "Getting the dataaaaaaaaaaa";
            $id = $_GET['id'];

            // Crear la consulta SQL para obtener todos los detalles por registro
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // Ahora vamos a ejectuar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar las filas para verificar si el id es valido o no
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Obtener la informacion
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirigir a la pagina de categorias y mostrar el mensaje de error
                $_SESSION['no-category-found'] = "<div class='error'>Categoria no encontrada.</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            // Redirigir a la pagina de categorias
            header('Location:' . SITEURL . 'admin/manage-category.php');
        }


        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Title</th>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <th>Current Image</th>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Mostrar la imagen
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            // Mostrar el mensaje de error
                            echo "<div class='error'>Imagen NO encontrada.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>New Image</th>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <th>Featured</th>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <th>Active</th>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // echo "Clicked";
            // 1.  Vamos a obtener los valores del formulario
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // 2.  Actualizando la imagen si esta seleccionada
            // Verificar si la imagen esta seleccionada
            if ($_FILES['image']['name']) {
                // Obtener los detalles de la imagen
                $image_name = $_FILES['image']['name'];

                // Verificar si la imagen esta disponible
                if ($image_name != "") {
                    // Imagen disponible
                    // A.  Vamos a actualizar la nueva imagen


                    // ================================================================================================= COPIADO DE add-category.php
                    // Auto renombrar la imagen subida
                    // Obtener la extension de la imagen (jpg, png, gif, etc)
                    $ext = end(explode('.', $image_name));

                    // Renombra imagen
                    $image_name = "Food_Category_" . rand(000, 999) . "." . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Finalmente vamos a subir la imagen
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // verificar si la imagen fue subida o no y si la imagen no fue subida, redirigir y mostrar el mensaje de error
                    if ($upload == false) {
                        // Mensaje de error
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";

                        // Redirigir a la pagina de administrador de categorias
                        header('Location:' . SITEURL . 'admin/manage-category.php');

                        // Para el proceso de subida
                        die();
                    }
                    // =================================================================================================

                    // B.  Ahora remover la imagen antigua si esta disponible
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        // Verificar si la imagen antigua fue removida del directorio de carpetas del proyecto
                        // Si no se ha removido la imagen, mostrar el mensaje de error y parar todos los procesos
                        if ($remove == false) {
                            // Fallo eliminar la imagen del directorio
                            $_SESSION['failed-remove'] = "<div class='error'>Fallo al remover la imagen del directorio.</div>";
                            header('Location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // 3.  Actualizar la info en la BD
            $sql2 = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id=$id";

            // Ejecutar la consulta SQL
            $res2 = mysqli_query($conn, $sql2);

            // 4.  Redirigir a la pagina de categorias con el mensaje de confirmacion
            // Verificar si se ejecuto la consulta
            if ($res2 == true) {
                // Categoria actualizada
                $_SESSION['update'] = "<div class='success'>Categoria actualizada con exito.</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Problemas al actualizar categoria
                $_SESSION['update'] = "<div class='error'>Categoria NO actualizada.</div>";
                header('Location:' . SITEURL . 'admin/manage-category.php');
            }

            // REVISAR                    header('Location:'.SITEURL.'admin/manage-category.php');
        }
        ?>

    </div>
</div>

<?php include('./partials/footer.php'); ?>