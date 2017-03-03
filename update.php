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
            )

        ));

        if($validation ->passed()){
            try{
                $user ->update(array(
                    'firstname' => Input::get('firstname'),
                    'lastname' =>Input::get('lastname')

                ));
                Session::flash('home','Your details have been updated');
                Redirect::to('index.php');
            }catch (Exception $e){
                die($e->getMessage());
            }
        }else{
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
            }
        }

    }
}
?>
<form action="" method="post">
    <div class="field">
        <label for="firstname">First-Name</label>
        <input type="text" name="firstname" value="<?php echo escape($user->data()->firstname); ?>" /><br />

        <label for="lastname">Last-Name</label>
        <input type="text" name="lastname" value="<?php echo escape($user->data()->lastname); ?>" /><br />

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </div>

</form>

