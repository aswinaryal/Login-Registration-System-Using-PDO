<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login here</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/script.js"></script>

</head>


<body>


<div class="login_form"><!-- login form div -->

    <div class="container">



        <div class="brand"><a href="index.php">Ask-Me</a>
            <div class="brandDesc">
                <h4>The best platform to grab and share knowledge</h4>
            </div>
        </div>

        <form method="post" action="forgtopsw.php">


            <div class="form-input" style="margin-top: 30px;">
                <span><p>Send us your working email and we will send you a temporary password</p></span>
                <input type="email" name="email" placeholder="Enter a working email"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" maxlength="30"
                />

                <input type="submit" name="send" value="Send" class="btn-login" style="margin: 10px;" />

                <p id="feedbackRegister" style="font-size: 10px;">
                    <?php if(isset($error_register)) {
                        echo "    ".$error_register;
                    }
                    ?>
                </p>


            </div>



        </form>


    </div>

</div><!-- End of login Form -->


</body>




</html>

