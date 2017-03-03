<?php
require_once 'core/init.php';
if(Session::exists('home')){
	echo '<p>' .Session::flash('home'). '</p>';
}
$user = new User(); //current

if($user->isLoggedIn()){
	if($user->hasPermission('admin')){
		echo '<p>You are an administrator!</p>';
	}
	require_once 'menu.php';
?>

<?php
}else{
	Redirect::to('login.php');
}
?>

<!DOCTYPE html>
<head>
	<title>Ask-Me</title>
</head>
<body>
<div class="container" id="container" style="width: 900px;">

	<br />
	<div class="table-responsive">

	</div>




	<br />




	<h4 align="center">Recent Posts</h4>

	<div  class="table-responsive" id="question_table">

		<table class="table">
			<tr>
				<th width="100%"></th>
			</tr>


		</table>
	</div>
</div>
</body>
</html>

















<!-- Modal opened after clicking View button -->

<div id="dataModal" class="modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-body" id="post_detail" style="font-family: 'Times New Roman';" >


			</div>

		</div>
	</div>
</div>

<!-- Modal to be opened after clicking Answer button -->


<div id="answer_data_Modal" class="modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-body" id="answer_detail">

				<form method="post" id="answer_form">

					<label>Add Your Reply</label>
					<textarea name="post_reply"  id="post_reply" class="form-control" style="resize: none; height: 30%; font-weight: 700; font-family: 'Times New Roman'; font-size: medium;"></textarea>
					<br />
					<input type="submit" name="reply" id="reply" value="Add Reply" class="btn btn-success" />
					<span id="error_message_reply" class="text-danger" style="padding: 200px;" ></span>


				</form>



			</div>

		</div>
	</div>
</div>



<!--- Modal Opened after clicking Add Question button -->


<div id="add_data_Modal" class="modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-body">
				<form method="post" id="insert_form">

					<label>Enter your question</label>
					<textarea name="post"  id="post" class="form-control"  style="resize: none; height: 30%; font-weight: 800; font-family: 'Helvetica',sans-serif;"></textarea>
					<br />
					<input type="submit" name="insert" id="insert" value="Post Question" class="btn btn-success" />
					<span id="error_message" class="text-danger" ></span>



				</form>

			</div>

		</div>
	</div>
</div>

