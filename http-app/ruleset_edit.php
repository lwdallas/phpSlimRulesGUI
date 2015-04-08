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
<form name="frm" action="http:ruleset_update.php">
<table>
<tr>
	<td>ID</td>
	<td>
			<?php echo $ruleset->ruleset_id;?>
			<input type="hidden" name="ruleset_id" value="<?php echo $ruleset->ruleset_id;?>">
	</td>
</tr>
<tr>
	<td>Rule Set</td>
	<td>
			<input name="ruleset" type="text" value="<?php
				echo $ruleset->ruleset;?>" >
	</td>
</tr>
<tr>
	<td>Active</td>
	<td>
			<input name="ruleset_active" type="text" value="<?php
				echo $ruleset->ruleset_active;?>" >
	</td>
</tr>
<tr>
	<td>Comment</td>
	<td>
			<input name="ruleset_comment" type="text" value="<?php
				echo $ruleset->ruleset_comment;?>" >
	</td>
</tr>
<td><a href="#" onclick="document.frm.submit()" class="btn btn-success glyphicon glyphicon-ok">&nbsp;save</a></td>
</tr>
</table>
</form>
<?php
		}
		

include ('content-wrapper-end.php');
include ('foot.php');
?>
