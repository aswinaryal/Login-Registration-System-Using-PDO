<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if(Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST,array(
           'current_password' => array(
               'required' => true,
               'min' => 5
           ),
            'new_password' => array(
                'required' => true,
                'min' => 5
            ),
            'new_password_again' => array(
                'required' => true,
                'min' => 5,
                'matches'=>'new_password'
            )
        ));

        if($validation->passed()){
            if(Hash::make(Input::get('current_password'),$user->data()->salt) !== $user->data()->password){
                echo 'You mistyped your current password';
            }else{
                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('new_password'),$salt),
                    'salt' => $salt
                ));

                Session::flash('home','Your password has been changed');
                Redirect::to('index.php');

            }
        }else{
            foreach ($validation->errors() as $error){
                echo $error, '<br />';
            }
        }


    }
}
?>
<form action="" method="post">

    <div class="field">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" id="password_current">
    </div>

    <div class="field">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="password_new">
    </div>

    <div class="field">
        <label for="password_new_again">New Password again</label>
        <input type="password" name="new_password_again" id="password_new_again">
    </div>

    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

</form>
