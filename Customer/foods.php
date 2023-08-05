
        <?php include('cust-partials/header.php');?>
        <?php include('cust-partials/search-bar.php');?>
        <?php include("config/constants.php");?>


        
         <!--Food section starts herer.....-->
        <div class="food">
            <h2 style="text-align: center; padding-top: 30px;"> Food Menu </h2>
            <?php 
             
            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM food WHERE active='Yes'";

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
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $imgname; ?>" alt="Mexican Pizza" height="200px" width="180px" class="img-responsive img-curve">
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

        
        </div>
        <!--Food section endss herer.....-->


        <?php include('cust-partials/quick-links.php');?>
        <?php include('cust-partials/footer.php');?>

       
    </div>
</body>
</html>