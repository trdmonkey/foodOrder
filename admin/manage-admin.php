<?php include('partials/menu.php'); ?>

<!--  
    * MAIN SECTION
-->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br>

        <p>
            <?php
                $messages = array(
                    'add' => 'add',
                    'delete' => 'delete',
                    'update' => 'update',
                    'user-not-found' => 'user-not-found',
                    'pwd-not-match' => 'pwd-not-match',
                    'change-pwd' => 'change-pwd'
                );
                
                foreach ($messages as $key => $value) {
                    if (isset($_SESSION[$key])) {
                        echo $_SESSION[$key];
                        unset($_SESSION[$key]);
                    }
                }
                
                // METODO CLASICO:
                /* if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if (isset($_SESSION['pwd-not-match'])) {
                    echo ($_SESSION['pwd-not-match']);
                    unset($_SESSION['pwd-not-match']);
                } 
                if (isset($_SESSION['change-pwd'])) {
                    echo ($_SESSION['change-pwd']);
                    unset($_SESSION['change-pwd']);
                } */

            ?>
        </p>
        
        <br>
        <!--  
            * BOTON AGREGAR ADMIN
        -->
        <a href="./add-admin.php" class="btn-primary">Add Admin</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Consulta para obtener la info de la tabla Admin
                $sql = "SELECT * FROM tbl_admin";

                // Ahora vamos a ejecutar la consulta sql
                $res = mysqli_query($conn, $sql);

                // Ahora verificamos si la consulta se ejecuto o no
                if($res==TRUE) {

                    if ($res === FALSE) {
                        // Manejar el error de ejecución de la consulta
                        die(mysqli_error($conn)); // Esto imprimirá el mensaje de error en pantalla
                    }
                    // Contamos las filas para verificar si hay info en la BD o no
                    $count = mysqli_num_rows($res); // Esta funcion obtiene todas las filas de una tabla

                    $sn = 1; // Creamos una variable y la inicializamos con el valor numero 1

                    // Ahora verificarmos el numero de filas
                    if($count>0) {
                        
                        // Hay info en la DB
                        while($rows=mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td> <!-- Hacemos un contador para el S.N. -->
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a>&nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-terciary">Delete</a>
                                </td>
                            </tr>

                            <?php

                        }

                    } else {
                        
                        // No hay info


                    } 
                }
            ?>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>