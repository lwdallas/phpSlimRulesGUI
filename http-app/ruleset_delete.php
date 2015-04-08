<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::get('http://127.0.0.1:3000/ruleset/'.$_REQUEST['ruleset_id'])->send();

		if ($response->code != '200'){
		?><td class="alert-warning"><?php
		echo "$response->code - error finding ruleset - ".print_r($response,true);
		?></td><?php
		}else{
		
$ruleset = $response->body;
?>
<p>Are you sure you want to permenantly remove ruleset <?php echo $_REQUEST['ruleset_id']?>?</p>
<a href="http:ruleset_remove.php?ruleset_id=<?php echo $_REQUEST['ruleset_id']?>" class="btn btn-danger glyphicon glyphicon-remove">&nbsp;remove</a>
<?php
		}
		

include ('content-wrapper-end.php');
include ('foot.php');
?>
