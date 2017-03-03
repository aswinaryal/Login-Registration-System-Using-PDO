<?php
require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' =>true)
            ));

        $errors = '';

        if($validation->passed()){

            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'),$remember);

            if($login){
                Redirect::to('index.php');
            }else{
                $errors = 'Invalid Credentials';
            }

        } else {
            foreach ($validation->errors() as $error) {
                $error;
            }
        }

    }
}
?>

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

            <form method="post" action="">
                 <?php 
        if(isset($error)) {?>
        <div class="alert alert-warning"><?php
            foreach ($validation->errors() as $error) {
                echo $error.'<br /> ';
            }
            ?>

        </div><?php
        }?>

        <?php
        if(isset($errors)) {?>
           <div class="alert alert-warning"><?php
                  echo $errors.'<br /> ';
              ?>
            </div><?php
            }?>


                <div class="form-input">
                    <input type="text" name="username" placeholder="Enter Username"
                           onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" maxlength="15"
                    value="<?php if(isset($username)) echo $username;  ?>"
                    />



                </div>

                <div class="form-input">
                    <input type="password" name="password" placeholder="Enter Password"
                           onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" maxlength="10"
                    value="<?php if(isset($pass)) echo $pass;  ?>"
                    />
                </div>

                
                    <label for "remember" class="remember">
                        <input type="checkbox" name="remember" id="remember">Remember Me
                    </label>
                <div id="forgotpassword">
                    <a href="forgtopsw.php">Forgot Password?</a>
                </div>
                
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <input type="submit" name="login" value="Login" class="btn-login" />

            </form><br />
            <div id="accountExists">
                Don't have an account yet? <a href="register.php">Sign Up</a>
            </div>

        </div>
    </div><!-- End of login Form -->
</body>

</html>
