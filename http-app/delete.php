<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/rule/'.$_REQUEST['id'])->send();

		if ($response->code != '200'){
		?><td class="alert-warning"><?php
		echo "$response->code - error finding rule - ".print_r($response,true);
		?></td><?php
		}else{
		
$rule = $response->body;
?>
<p>Are you sure you want to permenantly remove rule <?php echo $_REQUEST['id']?>?</p>
<a href="http:remove.php?id=<?php echo $_REQUEST['id']?>" class="btn btn-danger glyphicon glyphicon-remove">&nbsp;remove</a>
<?php
		}
		

include ('content-wrapper-end.php');
include ('foot.php');
?>
