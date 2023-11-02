<?php include('partials/menu.php'); ?>

<!--  
    * FOOD 
-->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>

        <br>
        <!--  
            * BOTON AGREGAR ADMIN
        -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>Jorge Luis</td>
                <td>trdmonkey</td>
                <td>
                    <a href="#" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn-terciary">Delete</a>
                </td>
            </tr>

            <tr>
                <td>1.</td>
                <td>Jorge Luis</td>
                <td>trdmonkey</td>
                <td>
                    <a href="#" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn-terciary">Delete</a>
                </td>
            </tr>

            <tr>
                <td>1.</td>
                <td>Jorge Luis</td>
                <td>trdmonkey</td>
                <td>
                    <a href="#" class="btn-secondary">Update</a>&nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn-terciary">Delete</a>
                </td>
            </tr>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>