<?php
include ('head.php');
include ('nav.php');
include ('content-wrapper-begin.php');

require 'vendor/autoload.php';

// And you're ready to go!
$response = \Httpful\Request::delete('http://127.0.0.1:3000/ruleset/'.$_REQUEST['ruleset_id'])->send();
?><table><tr><?php
		if ($response->code != '200'){
		?><td class="alert-warning"><?php
		echo "$response->code - error deleting ruleset - ".print_r($response,true);
		?></td><?php
		}else{
		?><td class="alert-success"><?php
		echo "$response->code - ruleset deleted";
		?></td><?php
		}
?>	<tr><td><a href="http:ruleset_list.php" class="btn btn-primary">ok</a></td>
		
</tr></table><?php
include ('content-wrapper-end.php');
include ('foot.php');
?>
