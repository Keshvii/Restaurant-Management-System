<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="admin-login.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Header starts here-->
    <div class="header">
        <div class="logo"> <img src="logo.jpg" width="200px" height="60px" >
            <a href="home.php"><i class="fa fa-home" id="home">    Home</i></a>
        </div>
    </div>
    <!-- Header ends here-->

 

    <!-- Login form starts here-->
           
    <div class="login-form">
        <br><br><br><br><br>
        <form action=""  method="POST">               
            <br>
            <h2>Login</h2>
            <h3> Please login to access Admin panel</h3><br>

            <?php
 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo "jzsbchscvjshc";
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <fieldset>
                <div class="label">Username <span style="color:red;">*</span></div>
                <input type="text" name="username" placeholder="Enter Username..." class="input-responsive" required>

                <div class="label">Password <span style="color:red;">*</span></div>
                <input type="password" name="password" placeholder="Enter password..." class="input-responsive" required>
                    <br><br>
                    
                <center><input type="submit" name="submit" value="Login" class="btn btn_primary btn-radius "> </center>
                <br>
            </fieldset>
        
        </form>
        <br><br><br><br>
    </div>
    <!-- Login form ends here-->

  

</body>
</html>




<?php include("config/constants.php");

        // Check whether submit button is clicked or not

        if(isset($_POST['submit']))
        {
                // process for login
            //    1. Get data from login form
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            //    2. Check credentials exist or not
            $sql = "select * from admin where username = '$username' AND password = '$password'";

            //  3. execute query
            $result = $conn -> query($sql);
            //$result = mysqli_query($conn,$sql);

            //  4. count rows to check user exist or not
            $count = mysqli_num_rows( $result );

            if($count==1)
            {
                
                //user available and login success
                $_SESSION['login'] = " <div style='color:green;' > Login Successful </div>";
                $_SESSION['user'] = $username;             // to check whether use is logged in or not and logout will unset it

                // redirect to dashboard
                header('location:'.SITEURL.'Admin/Admin_Home.php');   

            }
            else 
            {
                
                //  user unavailable and login unsuccessful
                 $_SESSION['login'] = " <div style='color:red; text-align:center;' > Username or Password did not match. </div>";
                 echo "<script> alert('Username or Password did not match.') </script>";
                // redirect to home page
                //header('location: admin-login.php');
            }
        }



?>

