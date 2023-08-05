<?php 
    include('Admin_Nav.php'); 
?>
<div class="content">
    <strong><h1 style ="color:#3C403D;font-size:40px;">MANAGE: <u>CATEGORIES</u></h1></strong>
    <br>
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
             echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br>
            
        <a href="Add_Category.php" class="btn" >Add Category</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Active</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM category;";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                $sn=1;

                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $catgID = $row['catgID'];
                        $title = $row['title'];
                        $imgname = $row['imgname'];
                        $active = $row['active'];
                        $featured = $row['featured'];
                            
            ?>
                        <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $title ?></td>
                        <td>
                            <?php
                                if($imgname!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo $imgname; ?>" width="90px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div>Image not added</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $active?></td>
                        <td><?php echo $featured ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>Admin/Update_Category.php?catgID=<?php echo $catgID; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL;?>Admin/Delete_Category.php?catgID=<?php echo $catgID; ?>&imgname=<?php echo $imgname; ?>" class="btn-primary">Delete</a>
                        </td>
                        <?php
                    }
                }
                
                else
                {
                    ?>
                    <tr colspan="6"><td><div>No category added</div></td></tr>
                    <?php
                }
                mysqli_close($conn);
            ?>
        </table>
</div>
<?php include('Admin_Footer.php'); ?>