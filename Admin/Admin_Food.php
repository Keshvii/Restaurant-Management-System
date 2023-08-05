<?php 
    include('Admin_Nav.php'); 
?>
<div class="content">
    <strong><h1 style ="color:#3C403D;font-size:40px;">MANAGE: <u>FOOD</u></h1></strong>
    <br>
    <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        
        ?>
        
        <br>
        <a href="Add_Food.php" class="btn" >Add Food</a>
        <br>
        <br>

        <table class="tbl-full">
        <tr>
            <th width="15%">S.No</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th >Active</th>
            <th >Featured</th>
            <th>Actions</th>
        </tr>

        <?php 
                        //Create a SQL Query to Get all the Food
            $sql = "SELECT * FROM food";

                        //Execute the qUery
            $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $foodID = $row['foodID'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $imgname = $row['imgname'];
                                $active = $row['active'];
                                $featured = $row['featured'];
                                
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($imgname=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imgname; ?>" width="90px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL; ?>Admin/Update_Food.php?foodID=<?php echo $foodID; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>Admin/Delete_Food.php?foodID=<?php echo $foodID; ?>&imgname=<?php echo $imgname; ?>" class="btn-primary">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' > Food not Added Yet. </td> </tr>";
                        }

                    ?>

                    
                </table>

            
        </div>
<?php include('Admin_Footer.php'); ?>

