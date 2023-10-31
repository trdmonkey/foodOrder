<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- INICIO formulario categorias -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <th>Title:</th>
                    <td>
                        <input type="text" name="title" placeholder="Title Category">
                    </td>
                </tr>

                <tr>
                    <th>Imagen:</th>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <th>Featured:</th>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <th>Active:</th>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- FIN formulario categorias -->

        <?php
        // Verificar si el boton submit fue presionado
        if (isset($_POST['submit'])) {
            // 1. Obtenemos la informacion del formulario
            $title = $_POST['title'];

            // 2. Para obtener la info del radio button debemos verificar si se presiona el boton
            if (isset($_POST['featured'])) {
                // Obtenemos el valor del radio button
                $featured = $_POST['featured'];
            } else {
                // Colocamos el valor por defecto
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Cargar la imagen y ponerle nombre
            /* print_r($_FILES['image']); */
            /* die(); */ // CORTAR EL CODIGO HASTA ESTA PARTE

            if (isset($_FILES['image']['name'])) {
                // Subir la imagen
                $image_name = $_FILES['image']['name'];

                // Subir la imagen solo si la imagen esta seleccionada
                if ($image_name != "") {
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
                        header('Location:' . SITEURL . 'admin/add-category.php');

                        // Para el proceso de subida
                        die();
                    }
                }
            } else {
                // No subir la imagen y establecer el valor en blanco
                $image_name = "";
            }

            // 3. Creamos la consulta SQL
            $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

            // 4. Ejecutamos la consulta
            $res = mysqli_query($conn, $sql);

            // 5. Ahora verificamos si la consulta fue ejecutada y la informacion agregada a la BD
            if ($res == true) {
                // Consulta ejecutada y data subida a la BD
                $_SESSION['add'] = "<div class='success'>Categoria agregada con exito.</div>";

                // Redirigir a la pagina de administracion de categorias
                header('Location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Fallo al agregar la categoria
                $_SESSION['add'] = "<div class='error'>Fallo al agregar la categoria. Intente nuevamente!</div>";

                // Redirigir a la pagina de administracion de categorias
                header('Location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>