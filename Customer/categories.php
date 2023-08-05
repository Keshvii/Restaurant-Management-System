<?php include('cust-partials/header.php');?>
<?php include('cust-partials/search-bar.php');?>
<?php include("config/constants.php");?>

<div class="categories">
            <h2 style="text-align: center; padding: 20px;"> Explore Foods </h2>
            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM category WHERE active='Yes'";
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
                        
                        <a href="foods.php">
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
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $imgname; ?>" alt="Pizza" height="300px" width="200px" class="img-curve">
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
            
            
        </div>
        <!--Categories endss herer.....-->



        <?php include('cust-partials/quick-links.php');?>
        <?php include('cust-partials/footer.php');?>

        
    </div>
</body>
</html>