<?php include('Admin_Nav.php'); ?>

<div class="main-content">
     <div class="content">
            <strong><h1 style ="color:#354f52;font-size:40px;">UPDATE CATEGORIES</h1></strong>
            <br>

        <?php 
        
            //Check whether the catgID is set or not
            if(isset($_GET['catgID']))
            {
                //Get the CATGID and all other details
                //echo "Getting the Data";
                $catgID = $_GET['catgID'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM category WHERE catgID=$catgID";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the catgID is valcatgID or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['imgname'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Categories.php');
                }

            }
            else
            {
                //redirect to Manage CAtegory
                header('location:'.SITEURL.'Admin/Admin_Categories.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured:  </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" required> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" required> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" > Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" > No 
                    </td>
                </tr>
                    <td>
                        <input type="submit" name="submit" value="Update" class="btn" style="padding:0.7%;">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form

                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $imgname = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($imgname != "")
                    {
                        //Image Available

                        //A. UPload the New Image

                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$imgname;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'Admin/Admin_Categories.php');
                            //STop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'Admin/Admin_Categories.php');
                                die();//Stop the Process
                            }
                        }
                        

                    }
                    else
                    {
                        $imgname = $current_image;
                    }
                }
                else
                {
                    $imgname = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE category SET 
                    title = '$title',
                    imgname = '$imgname',
                    featured = '$featured',
                    active = '$active' 
                    WHERE catgID=$catgID
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage Category with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Categories.php');
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Categories.php');
                }

            }
        
        ?>

    </div>
</div>


<?php include('Admin_Footer.php') ?>