<?php include('Admin_Nav.php'); ?>

<div class="content">
            <strong><h1 style ="color:#354f52;font-size:40px;">UPDATE FOOD</h1></strong>
            <br>

    <?php 
    //CHeck whether id is set or not 
    if(isset($_GET['foodID']))
    {
        //Get all the details
        $foodID = $_GET['foodID'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM food WHERE foodID=$foodID";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $title = $row2['title'];
        $price = $row2['price'];
        $current_category = $row2['catgID'];
        $current_image = $row2['imgname'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:'.SITEURL.'Admin/Admin_Food.php');
    }
?>
    <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input  required type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input  required type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<div>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php 
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether category available or not
                            if($count>0)
                            {
                                //CAtegory Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $title = $row['title'];
                                    $catgID = $row['catgID'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$catgID){echo "selected";} ?> value="<?php echo $catgID; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //CAtegory Not Available
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes" required> Yes 
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No" required> No 
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes" required> Yes 
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No" required> No 
                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="submit" name="submit" value="Update" class="btn" style="padding:0.7%;">
                </td>
            </tr>

        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $title = $_POST['title'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        
                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/food/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //FAiled to Upload
                            $_SESSION['upload'] = "<div>Failed to Upload new Image.</div>";
                            //REdirect to Manage Food 
                            header('location:'.SITEURL.'Admin/Admin_Food.php');
                            //Stop the Process
                            die();
                        }
                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //REmove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<div>Failed to remove current image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'Admin/Admin_Food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $imgname = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $imgname = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the Food in Database
                $sql3 = "UPDATE food SET 
                    title = '$title',
                    price = $price,
                    imgname = '$current_image',
                    catgID = '$catgID',
                    featured = '$featured',
                    active = '$active'
                    WHERE foodID=$foodID
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Food.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Food.php');
                }

                
            }
        
        ?>

    
</div>

<?php include('Admin_Footer.php') ?>