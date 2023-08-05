<?php include("config/constants.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order form</title>
    <link rel="stylesheet" href="order-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body >
    <div class="container">


        <!--Header starts herer.....-->
        <div class="logo"> <img src="logo.jpg" width="120px" height="60px"></div>
        <div class="nav_bar">
            <ul class="navBar ">
                <li><a href="home.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="foods.php">Foods</a></li>
                <li><a href="contact-form.php">Contact Us</a></li>
                <li><a href="admin-login.php">Admin</a></li>
            </ul>
        </div>
        <!--Header endss herer.....-->
        <?php 
        //CHeck whether food id is set or not
        if(isset($_GET['foodID']))
        {
            //Get the Food id and details of the selected food
            $foodID = $_GET['foodID'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM food WHERE foodID=$foodID";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $imgname = $row['imgname'];
            }
            else
            {
                //Food not Availabe
                //REdirect to Home Page
                header('location:'.SITEURL.'Customer/home.php');
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL.'Customer/home.php');
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
        <div class="order-form">
            
            <h2 style="text-align: center;">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($imgname=="")
                            {
                                //Image not Availabe
                                echo "<div>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imgname; ?>" alt="Mexican Pizza" height="140px" width="100px" class=" img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="title" value="<?php echo $title; ?>">

                        <p class="food-price">Rs <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name <span style="color:red;">*</span></div>
                    <input type="text" name="full-name" placeholder="E.g. abc" class="input-responsive" required>

                    <div class="order-label">Phone Number <span style="color:red;">*</span></div>
                    <input type="tel" name="contact" placeholder="E.g. 984xx xxxxx" class="input-responsive" required>
                
                    <div class="order-label">Email <span style="color:red;">*</span></div>
                    <input type="email" name="email" placeholder="E.g. abc@xyz.com" class="input-responsive" required>

                    <div class="order-label">Address <span style="color:red;">*</span></div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <center><input type="submit" name="submit" value="Confirm Order" class="btn_primary btn  btn-radius"></center>
                </fieldset>

            </form>

            <?php 
                
                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                    
                    $food = $_POST['title'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:s"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";


                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);


                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        echo "true";
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div><p style='text-align:center; color:green;'>Food Ordered Successfully<br>Our delivery partner will soon contact you and Your food will be delivered under 40 mins</p></div>";
                        header('location:'.SITEURL.'Customer/home.php');
                    }
                    else
                    {
                        echo "false";
                        //Failed to Save Order
                        $_SESSION['order'] = "<div style='text-align:center; color:red;'>Failed to Order Food.</div>";
                        header('location:'.SITEURL.'Customer/home.php');
                    }

                }
            
            ?>

        </div>


        <!--order form ends herer.....-->




        <?php include('cust-partials/footer.php'); ?>
    </div>
</body>
</html> 
