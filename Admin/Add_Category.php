<?php 
    include('Admin_Nav.php'); 
?>

<div class="content">
    <strong><h1 style ="font-size:40px;text-align:center;">ADD CATEGORY</h1></strong>
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
                <td><input type="text" name="title" style="padding:1%;" placeholder="Category Title" style="magin:10px;" required></td>
            </tr>
            <tr>
                <td><strong>Select Image:  <span style="color:red;">*</span></strong></td>
                <td>
                    <input type="file" name="imgname" required>
                </td>
            </tr>
            <tr>
                <td><strong>Active:  <span style="color:red;">*</span></strong></td>
                <td>
                    <input type="radio" name="active" value="Yes" required>Yes
                    <input type="radio" name="active" value="No"  required>No
                </td>
            </tr>
            <tr>
                <td><strong>Featured:  <span style="color:red;">*</span></strong></td>
                <td>
                    <input type="radio" name="featured" value="Yes" required>Yes
                    <input type="radio" name="featured" value="No" required>No
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" name="submit" value="ADD" class="btn">    
        </form>
        
        <?php
        


        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];

            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "NO";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "NO";
            }
            

            //check if img is selected or not and value set
            if(isset($_FILES['imgname']['name']))
            {
                
                $imgname = $_FILES['imgname']['name'];
                $source_path = $_FILES['imgname']['tmp_name'];
                
                $destination_path = "../images/category/".$imgname;

                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload==false)
                {
                    $_SESSION['upload']="<div>Failed to upload image</div>";
                    header('location:'.SITEURL.'Admin/Add_Category.php');
                    die();
                }
            }
            else
            {
                $imgname = "";
            }

            $sql = "INSERT INTO category SET
                    title = '$title',
                    imgname = '$imgname',
                    featured = '$featured',
                    active = '$active'
            ";

            $res = mysqli_query($conn,$sql);

            if($res==true)
            {
                $_SESSION['add'] = "<div>Category added successfully</div>";
                header('location:'.SITEURL.'Admin/Admin_Categories.php');
            }
            else
            {
                $_SESSION['add'] = "<div>Failed to add category</div>";
                header('location:'.SITEURL.'Admin/Admin_Categories.php');
            }
        }
        
        ?>

    </div>
</div>
<?php include('Admin_Footer.php'); ?>