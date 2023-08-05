<?php 
    //Include COnstants Page
    include('config/constants.php');

    //echo "Delete Food Page";

    if(isset($_GET['foodID']) && isset($_GET['imgname'])) //Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $foodID = $_GET['foodID'];
        $imgname = $_GET['imgname'];

        //2. Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($imgname != "")
        {
            // IT has image and need to remove from folder
            //Get the Image Path
            $path = "../images/food/".$imgname;

            //REmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div>Failed to Remove Image File.</div>";
                //REdirect to Manage Food
                header('location:'.SITEURL.'Admin/Admin_Food.php');
                //Stop the Process of Deleting Food
                die();
            }

        }

        //3. Delete Food from Database
        $sql = "DELETE FROM food WHERE foodID=$foodID";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage Food with Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div>Food Deleted Successfully.</div>";\
            header('location:'.SITEURL.'Admin/Admin_Food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div>Failed to Delete Food.</div>";\
            header('location:'.SITEURL.'Admin/Admin_Food.php');
        }

        

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div>Unauthorized Access.</div>";
        header('location:'.SITEURL.'Admin/Admin_Food.php');
    }

?>  
