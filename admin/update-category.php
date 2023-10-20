<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE CATEGORY</h1><br>

        <?php
        // Verificar el id a actualizar
        if(isset($_GET['id'])) {
            // Obtener el id 
            echo "Getting the dataaaaaaaaaaa";
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
                        <input type="text" name="title" value="">
                    </td>
                </tr>

                <tr>
                    <th>Current Image</th>
                    <td>
                        Imagen
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
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>

                <tr>
                    <th>Active</th>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('./partials/footer.php'); ?>