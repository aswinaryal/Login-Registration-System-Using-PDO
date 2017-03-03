<?php
require_once 'core/init.php';



if(Input::exists()){
    if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST,array(
                'firstname' => array(
                'required' => true,
                'min' =>3,
                'max' =>20
                ),
                'lastname' => array(
                'required' => true,
                'min' =>3,
                'max' =>20,
                'notmatches' =>'firstname'
                ),
                'username' => array(
                'required' => true,
                'min' =>4,
                'max' =>20,
                'unique' =>'users',
                'reg_match' => true
                ),
                'email' => array(
                'required' => true,
                'max' =>35,
                'unique' =>'users',
                'email_reg_match' => true
               
                ),
                'password' => array(
                'required' => true,
                'min' =>5,
                'varyPass'=>'username'
                ),
                'Confirm_Password' =>array(
                'required' => true,
                'matches' => 'password'
                )
                ));

                    if($validation -> passed()){
                        $user = new User();
                        $salt = Hash::salt(32);


                        try {
                            
                            $user->create(array(
                                'firstname' => Input::get('firstname'),
                                'lastname' => Input::get('lastname'),
                                'username' => Input::get('username'),
                                'email' => Input::get('email'),
                                'password' => Hash::make(Input::get('password'),$salt),
                                'salt' =>$salt,
                                'joined' =>date('Y-m-d H:i:s'),
                                'role' =>1

                                ));
                            Session::flash('home','You have been registered successfully, You can LogIn now');
                        Redirect::to('index.php');

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        
                    }else{
                        
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

<div class="register_form">  <!-- Register form div -->
    <div class="container_register">
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
                echo $error.', ';
            }?>
        </div><?php
        }?>


            <div class="form-input">
                <input type="text" name="firstname" placeholder="Enter Your First Name"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                       value="<?php echo escape(Input::get('firstname'));?>" id="firstname"
                />
                <input type="text" name="lastname" placeholder="Enter your last Name"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                       value="<?php echo escape(Input::get('lastname'));?>" id="lastname"
                />
            </div>

            <div class="form-input">
                <input type="text" name="username" placeholder="Choose a Username"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                      value="<?php echo escape(Input::get('username'));?>" id="username"
                />
                <input type="email" name="email" placeholder="Enter a working email"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                       value="<?php echo escape(Input::get('email'));?>" id="email"
                />
            </div>

            <div class="form-input">
                <input type="password" name="password" placeholder="Enter a password"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" 
                       value="<?php echo escape(Input::get('password'));?>" id=";password"
                />
                <input type="password" name="Confirm_Password" placeholder="Confirm Password"
                       onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" 
                      
                />
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

            <input type="submit" name="register" value="Register" class="btn-login"  />

        </form><br />
        <div id="accountExists">
            Already have an account? <a href="login.php">Sign In</a>
        </div>


    </div>

</div><!-- End of Register form div -->



</body>




</html>
