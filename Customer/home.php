
<?php 
    include('cust-partials/header.php');
    include('cust-partials/search-bar.php');
    include("config/constants.php");
?>
        
        
          <!--Categories section starts herer.....-->
        <div class="categories">
        <div>
        <br>
        <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
        </div>
            <h2 style="text-align: center; padding: 20px;"> Categories </h2>
            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 4";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values like id, title, image_name
                        $catgID = $row['catgID'];
                        $title = $row['title'];
                        $imgname = $row['imgname'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>Customer/categories.php?catgID=<?php echo $catgID; ?>">
                            <div class="box float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($imgname=="")
                                    {
                                        //Display MEssage
                                        echo "<div>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $imgname; ?>" alt="Pizza" height="300px" width="220px" class="img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div>Category not Added.</div>";
                }
            ?>
            <div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <center><a href="categories.php" class="btn_primary btn  btn-radius" > View All</a></center>
        </div></div>
        <!--Categories endss herer.....-->



         <!--Food section starts herer.....-->
        <div class="food">
            <h2 style="text-align: center; padding-top: 30px;"> Choose & Enjoy </h2>
            <?php 
             
            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 8";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if($count2>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $foodID = $row['foodID'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $imgname = $row['imgname'];
                    ?>

                    <div class="food-box">
                        <div class="food-img img-curve">
                            <?php 
                                //Check whether image available or not
                                if($imgname=="")
                                {
                                    //Image not Available
                                    echo "<div>Image not available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $imgname; ?>" alt="Mexican Pizza" height="210px" width="180px" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-descp">
                        <center><h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs <?php echo $price; ?></p>
                            <p class="food-detail">
                    
                            </p>
                            

                            <a href="<?php echo SITEURL; ?>Customer/order-form.php?foodID=<?php echo $foodID; ?>" class="btn btn_primary">Order Now</a></center>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Food Not Available 
                echo "<div>Food not available.</div>";
            }
            
            ?>

<div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>  
        <center><a href="foods.php" class="btn_primary btn  btn-radius" > View All</a></center><br>
        </div></div>
        <!--Food section endss herer.....-->


        <?php include('cust-partials/quick-links.php');?>
        <?php include('cust-partials/footer.php');?>

    </div>
</body>
</html>