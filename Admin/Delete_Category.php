<?php 
    include('config/constants.php');
    if(isset($_GET['catgID']) AND isset($_GET['imgname']))
    {
        $catgID = $_GET['catgID'];
        $imgname = $_GET['imgname'];
        if($imgname != "")
        {
            $path = "../images/category/".$imgname;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div>Failed to remove category image</div>";
                header('location:'.SITEURL.'Admin/Admin_Categories.php');
                die();
            }
        }

        $sql = "DELETE FROM category WHERE catgID=$catgID";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'Admin/Admin_Categories.php');
        }
        else
        {
            $_SESSION['delete'] = "<div>Failed to Delete Category.</div>";
            header('location:'.SITEURL.'Admin/Admin_Categories.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'Admin/Admin_Categories.php');
    }
?>
