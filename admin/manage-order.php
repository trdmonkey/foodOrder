<?php include('partials/menu.php'); ?>

<!--  
    * ORDER 
-->
<div class="main-content">
    <div class="wrapper">
        <h1>ORDER</h1>

        <br>
        <!--  
            * BOTON AGREGAR ADMIN
        -->
        <a href="#" class="btn-primary">Add Order</a>
        
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            
            // Obtener todas las ordenes de la base de datos
            $sql = "SELECT * FROM tbl_order";

            // Ejecutar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar los registros
            $count = mysqli_num_rows($res);

            // Verificar si hay registros
            if($count>0) {

                // Si hay ordenes
                while($row=mysqli_fetch_assoc($res)) {

                    /*  
                        * Obtener todos los detalles de las ordenes
                    */
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                }

            } else {

                // No hay ordenes
                echo "<tr><td colspan='12' class='error'>Ordenes no disponibles.</td></tr>";

            }

            ?>
            <tr>
                <td>1.</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn-secondary">Update Order</a>
                </td>
            </tr>            
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>