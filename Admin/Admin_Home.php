<?php include('Admin_Nav.php'); ?>
    
<div class="content">
<strong><h1 style ="font-size:40px;"><pre> <u>DASHBOARD</u></pre></h1></strong><br>
    
<?php 
        if(isset($_SESSION['login']))
        {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
        }
?>
<div class="box">
    <?php 
        //Sql Query 
        $sql = "SELECT * FROM category";
        //Execute Query
        $res = mysqli_query($conn, $sql);
        //Count Rows
        $count = mysqli_num_rows($res);
    ?>
        <h1><?php echo $count?></h1><br>
        Categories
    </div>
    <div class="box">
    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM food";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
        <h1><?php echo $count2?></h1><br>
        Food Items
    </div>
    <div class="box">
    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM tbl_order";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
        <h1><?php echo $count3?></h1><br>
        Total Orders
    </div>
    <div class="box">
    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>
        <h1><?php echo $total_revenue?></h1><br>
        Revenue Generated
    </div>
</div>
<?php include('Admin_Footer.php'); ?>