<div class="col-md-4">
                

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="./search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div><!-- /.input-group -->
                    
                    
                    </form> <!-- end of form -->
                </div>

                <!-- login form -->
                <div class="well">
                    <div style="clear: both">
                        <h4 style="float: left">Login</h4>
                        <a href="registration.php" style="float: right;margin-top: 8px; font-weight:bold; font-size:16px">Register</a>
                    </div>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Enter username" >
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="login">
                                Login
                                </button>
                            </span>
                        </div><!-- /.input-group -->
                    
                    </form> <!-- end of form -->
                </div>




                <!-- Blog Categories Well -->
                <?php
                    //SQL query to fetch all catagories and show into Sidebar...
                    $query = "SELECT * FROM `categories`";  // We can LIMIT categories
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die("Query failed!!");
                    }

                
                ?>

                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            
                            <?php
                                while( $row = mysqli_fetch_assoc($result)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
            
                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                }
                        
                            ?>

                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>