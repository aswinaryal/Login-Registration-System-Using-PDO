<?php
function escape($string){
	return htmlentities($string,ENT_QUOTES,'UTF-8'); // to make much more secure html entities with ent quotes representing single and double quotes and also with character encoding //
}


?>