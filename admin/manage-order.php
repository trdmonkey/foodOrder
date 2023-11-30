<?php include('partials/menu.php'); ?>

<!--  
    * ORDER 
-->
<div class="main-content">
    <div class="wrapper">

        <?php
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <h1>MANAGE ORDER</h1>

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
            /* $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; */

            // Ejecutar la consulta
            $res = mysqli_query($conn, $sql);

            // Contar los registros
            $count = mysqli_num_rows($res);

            $sn = 1; // Este solo es un contador para la tabla en la primera columna. 
            $grand_total = 0;
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
                    $grand_total += $total;

                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                            <?php
                            // Colores por estatus: Pedido: normal, Despachado: orange, Entregado: gree, Cancelado: blue
                            if($status=="Pedido") {
                                echo "<label style='color: blue;'><b>$status</b></label>";
                            } elseif($status=="Despachado") {
                                echo "<label style='color: orange;'><b>$status</b></label>";
                            } elseif($status=="Entregado") {
                                echo "<label style='color: green;'><b>$status</b></label>";
                            } elseif($status=="Cancelado") {
                                echo "<label><b>$status</b></label>";
                            }
                            ?>
                        </td>

                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                        
                    </tr>
                    <?php
                }

            } else {

                // No hay ordenes
                echo "<tr><td colspan='12' class='error'>Ordenes no disponibles.</td></tr>";

            }
            echo "<tr><th colspan='3'></th><th><strong>Grand Total:</strong></th><th><b>$$grand_total</b></th><th colspan='7'></th></tr>";
            ?>
                        
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>