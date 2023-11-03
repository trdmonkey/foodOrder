<?php include('./partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <?php
        $messages = array(
            'upload' => 'upload'
        );

        foreach ($messages as $key => $value) {
            if (isset($_SESSION[$key])) {
                echo $_SESSION[$key];
                unset($_SESSION[$key]);
            }
        }

        /* if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        } */

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="  Nombre del producto">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="20" rows="5" placeholder=" Descripcion del producto"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" placeholder="  Precio del producto">
                    </td>
                </tr>

                <tr>
                    <td>Imagen</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">

                            <?php
                            // Crear el display del select de la BD
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            // Ejecutar la consulta
                            $res = mysqli_query($conn, $sql);

                            // Contar las filas si hay categorias disponibles
                            $count = mysqli_num_rows($res);

                            // Validar si la suma de categorias es mayor a cero 
                            if ($count > 0) {
                                // Tenemos categorias disponibles
                                while($row = mysqli_fetch_assoc($res)) {
                                    // Obtener los detalles de las categorias
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>    
                                    <?php
                                }
                            } else {
                                // No hay categorias
                            ?>
                                <option value="0">No hay cateogorias.</option>
                            <?php
                            }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        
        <?php
        
        // Verificar si el boton submit es seleccionado o no
        if(isset($_POST['submit'])) {
            // Agregar los productos a la BD
            // echo "clicked";

            // 1.  Obtener la informacion del form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            // Verificar si los radio buttons estan seleccionados
            if(isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";  // Esto para colocar un valor por defecto
            }
            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // 2.  Subir la imagen si esta seleccionada solo si fue seleccionada
            // Verificar si la imagen fue seleccionada o no
            if(isset($_FILES['image']['name'])) {
                // Obtener los detalles de la imagen seleccionada
                $image_name = $_FILES['image']['name'];

                // Verificar si la imagen es seleccionada o no, y subir la imagen solo si fue seleccionada
                if($image_name != "") {
                    // La imagen ya esta seleccionada del explorador de archivos
                    // A.  Renombrar la imagen
                    // Obtener la extencion de la imagen seleccionada (jpg, png, gif, etc)
                    $ext = end(explode('.', $image_name));
                    
                    // Crear el nuevo nombre a la imagen
                    $image_name = "Food-name-".rand(0000,9999).".".$ext;

                    // B.  Subir la imagen
                    // Obtener la ruta origen y el destino de la imagen

                    // La ruta de origen es la ubicacion actual de la imagen
                    $src = $_FILES['image']['tmp_name'];

                    // Ahora la ruta de destino para que la imagen sea subida
                    $dst = "../images/food/".$image_name;

                    // Finalmente subir la imagen
                    $upload = move_uploaded_file($src, $dst);

                    // Verificar si la imagen fue subida o no
                    if($upload == false) {
                        // Fallo al subir la imagen
                        // Redirigir a la pagina de comidas con el mensaje de error
                        $_SESSION['upload'] = "<div class='error'>Fallo al subir la imagen.</div>";
                        header('Location:'.SITEURL.'admin/add-food.php');
                        // Para todos los procesos
                        die();
                    }
                }
            } else {
                $image_name = "";   // Colocar un valor por vacio por defecto
            }

            /* 3.  Insertar la info en la BD */
            // Crear la consulta SQL
            $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price='$price', image_name='$image_name',  ";



            // 4. Redirigir a la pagina y mostrar el mensaje de confirmacion
            
        }
        
        ?>


    </div>
</div>

<?php include('./partials/footer.php') ?>