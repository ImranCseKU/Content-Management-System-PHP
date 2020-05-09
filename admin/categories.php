<?php include "function.php"; ?>
<?php include_once "../includes/db.php"; ?>
<?php include_once "includes/admin_header.php"; ?>


<body>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include_once "includes/admin_navigation.php"?>




        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Dashboard
                            <small>Mr Imran</small>
                        </h1>

                        <div class="col-sm-6 well"> 
                            
                            <?php insert_categories(); ?> 

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_name">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_name">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
                                </div>
                            </form>

                            <!-- Nicher code ti ekhane lekhan karon hosse jokhon amra edit button 
                            press korbo tokhon update FORM ti ADD Category FORM er niche show hobe -->
                            <?php
                                if(isset($_GET['edit'])){
                                    $updated_cat_id = $_GET['edit'];

                                    include_once "includes/update_categories.php";
                                }
                        
                            ?>    
                        </div>


                        <div class="col-sm-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <!-- <th>Delete</th> -->
                                        <!-- <th>Update</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php findAllCategories(); ?>
                             
                                </tbody>
                                
                                <?php deleteCategories(); ?>
                      
                            </table>
                        
                        </div>

       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
