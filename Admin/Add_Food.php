<?php 
    include('Admin_Nav.php'); 
?>

<div class="content">
    <strong><h1 style ="font-size:40px;text-align:center;">ADD FOOD</h1></strong>
    <br>
    <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <div style="padding:2%;">

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
                <tr>
                    <td><strong>Title:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <input type="text" name="title" style="padding:1%;magin:10px;"  required placeholder=" Food title">
                    </td>
                </tr>

                <tr>
                    <td><strong>Price:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td><strong>Select Image:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <input type="file" name="imgname" required>
                    </td>
                </tr>

                <tr>
                    <td><strong>Category:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <select name="category">

                            <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM category WHERE active='Yes'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $catgID = $row['catgID'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $catgID; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td><strong>Active:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <input type="radio" name="active" value="Yes" required> Yes 
                        <input type="radio" name="active" value="No" required> No
                    </td>
                </tr>
                <tr>
                    <td><strong>Featured:  <span style="color:red;">*</span></strong></td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required> Yes 
                        <input type="radio" name="featured" value="No" required> No
                    </td>
                </tr>
            </table>
            <br>
            <input type="submit" name="submit" value="Add" class="btn">
        </form>

        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $price = $_POST['price'];
                //$catgID = $_POST['catgID'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //SEtting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['imgname']['name']))
                {
                    //Get the details of the selected image
                    $imgname = $_FILES['imgname']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($imgname!="")
                    {
                        
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['imgname']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$imgname;

                        //Finally Uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'Admin/Add_Food.php');
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $imgname = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO food SET 
                    title = '$title',
                    price = $price,
                    imgname = '$imgname',
                    catgID = '$catgID',
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Food.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'Admin/Admin_Food.php');
                }

                
            }

        ?>

    
    </div>

</div>
<?php include('Admin_Footer.php'); ?>
