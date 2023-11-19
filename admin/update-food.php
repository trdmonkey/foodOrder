<?php include './partials/menu.php'; ?>

<?php
    if(isset($_GET['id'])) {
        // Obtener todos los detalles
        $id = $_GET['id'];

        // Realizar la consulta a la BD con ese id
        $sql2 = "SELECT * FROM tbl_food WHERE id='$id'";

        // Ejecutar la consulta
        $res2 = mysqli_query($conn, $sql2);

        // Obtener los valores individuales de la consulta
        $row2 = mysqli_fetch_assoc($res2);

        // Sacar los atributos del arreglo asociativo
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    } else {
        // Redirigir a la pagina manage food
        header('Location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="20" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                            if($current_image == "") {
                                // Imagen no disponible
                                echo "<div class='error'>Imagen no disponible. </div>";
                            } else {
                                // Imagen disponible
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px" style="border: 2px solid silver; border-radius: 5%;" >
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                                // Consulta sql para obtener las categorias activas
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Ejectuar la consulta
                                $res = mysqli_query($conn, $sql);

                                // Contar los registros
                                $count = mysqli_num_rows($res);

                                // Verificar si hay categorias disponibles en la consulta
                                if($count>0) {
                                    // Categoria disponible
                                    while($row=mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        // echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id) { echo "selected"; } ?> value="<?php echo $category_id; ?>"> &nbsp; <?php echo $category_title; ?></option>
                                        <?php
                                    }
                                } else {
                                    // Categoria NO disponible
                                    echo "<option value='0'>No Disponible.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <?php
            if(isset($_POST['submit'])) {
                // echo "Boton machucado";
                /* 
                    * 1.  Obtener los detalles del formulario 
                */
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                /* 
                    * 2.  Subir la imagen seleccionada 
                */
                // Vamos a verificar si el boton de subir imagen fue presionado para obtener los datos de la imagen: archivo imagen y nombre
                if(isset($_FILES['image']['name'])) {
                    // Boton Upload clicked
                    $image_name = $_FILES['image']['name']; // Este seria el nombre de la nueva imagen

                    // Verificar si la imagen esta disponible o no
                    if($image_name != "") {
                        // Imagen disponible
                        // A. Subiendo la nueva imagen


                        // Obtener la extension de la imagen
                        // $ext = end(explode('.', $image_name));

                        $imageArray = explode('.', $image_name);
                        $ext = end($imageArray);

                        // Renombramos la imagen para llevar un orden de los archivos de imagenes en la carpeta del proyecto
                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;

                        // Obtener la fuente de origen y la ruta destino
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        // Subir la imagen
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Verificar si la imagen fue subida A LA CARPETA DE IMAGENES
                        if($upload == false) {
                            // Fallo al subir la imagen
                            $_SESSION['upload'] = "<div class='error'>Fallo al subir la nueva imagen.</div>";

                            // Redirigir a manage food
                            header('Location:'.SITEURL.'admin/manage-food.php');

                            // Parar todos los procesos
                            die();
                        }
                        /* 
                            * 3.  Remover la imagen si selecciona nueva imagen y la imagen actual existe 
                        */
                        // B.  Remover la imagen actual si esta disponible
                        if($current_image != "" ) {
                            // La imagen actual esta disponible para remover
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            // Verificar si la imagen fue eliminada de la carpeta
                            if($remove == false) {
                                // Fallo al eliminar la imagen de la carpeta
                                $_SESSION['remove-failed'] = "<div class='error'>Fallo al remover la imagen actual.</div>";

                                // Redirigir a manage food
                                header('Location:'.SITEURL.'admin/manage-food.php');

                                // Parar todos los procesos
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image; // Para cuando la imagen no esta disponible    
                    }
                } else {
                    $image_name = $current_image; // Para cuando el usuario no ha presinado el boton de upload image
                }
                /* 
                    * 4.  Actualizar la informacion en la BD 
                */
                $sql3 = "UPDATE tbl_food SET title='$title', description='$description', price=$price, image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id=$id";

                // Ejecutar la consulta SQL
                $res3 = mysqli_query($conn, $sql3);

                // Verificar si la consulta se ejecuto
                if($res3 == true) {
                    // Consulta ejecutada
                    $_SESSION['update'] = "<div class='success'>Informacion actualizada con exito.</div>";
                    echo '<script>window.location.href = "'.SITEURL.'admin/manage-food.php";</script>'; // CODIGO PARA REEMPLAZAR EL HEADER LOCATION
                } else {
                    // Fallo la actualizacion de la informacion
                    $_SESSION['update'] = "<div class='error'>Fallo al actualizar la información.</div>";
                    echo '<script>window.location.href = "'.SITEURL.'admin/manage-food.php";</script>';
                }
                /* 
                    * 5.  Redirigir a manage-food con el mensaje de confirmacion
                */
                
            }
        ?>
    </div>
</div>

<?php include('./partials/footer.php'); ?>