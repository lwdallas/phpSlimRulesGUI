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
<form name="frm" action="http:update.php">
<table>
<tr>
	<td>ID</td>
	<td>
			<?php echo $rule->id;?>
			<input type="hidden" name="id" value="<?php echo $rule->id;?>">
	</td>
</tr>
<tr>
	<td>Rule Set</td>
	<td>
			<input name="ruleset" type="text" value="<?php
				echo $rule->ruleset;?>" >
	</td>
</tr>
<tr>
	<td>Rule Logic</td>
	<td>
			<input name="rule" type="text" value="<?php
				echo $rule->rule;?>" >
	</td>
</tr>
<tr>
	<td>Active</td>
	<td>
			<input name="rule_active" type="text" value="<?php
				echo $rule->rule_active;?>" >
	</td>
</tr>
<tr>
	<td>Comment</td>
	<td>
			<input name="rule_comment" type="text" value="<?php
				echo $rule->rule_comment;?>" >
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
