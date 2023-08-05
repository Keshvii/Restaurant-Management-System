<?php
include("config/constants.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Interface</title>
<link rel= "stylesheet" href="Admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.content-orders{
    grid-row: 2/2;
    padding: 0;
    margin: 5px;
    color: #3C403D;

}

.tbl-full-orders{
    width: 100%;
    font-size : 15px;
    margin-bottom : 4%;
}

table tr th{
    text-align : left;
    padding-left : 0;
    margin-left : 0;
}
table tr td{
    text-align : left;
    padding-left : 0;
    margin-left : 0;
}

</style>
</head>
<body>
    <div class="container">   
        <div class="navbar bordr">
            <ul>
                <li><a href="Admin_Home.php">Home</a></li>
                <li><a href="Admin_Categories.php">Categories</a></li>
                <li><a href="Admin_Food.php">Food</a></li>
                <li><a href="Admin_Orders">Order</a></li>
                <li><a href="../Customer/admin-login.php">Logout</a></li>
            </ul>
        </div>
        <div class="content-orders">
        <strong><h1 style ="color:#3C403D;font-size:40px;margin-top:3.5%">MANAGE: <u>ORDERS</u></h1></strong>
            <br>
            <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <center>
                <table class="tbl-full-orders">
                    <tr>
                        <th>SNo</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr> 
                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_order ORDER BY orderID DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $orderID = $row['orderID'];
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
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>Admin/Update_Order.php?orderID=<?php echo $orderID; ?>" class="btn-secondary">Update</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12'>Orders not Available</td></tr>";
                        }
                    ?>

 
                </table></center>

        </div>
<?php include('Admin_Footer.php'); ?>

 
