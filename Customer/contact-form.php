<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="admin-login.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    textarea{
        overflow-y:scroll;
        height: 80px;
    }
</style>


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
        <form action="https://formspree.io/f/xzbwwlov" method="POST"> 
            <br>
            <h2>Contact Us</h2>
            <h3> Please fill this form</h3>             
            <fieldset>
                <div class="label">Full Name <span style="color:red;">*</span></div>
                <input type="text" name="name" placeholder="Your name..." class="input-responsive" required>

                <div class="label">Email <span style="color:red;">*</span></div>
                <input type="email" name="email" placeholder="Your Email..." class="input-responsive" required>

                <div class="label">Message <span style="color:red;">*</span></div>
                <textarea name="message" placeholder="Write Message..." cols="55" rows="10" class="input-responsive"></textarea>
                    <br><br>
                    
                <center><input type="submit" name="submit" value="SEND" class=" btn_primary btn btn-radius " style="padding:5px;"> </center>
                <br>
            </fieldset>
        
        </form>
        <br><br><br><br>
    </div>
    <!-- Login form ends here-->
           
  

</body>
</html>

