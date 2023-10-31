<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE CATEGORY</h1><br>

        <?php
        // Verificar el id a actualizar
        if(isset($_GET['id'])) {
            // Obtener el id 
            // echo "Getting the dataaaaaaaaaaa";
            $id = $_GET['id'];

            // Crear la consulta SQL para obtener todos los detalles por registro
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // Ahora vamos a ejectuar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar las filas para verificar si el id es valido o no
            $count = mysqli_num_rows($res);

            if($count==1) {
                // Obtener la informacion
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else {
                // Redirigir a la pagina de categorias y mostrar el mensaje de error
                $_SESSION['no-category-found'] = "<div class='error'>Categoria no encontrada.</div>";
                header('Location:'.SITEURL.'admin/manage-category.php');
            }


        } else {
            // Redirigir a la pagina de categorias
            header('Location:'.SITEURL.'admin/manage-category.php');
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
                            if($current_image != "") {
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
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>

                <tr>
                    <th>Active</th>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" >
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                // echo "Clicked";
                // Vamos a obtener los valores del formulario
                $title = $_POST['title'];
                $current_image = $_POST['image_name'];

            }
        ?>                            

    </div>
</div>

<?php include('./partials/footer.php'); ?>