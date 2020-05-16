<?php include_once "includes/db.php"; ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="font-weight:bold;">Master CMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse justify-content-between" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" id= 'navigation-item'>
                
                <?php
                    //SQL query to fetch all catagories and show into NAVBAR...
                    $query = "SELECT * FROM `categories`";
                    $result = mysqli_query($connection, $query) or die( mysqli_error($connection));
                

                    while( $row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a class='text-white text-uppercase font-weight-bold px-3' href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                
                ?>
                <li>
                    <a href="admin/" class='text-white text-uppercase font-weight-bold px-3'>Account</a>
                </li>

                
                
                <!-- <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>